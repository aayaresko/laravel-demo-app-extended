<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 05.09.16
 * Time: 19:01
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Decorators;

use App\Components\Facades\CatalogFilterFacade;
use App\Models\Entities\CatalogCategory;

class CatalogFilterDecorator extends BaseDecorator
{
    /**
     * @var array
     */
    protected $filter_parameters = [];
    /**
     * @var bool
     */
    protected $item_is_active = false;

    /**
     * @param array $item
     */
    public function setFilterParameters(array $item)
    {
        $this->filter_parameters = $item;
    }

    /**
     * Create the url to apply filter condition.
     *
     * Category is a part of that url.
     *
     * @param CatalogCategory $category
     * @return string
     */
    public function formatTitle(CatalogCategory $category)
    {
        $filter_value = $this->formatFilterValue();
        $path = link_to_route(
            'frontend.catalog-product.index',
            $this->model->title,
            [$category->alias_name, $filter_value]
        );
        $class = $this->item_is_active ? 'glyphicon glyphicon-ok-sign' : '';
        return "<span class='{$class}'></span>{$path}";
    }

    /**
     * Format filter value string.
     *
     * It uses CatalogFilterFacade to build new filter string.
     * Checkout CatalogFilterFacade for more details.
     * Filter string will look something like this: 'processor=9,10;ram_size=5'.
     *
     * @return string
     */
    public function formatFilterValue()
    {
        $facade = new CatalogFilterFacade();
        $facade->setFilterParameters($this->filter_parameters);
        $this->item_is_active = $facade->combineFilterParameters([$this->model->category->alias_name => $this->model->id]);
        return $facade->buildFilterQuery();
    }
}