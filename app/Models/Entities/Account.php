<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Foundation\Auth\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Notifications\Notifiable;

class Account extends User
{
    use Notifiable;

    const STATUS_UNCONFIRMED = null;
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_BANNED = 2;

    /**
     * {@inheritdoc}
     *
     * @var string
     */
    protected $table = 'accounts';

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'nickname',
        'email',
    ];

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'registration_token',
        'updated_at'
    ];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('status', self::STATUS_ACTIVE);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(AccountProfile::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function subscriptions()
    {
        return $this->hasOne(Subscriptions::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(BlogPost::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chat_messages()
    {
        return $this->hasMany(ChatMessage::class, 'author_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoritePosts()
    {
        return $this->morphedByMany(BlogPost::class, 'favorite', 'favorites', 'account_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function favoriteProducts()
    {
        return $this->morphedByMany(CatalogProduct::class, 'favorite', 'favorites', 'account_id');
    }

    /**
     * @return string
     */
    public function getCreatedAttribute()
    {
        $decorator = new DateFormatDecorator($this);
        return $decorator->formatAttributeValue('created_at');
    }

    /**
     * @return bool
     */
    public function getIsActive()
    {
        return $this->status == self::STATUS_ACTIVE;
    }
}
