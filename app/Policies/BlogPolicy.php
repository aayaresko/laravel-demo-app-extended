<?php

namespace App\Policies;

use App\Models\Entities\Account;
use App\Models\Entities\BlogPost;
use Illuminate\Auth\Access\HandlesAuthorization;

class BlogPolicy
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
     * @param BlogPost $post
     * @return bool
     */
    public function updateOwnPost(Account $user, BlogPost $post)
    {
        if (
            $user->getIsActive() &&
            ($user->id == $post->author_id)
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
