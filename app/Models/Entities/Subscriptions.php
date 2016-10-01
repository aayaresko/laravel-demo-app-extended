<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Subscriptions extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'news',
        'posts',
    ];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopePosts($query)
    {
        return $query->where('posts', 1);
    }

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeNews($query)
    {
        return $query->where('news', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
