<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 27.09.16
 * Time: 14:53
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Observers;

use App\Models\Entities\Account;
use App\Models\Entities\BlogPost;
use App\Notifications\BlogPostPublished;
use Carbon\Carbon;

class BlogPostPublishedObserver
{
    /**
     * Sends user notification about new blog post.
     *
     * Sends notification to all active users that have subscribed to a 'new blog post' event.
     *
     * @param BlogPost $model
     */
    public function saving(BlogPost $model)
    {
        if ($model->isDirty('is_published') && $model->getAttributeValue('is_published')) {
            $accounts = Account::active()
                ->whereHas('subscriptions', function ($query) {
                    $query->posts();
                })
                ->get();
            $notification = new BlogPostPublished($model);
            $notification->onQueue('mail')->delay(Carbon::now()->addMinutes(5));
            foreach ($accounts as $account) {
                $account->notify($notification);
            }
        }
    }
}