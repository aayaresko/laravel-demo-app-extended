<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ContactMessage extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'content',
    ];

    /**
     * @return string
     */
    public function getPreviewAttribute()
    {
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
}
