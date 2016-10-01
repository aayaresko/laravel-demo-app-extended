<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBlog($query)
    {
        return $query->where('id', '!=', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_posts_blog_categories', 'post_id', 'category_id');
    }

    /**
     * @return string
     */
    public function getCreatedAttribute()
    {
        $decorator = new DateFormatDecorator($this);
        return $decorator->formatAttributeValue('created_at');
    }
}
