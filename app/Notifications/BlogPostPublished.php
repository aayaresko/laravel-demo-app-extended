<?php

namespace App\Notifications;

use App\Models\Entities\Account;
use App\Models\Entities\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BlogPostPublished extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * @var
     */
    public $post;

    /**
     * Create a new notification instance.
     *
     * @param BlogPost $post
     * @return void
     */
    public function __construct(BlogPost $post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(Account $notifiable)
    {
        return (new MailMessage)
                    ->greeting('Hello, ' . $notifiable->profile->full_name)
                    ->subject('New blog post: ' . $this->post->title)
                    ->line('A new blog post was published at ' . config('app.name') . '. ' . $this->post->title )
                    ->action('Read it now!', route('frontend.blog-post.show', $this->post->alias_name))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
