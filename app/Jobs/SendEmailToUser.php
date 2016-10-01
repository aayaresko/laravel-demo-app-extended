<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 24.08.16
 * Time: 11:34
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Jobs;

use App\Models\Entities\Account;
use Illuminate\Contracts\Mail\Mailer;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendEmailToUser extends Job implements ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    /**
     * @var Account
     */
    protected $user;
    /**
     * @var string
     */
    protected $email_template;
    /**
     * @var Collection
     */
    protected $email_options;

    /**
     * Create a new job instance.
     *
     * SendEmailToUser constructor.
     *
     * @param string $email_template
     * @param array $email_options
     * @param Account $user
     */
    public function __construct(Account $user, $email_template, array $email_options = [])
    {
        $this->user = $user;
        $this->email_template = $email_template;
        $this->setEmailOptions($email_options);
    }

    /**
     * Execute the job.
     *
     * Sends an email.
     *
     * @param Mailer $mailer
     * @return void
     */
    public function handle(Mailer $mailer)
    {
        $mailer->send(
            $this->email_template,
            [
                'account' => $this->user,
                'profile' => $this->user->profile,
            ],
            function ($message) {
                $message->from(config('mail.from.address'), config('mail.from.name'));
                $message->to($this->user->getEmailForPasswordReset(), $this->user->profile->full_name);
                $message->subject($this->getEmailOption('subject'));
            }
        );
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getEmailOption($name)
    {
        return $this->email_options->get($name);
    }

    /**
     * @return Collection
     */
    public function getEmailOptions()
    {
        return $this->email_options;
    }

    /**
     * @param array $options
     */
    public function setEmailOptions(array $options)
    {
        $this->email_options = collect($options);
    }

}