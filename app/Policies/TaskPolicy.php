<?php

namespace App\Policies;

use App\Models\Entities\Account;
use App\Models\Entities\Task;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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
     * @param Task $task
     * @return bool
     */
    public function updateOwnTask(Account $user, Task $task)
    {
        if (
            $user->getIsActive() &&
            ($user->id == $task->author_id)
        ) {
            return true;
        }
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
