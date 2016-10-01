<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use App\Components\Decorators\LikableDecorator;
use App\Components\Extra\StoresImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CatalogProduct extends Model
{
    use StoresImages;

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'visible_name',
        'alias_name',
        'description',
        'author_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(CatalogCategory::class, 'catalog_products_catalog_categories', 'product_id', 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(Account::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->hasMany(CatalogProductImage::class, 'product_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function properties()
    {
        return $this->belongsToMany(CatalogProductProperty::class, 'catalog_products_catalog_product_properties', 'product_id', 'property_id');
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
        return Str::words($this->description, 45);
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
        return $decorator->renderButton('frontend.like-catalog-product');
    }
}
