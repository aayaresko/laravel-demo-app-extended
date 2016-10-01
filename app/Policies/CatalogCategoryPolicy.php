<?php

namespace App\Policies;

use App\Models\Entities\Account;
use Illuminate\Auth\Access\HandlesAuthorization;

class CatalogCategoryPolicy
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
    public function create(Account $user)
    {
        return $user->getIsActive();
    }
}
