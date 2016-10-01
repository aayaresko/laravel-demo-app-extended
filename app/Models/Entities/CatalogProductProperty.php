<?php

namespace App\Models\Entities;

use App\Components\Decorators\CombineAttributesDecorator;
use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Model;

class CatalogProductProperty extends Model
{
    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'visible_name',
        'value',
        'description',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(CatalogFilterCategory::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(CatalogProduct::class, 'catalog_products_catalog_product_properties', 'property_id', 'product_id');
    }

    /**
     * Value 'get' mutator.
     *
     * To Simplify access to values of the current model.
     *
     * @return mixed|null
     */
    public function getValueAttribute()
    {
        if ($this->alias_value) {
            return $this->alias_value;
        }
        if ($this->alias_name) {
            return $this->alias_name;
        }
        return null;
    }

    /**
     * Value 'set' mutator.
     *
     * @param $value
     */
    public function setValueAttribute($value)
    {
        if ((int)$value) {
            $property = 'alias_value';
        } else {
            $property = 'alias_name';
        }
        $this->{$property} = $value;
    }

    /**
     * Value label mutator.
     *
     * To simplify creation of 'options' for the 'select' html-tag.
     *
     * @return string
     */
    public function getValueLabelAttribute()
    {
        return $this->getFormattedValue('{category.visible_name}: {visible_name}');
    }

    /**
     * @param string $template
     * @return mixed
     */
    public function getFormattedValue($template = '{value} {id}')
    {
        $decorator = new CombineAttributesDecorator($this);
        return $decorator->formatString($template);
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
