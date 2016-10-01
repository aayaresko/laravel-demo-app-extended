<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;

class CatalogCategory extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'visible_name',
        'alias_name',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(CatalogProduct::class, 'catalog_products_catalog_categories', 'product_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function filters()
    {
        return $this->hasMany(CatalogFilter::class, 'catalog_category_id')->active();
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
