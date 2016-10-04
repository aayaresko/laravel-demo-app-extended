<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 07.09.16
 * Time: 18:31
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Facades;

use App\Models\Entities\CatalogCategory;
use App\Models\Entities\CatalogFilter;
use App\Models\Entities\CatalogFilterCategory;
use App\Models\Entities\CatalogProductProperty;
use Illuminate\Database\Eloquent\Builder;

class CatalogFilterFacade
{
    /**
     * Should look something like this:
     * ```php
     *      [
     *          'processor' => [
     *              9,
     *              10,
     *          ],
     *          'ram_size => [
     *              5,
     *              6,
     *              7,
     *          ],
     *          'screen_size' => 3,
     * ]
     * ```
     * @var array
     */
    protected $filter_parameters = [];
    /**
     * Should look something like this:
     * ```php
     *      [
     *          'where' => [
     *              11,
     *              12,
     *              15
     *          ],
     *          'whereBetween => [
     *              [ 13, 14 ],
     *              [ 16, 17 ],
     *          ],
     * ]
     * ```
     *
     * @var array
     */
    protected $query_parameters = [];
    /**
     * @var null|int
     */
    protected $selected_item;

    /**
     * CatalogFilterFacade constructor.
     *
     * @param null|string $filter_query
     */
    public function __construct($filter_query = null)
    {
        $this->parseFilterQuery($filter_query);
    }

    /**
     * Convert filter string to query parameters.
     *
     * Takes a filter string in format: 'processor=9,10;ram_size=5'.
     * Filter string consist of 'key=value' pairs divided by semicolon.
     * First pair in that string should be the pair of 'filter=1'.
     * If this pair is absent in filtering string  - filtering mechanism will be disabled.
     * 'key' and 'value' should be either an integer or a string.
     * Several values can be specified for a single parameter divided by comma (e.g. processor=9,10).
     * Check out [[parseFilterParameters]] for details.
     *
     * @param string $filter_query
     */
    public function parseFilterQuery($filter_query = '')
    {
        if ($filter_query) {
            $parameters = explode(';', trim($filter_query, " \t\n\r\0\x0B;"));
            if (!empty($parameters)) {
                $this->parseFilterParameters($parameters);
            }
        }
    }

    /**
     * Generate query parameters.
     *
     * Each parameter is a 'key=value' pair.
     * 'Key' expected as value of 'alias_name' attribute of CatalogFilterCategory instance.
     * 'Value' should be either an 'id' of CatalogFilter instance or a 'is_string' of CatalogProductPropertyValue instance.
     * Depending on CatalogFilter instance type and its attribute values 'where' or 'whereBetween' items will be created.
     * All items will be persisted in `query_parameters`.
     * Automatically adds maximum or minimum for filters that have only one of the range value.
     * Checkout [[getRangeValues]] for details.
     * All valid parameters will be persisted in `$filter_parameters`.
     * They can be reused to create a new filter query string.
     *
     * @param array $parameters
     */
    protected function parseFilterParameters($parameters)
    {
        foreach ($parameters as $parameter) {
            $items = explode('=', $parameter);
            if (count($items) > 1) {
                $alias_name = reset($items);
                $model = CatalogFilterCategory::where('alias_name', $alias_name)->first();
                if ($model) {
                    $identifier = $model->id;
                    $filters = explode(',', next($items));
                    $models = CatalogFilter::find($filters);
                    if (count($models) == 0) {
                        $count = CatalogProductProperty::whereIn('alias_name', $filters)->count();
                        if ($count == count($filters)) {
                            foreach ($filters as $value) {
                                $this->query_parameters[$identifier]['where'][] = $value;
                            }
                        }
                    } else {
                        foreach ($models as $model) {
                            switch ($model->type_id) {
                                case CatalogFilter::FILTER_IS_EQUAL:
                                    $this->query_parameters[$identifier]['where'][] = $model->leftProperty->value;
                                    break;
                                case CatalogFilter::FILTER_IN_RANGE:
                                    list($left_value, $right_value) = $this->getRangeValues($model);
                                    $this->query_parameters[$identifier]['whereBetween'][] = [$left_value, $right_value];
                                    break;
                            }
                        }
                    }
                    $filter_parameters[$alias_name] = $filters;
                }
            }
        }
        isset($filter_parameters) ? $this->setFilterParameters($filter_parameters) : null;
    }

    /**
     * Generate range values.
     *
     * If both left_property_id and right_property_id is been set - returns their values.
     * If there is no left_property_id - will calculate minimum value.
     * If there is no right_property_id - will calculate maximum value.
     * left_property_id and right_property_id have the same CatalogFilterCategory.
     * This CatalogFilterCategory type is used to calculate maximum or minimum.
     *
     * @param CatalogFilter $model
     * @return array
     */
    protected function getRangeValues($model)
    {
        if ($model->leftProperty) {
            $left_value = $model->leftProperty->value;
        } else {
            $left_value = $this->getMinimum($model->rightProperty->category_id);
        }
        if ($model->rightProperty) {
            $right_value = $model->rightProperty->value;
        } else {
            $right_value = $this->getMaximum($model->leftProperty->category_id);
        }
        return [
            $left_value,
            $right_value
        ];
    }

    /**
     * Get minimum value.
     *
     * Get minimum value from CatalogProductProperty for specified CatalogProductProperty identifier.
     *
     * @param string $category_id
     * @return integer|null
     */
    public function getMinimum($category_id)
    {
        $model = CatalogProductProperty::where('category_id', $category_id)->orderBy('alias_value', 'asc')->first();
        return $model ? $model->value : null;
    }

    /**
     * Get maximum value.
     *
     * Get maximum value from CatalogProductProperty for specified CatalogProductProperty identifier.
     *
     * @param string $category_id
     * @return integer|null
     */
    public function getMaximum($category_id)
    {
        $model = CatalogProductProperty::where('category_id', $category_id)->orderBy('alias_value', 'desc')->first();
        return $model ? $model->value : null;
    }

    /**
     * @return string
     */
    public function buildFilterQuery()
    {
        $query = '';
        $parameters = collect($this->getFilterParameters());
        foreach ($parameters->all() as $name => $value) {
            if (is_array($value)) {
                $value = implode(',', $value);
            }
            $query .= "{$name}={$value};";
        }
        return trim($query, ";");
    }

    /**
     * @return array
     */
    public function getFilterParameters()
    {
        return $this->filter_parameters;
    }

    /**
     * @param array $parameters
     */
    public function setFilterParameters(array $parameters)
    {
        $this->filter_parameters = $parameters;
    }

    /**
     * Combine `$data` items with `$filter_parameters` item.
     *
     * If current `$data` 'key' item contains the same value as `$filter_parameters` 'key':
     * * it will be removed from `$filter_parameters` 'key' item
     * * if current item with 'key' is empty - it will be removed from `$filter_parameters`.
     * If `$filter_parameters` does not have the 'key' from `$data` - stores its 'value' to the `$filter_parameters` with that 'key'.
     * If `$filter_parameters` and `$data` has same 'key':
     * * creates a new array which will contain both values and stores it back to the `$filter_parameters` with that 'key'
     * * performs clean up from duplicate values
     * This way user can 'enable' or 'disable' specific filter item by clicking it.
     * If current item is selected (active) - returns true.
     * This way you can control an appearance of current item.
     *
     * @param array $data
     * @return bool
     */
    public function combineFilterParameters(array $data)
    {
        $parameters = collect($this->getFilterParameters());
        foreach ($data as $index => $item) {
            $parameter = $parameters->get($index);
            if (is_array($parameter)) {
                $duplicated_item_index = array_search($item, $parameter);
                if ($duplicated_item_index !== false) {
                    unset($parameter[$duplicated_item_index]);
                    if (empty($parameter)) {
                        $parameters->forget($index);
                    } else {
                        $parameters->put($index, $parameter);
                    }
                    $this->selected_item = $duplicated_item_index;
                } else {
                    $parameter[] = $item;
                    $parameter = array_unique($parameter);
                    sort($parameter);
                    $parameters->put($index, $parameter);
                }
            } else {
                if ($parameter) {
                    $parameter[] = $item;
                    $parameter = array_unique($parameter);
                    sort($parameter);
                }
                $parameters->put($index, $item);
            }
        }
        $this->setFilterParameters($parameters->all());
        return $this->hasSelectedItem();
    }

    /**
     * @return bool
     */
    public function hasSelectedItem()
    {
        return is_int($this->selected_item) ? true : false;
    }

    /**
     * Attach conditions to the query.
     *
     * If `$category` is an instance of CatalogCategory - a new 'where exists' subquery will be created.
     * If `$query_parameters` is set - a new 'where exists' subquery will be created for each `$query_parameters` item.
     * The type of condition for current subquery is defined by current key value of the `$query_parameters` array.
     * For each `$query_parameters` item a new 'or' condition will be attached to that subquery.
     * Each array key will be used as query instance method.
     * Values from that array is used as a parameters for that method.
     *
     * @param Builder $query
     * @param CatalogCategory|null $category
     */
    public function attachConditionsToQuery($query, $category = null)
    {
        if ($category instanceof CatalogCategory) {
            $query->whereHas('categories', function ($query) use ($category) {
                /** @var Builder $query */
                $query->where('alias_name', '=', $category->alias_name);
            });
        }
        if (!empty($this->query_parameters)) {
            foreach ($this->query_parameters as $category => $items) {
                $query->whereHas('properties', function ($query) use ($items) {
                    /** @var Builder $query */
                    foreach ($items as $property => $values) {
                        foreach ($values as $value) {
                            $query->orWhere(function ($query) use ($property, $value) {
                                /** @var Builder $query */
                                if ((int)$value) {
                                    $field = 'alias_value';
                                } else {
                                    $field = 'alias_name';
                                }
                                $query->{$property}($field, $value);
                            });
                        }
                    }
                });
            }
        }
    }
}