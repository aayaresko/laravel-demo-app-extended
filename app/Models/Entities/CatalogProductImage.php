<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use App\Components\Extra\StoresImages;
use Illuminate\Database\Eloquent\Model;

class CatalogProductImage extends Model
{
    use StoresImages;

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'url',
        'alt',
    ];

    /**
     * {@inheritdoc}
     *
     * @return static
     */
    public function product()
    {
        return $this->belongsTo(CatalogProduct::class, 'product_id');
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
