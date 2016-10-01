<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use App\Components\Decorators\LikableDecorator;
use App\Components\Extra\StoresImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BlogPost extends Model
{
    use StoresImages;

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'preview_content',
        'author_id',
        'is_published'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_posts_blog_categories', 'post_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function userFavorites()
    {
        return $this->morphToMany(Account::class, 'favorite', 'favorites');
    }

    /**
     * @return string
     */
    public function getPreviewAttribute()
    {
        if (strlen($this->preview_content) > 10) {
            return Str::words($this->preview_content, 100);
        }
        return Str::words($this->content, 100);
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
     * @return string
     */
    public function getLikesAttribute()
    {
        $decorator = new LikableDecorator($this);
        return $decorator->renderButton('frontend.like-blog-post');
    }
}
