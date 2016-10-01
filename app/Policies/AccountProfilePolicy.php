<?php

namespace App\Policies;

use App\Models\Entities\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @param Account $user
     * @return bool
     */
    public function updateOwnProfile(Account $user)
    {
        return $user->getIsActive();
    }
}
