<?php

namespace App\Models\Entities;

use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;

class CatalogFilterCategory extends Model
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function filters()
    {
        return $this->hasMany(CatalogFilter::class, 'category_id')->active();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function properties()
    {
        return $this->hasMany(CatalogProductProperty::class, 'category_id');
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
