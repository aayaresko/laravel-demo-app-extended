<?php

namespace App\Models\Entities;

use App\Components\Decorators\CatalogFilterDecorator;
use App\Components\Decorators\DateFormatDecorator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class CatalogFilter extends Model
{
    const FILTER_IS_EQUAL = 1;
    const FILTER_IN_RANGE = 2;

    /**
     * {@inheritdoc}
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'type_id',
        'priority',
        'category_id',
        'catalog_category_id',
        'left_property_id',
        'right_property_id',
        'is_disabled',
    ];

    /**
     * @param Builder $query
     * @return Builder
     */
    public function scopeActive($query)
    {
        return $query->where('is_disabled', 0);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function leftProperty()
    {
        return $this->belongsTo(CatalogProductProperty::class, 'left_property_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rightProperty()
    {
        return $this->belongsTo(CatalogProductProperty::class, 'right_property_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function catalogCategory()
    {
        return $this->belongsTo(CatalogCategory::class, 'catalog_category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(CatalogFilterCategory::class, 'category_id');
    }

    /**
     * @return string|null
     */
    public function getTypeAttribute()
    {
        $types = self::getTypes();
        $identifier = $this->type_id;
        return key_exists($identifier, $types) ? $types[$identifier] : null;
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::FILTER_IS_EQUAL => 'Equal filter',
            self::FILTER_IN_RANGE => 'Range filter',
        ];
    }

    /**
     * @param CatalogCategory $category
     * @param array $filter_parameters
     * @return string
     */
    public function getFilterTitle(CatalogCategory $category, $filter_parameters)
    {
        $decorator = new CatalogFilterDecorator($this);
        $decorator->setFilterParameters($filter_parameters);
        return $decorator->formatTitle($category);
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
