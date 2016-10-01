<?php

namespace App\Mail;

use App\Models\Entities\Account;
use App\Models\Entities\AccountProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Account
     */
    public $account;
    /**
     * @var AccountProfile
     */
    public $profile;

    /**
     * Create a new message instance.
     *
     * @param Account $account
     * @param AccountProfile $profile
     * @return void
     */
    public function __construct(Account $account, AccountProfile $profile)
    {
        $this->account = $account;
        $this->profile = $profile;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject('Registration confirmed')
            ->view("email.registration-confirmed");
    }
}
