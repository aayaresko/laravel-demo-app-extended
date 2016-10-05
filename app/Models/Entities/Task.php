<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'author_id',
    ];

    /**
     * {@inheritdoc}
     *
     * @return static
     */
    public function author()
    {
        return $this->belongsTo(Account::class, 'author_id');
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
