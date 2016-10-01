<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 19.08.16
 * Time: 14:52
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Facades;

use App\Mail\RegistrationConfirmed;
use App\Mail\RegistrationRequest;
use App\Models\Entities\Account;
use App\Models\Entities\AccountProfile;
use App\Models\Entities\Subscriptions;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\PasswordBroker;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;

/**
 * Class UserAccountFacade.
 *
 * Simplifies create and update of users.
 * It uses JobQueue to queue notification email.
 *
 * @package App\Components\Facades
 */
class UserAccountFacade
{
    use DispatchesJobs;

    /**
     * @var bool
     */
    public $send_email = true;
    /**
     * @var string
     */
    public $queue_name = 'mail';
    /**
     * User account model.
     *
     * @var Account
     */
    protected $account;
    /**
     * User profile model.
     *
     * @var AccountProfile
     */
    protected $profile;
    /**
     * @var PasswordBroker|null
     */
    protected $broker;
    /**
     * @var Collection
     */
    protected $data;

    /**
     * UserFacade constructor.
     *
     * Assigns $account and $profile properties automatically.
     *
     * @param Account $account
     * @param AccountProfile|null $profile
     * @param string $broker
     * @param mixed
     */
    public function __construct(Account $account, $profile = null, $broker = null)
    {
        $this->setAccount($account);
        if ($profile) {
            $this->setProfile($profile);
        } elseif ($account->profile) {
            $this->setProfile($account->profile()->first());
        }
        $this->broker = Password::broker($broker);
    }

    /**
     * This magic method provides access to account model.
     *
     * @return Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * This magic method saves account model.
     *
     * @param Account $account
     */

    public function setAccount(Account $account)
    {
        $this->account = $account;
    }

    /**
     * This magic method provides access to profile model.
     *
     * @return AccountProfile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * This magic method saves profile model.
     *
     * @param AccountProfile $profile
     */
    public function setProfile(AccountProfile $profile)
    {
        $this->profile = $profile;
    }

    /**
     * This magic method provides access to `$data` collection
     *
     * @return Collection
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * This magic method saves data.
     *
     * If `$data` type is array - automatically makes typecast `$data` to the Collection.
     *
     * @param array|Collection $data
     */
    public function setData($data)
    {
        if (is_array($data)) {
            $this->data = collect($data);
        } elseif ($data instanceof Collection) {
            $this->data = $data;
        }
    }

    /**
     * Activates user account.
     *
     * Perform user account activation.
     * Notifies user via email about activation results.
     * If `$send_email` is set to true - automatically sends email notification about successful registration.
     * If `$queue_name` is not false:
     * * email notification job will be sent to the queue `$queue_name` first
     * * queue worker will pull out and perform that job
     * If `$queue_name` is set to false - sends email directly, without usage queue job mechanism.
     *
     * @return bool
     */
    public function activate()
    {
        if (!$this->account->status) {
            $this->account->status = Account::STATUS_ACTIVE;
            $this->account->registration_token = null;
            $result = $this->account->save();
            if ($result && $this->send_email) {
                $mailable = new RegistrationConfirmed($this->account, $this->account->profile);
                $mail = Mail::to($this->account->email, $this->account->profile->full_name);
                if ($this->queue_name) {
                    $mailable->onQueue($this->queue_name);
                    $mail->later(Carbon::now()->addMinute(), $mailable);
                } else {
                    $mail->send($mailable);
                }
            }
            return $result;
        }
        return false;
    }

    /**
     * Attach validation rules.
     *
     * Attach associated validation rule depending on which attribute of model is changed.
     * Automatically performs password hash.
     * Returns array of validation rules suitable for use in [[ValidationRequest::validate()]].
     *
     * @param mixed $data
     * @return array
     */
    public function getValidationRequirements($data = null)
    {
        $validate = [];
        if ($this->fillModels($data)) {
            if ($this->account->isDirty('nickname')) {
                $validate['nickname'] = "required|string|max:255|unique:{$this->account->getTable()},nickname";
            }
            if ($this->account->isDirty('email')) {
                $validate['email'] = "required|string|max:255|unique:{$this->account->getTable()},email";
            }
            if ($this->data->get('password')) {
                $this->account->password = Hash::make($this->data->get('password'));
                $validate['password'] = 'required|string|min:6|confirmed';
            }
            $validate['first_name'] = 'string';
            $validate['last_name'] = 'string';
        }
        return $validate;
    }

    /**
     * Fill `$account` and `$profile` models with data from `$data` attribute.
     *
     * @param array|Collection $data
     * @return bool
     */
    protected function fillModels($data)
    {
        $this->setData($data);
        if ($this->data) {
            $this->account->fill($this->data->all());
            $this->profile->fill($this->data->all());
            return true;
        }
        return false;
    }

    /**
     * Creates new `$account` and `$profile` models.
     *
     * Assigns profile to the account automatically.
     * If `$send_email` is set to true - automatically sends email notification about successful registration.
     * If `$queue_name` is not false:
     * * email notification job will be sent to the queue `$queue_name` first
     * * queue worker will pull out and perform that job
     * If `$queue_name` is set to false - sends email directly, without usage queue job mechanism.
     *
     * @param mixed $data
     * @return bool
     */
    public function save($data = null)
    {
        if ($this->fillModels($data)) {
            $this->account->registration_token = $this->broker->createToken($this->account);
            if ($this->account->save()) {
                $this->account->profile()->save($this->profile);
                $this->account->subscriptions()->save(new Subscriptions());
                if ($this->send_email) {
                    $mailable = new RegistrationRequest($this->account, $this->account->profile);
                    $mail = Mail::to($this->account->email, $this->account->profile->full_name);
                    if ($this->queue_name) {
                        $mailable->onQueue($this->queue_name);
                        $mail->later(Carbon::now()->addMinute(), $mailable);
                    } else {
                        $mail->send($mailable);
                    }
                }
                return true;
            }
        }
        return false;
    }

    /**
     * Updates both `$account` and `$profile` models.
     *
     * @param mixed $data
     */
    public function update($data = null)
    {
        if ($this->fillModels($data)) {
            $this->account->save();
            $this->profile->save();
        }
    }
}