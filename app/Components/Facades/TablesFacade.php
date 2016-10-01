<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 23.09.16
 * Time: 16:47
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Facades;

use Collective\Html\HtmlFacade;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TablesFacade.
 *
 * `$attributes` array contains all attributes of current model that should be displayed.
 * You can specify attribute with 'dot' syntax.
 * For example, if you specify 'category.visible_name' it will display 'visible_name' attribute value of 'category' related model.
 * `$data_provider` should be an either instance of LengthAwarePaginator or a Collection.
 * You can specify text, that will be displayed when no data to display.
 * You can specify `$default_actions_route`. In that case action url will be raletive to that route for all buttons.
 * You can specify any route for any button via `$action_buttons` array.
 * Array should look like this:
 * ```php
 *      'show' => [
 *          'title' => '<i class="glyphicon glyphicon-eye-open"></i>',
 *          'route' => 'backend.accounts',
 *      ],
 *      'edit' => [
 *          'title' => '<i class="glyphicon glyphicon-pencil"></i>',
 *          'route' => 'frontend.accounts',
 *      ],
 *      'destroy' => [
 *          'title' => 'My button content',
 *          'route' => 'site',
 *          'options' => [
 *              'class' => 'delete-ajax',
 *              ]
 *          ]
 * ```
 * You can specify attributes values for the table itself and tr and td tags of the table via `$table_options`, `$row_options` and `$item_options` respectively.
 *
 * Use {renderLinks} method to print pagination links.
 *
 * @package App\Components\Facades
 */
class TablesFacade
{
    /**
     * @var string
     */
    public $not_found_text = 'content.no_models';
    /**
     * @var array
     */
    public $table_options = [
        'class' => 'table table-hover'
    ];
    /**
     * @var array
     */
    public $row_options = [];
    /**
     * @var array
     */
    public $item_options = [];
    /**
     * @var string
     */
    public $default_actions_route = '';
    /**
     * @var array
     */
    public $action_buttons = [
        'show' => [
            'title' => '<i class="glyphicon glyphicon-eye-open"></i>',
            'route' => '',
        ],
        'edit' => [
            'title' => '<i class="glyphicon glyphicon-pencil"></i>',
            'route' => '',
        ],
        'destroy' => [
            'title' => '<i class="glyphicon glyphicon-trash"></i>',
            'route' => '',
        ]
    ];
    /**
     * @var array
     */
    protected $attributes = [];
    /**
     * @var LengthAwarePaginator|Collection
     */
    protected $data_provider;
    /**
     * @var array
     */
    protected $models = [];

    /**
     * TablesFacade constructor.
     *
     * Set up all required items.
     * `$models` holds all data that need to be displayed.
     * `$attributes` is array of attributes that need to be displayed for each model.
     *
     * @param mixed $data_provider
     * @param array $attributes
     * @param string $default_actions_route
     */
    public function __construct($data_provider, array $attributes, $default_actions_route)
    {
        $this->setDataProvider($data_provider);
        $this->attributes = $attributes;
        $this->default_actions_route = $default_actions_route;
    }

    /**
     * Controls `$data_provider` value.
     *
     * `$data_provider` should be either an instance of LengthAwarePaginator or a Collection.
     * Automatically loads all `$models`.
     *
     * @param LengthAwarePaginator|Collection $data_provider
     */
    public function setDataProvider($data_provider)
    {
        if ($data_provider instanceof LengthAwarePaginator || $data_provider instanceof Collection) {
            $this->data_provider = $data_provider;
            $this->models = $this->data_provider->all();
        }
    }

    /**
     * Controls an `$attributes` value.
     *
     * @param array $attributes
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * Output the table.
     *
     * @return string
     */
    public function renderTable()
    {
        if ($this->getModels()) {
            return HtmlFacade::tag('table', $this->buildHeader() . $this->buildBody(), $this->table_options);
        }
        return $this->not_found_text ? trans($this->not_found_text) : '';
    }

    /**
     * Allows access to the `$models` array.
     *
     * @return array
     */
    public function getModels()
    {
        return $this->models;
    }

    /**
     * Generate the table header.
     *
     * Converts all attribute name to upper case and replaces some symbols with spaces.
     *
     * @return string
     */
    public function buildHeader()
    {
        $content = [];
        foreach ($this->attributes as $attribute) {
            $content[] = HtmlFacade::tag('th', $this->formatAttributeName($attribute));
        }
        $row = HtmlFacade::tag('tr', implode('', $content));
        return HtmlFacade::tag('thead', $row->toHtml());
    }

    /**
     * @param string $attribute
     * @return string
     */
    protected function formatAttributeName($attribute)
    {
        $attribute = preg_replace(['|_|', '|\.|'], [' ', ' '], $attribute);
        return trim(mb_convert_case($attribute, MB_CASE_TITLE, 'UTF-8'));
    }

    /**
     * Generate the table body.
     *
     * @return string
     */
    public function buildBody()
    {
        $content = [];
        $rows = [];
        foreach ($this->models as $model) {
            foreach ($this->attributes as $attribute) {
                $content[] = HtmlFacade::tag('td', $this->parseAttributeValue($model, $attribute), $this->item_options);
            }
            $content[] = $this->buildActions($model);

            $rows[] = HtmlFacade::tag('tr', implode('', $content), $this->row_options);
            $content = [];
        }
        return HtmlFacade::tag('tbody', implode('', $rows));
    }

    /**
     * Get attribute value.
     *
     * You may target an attribute of related models by using 'dot' syntax (e.g. category.author.profile.full_name, category.visible_name, etc).
     * If current attribute value of the `$model` is a relation - retrieves it and saves it.
     * This relation will be used in next iteration to search next value.
     * HtmlBuilder 'content' property should be a string.
     *
     * @param Model $model
     * @param string $attribute
     * @return string
     */
    protected function parseAttributeValue($model, $attribute)
    {
        $parts = explode('.', $attribute);
        if (count($parts) > 1) {
            $relation = $model;
            foreach ($parts as $part) {
                $value = $relation->getAttributeValue($part);
                if ($value) {
                    return (string)$value;
                } else {
                    $relation = $relation->getRelationValue($part);
                }
                if (!$relation) {
                    return '';
                }
            }
        } else {
            return (string)$model->getAttribute($attribute);
        }
    }

    /**
     * Adds action links to each table row.
     *
     * @param Model $model
     * @return string
     */
    protected function buildActions($model)
    {
        $content = [];
        foreach ($this->action_buttons as $action => $value) {
            $collection = collect($value);
            if ($collection->get('route')) {
                $link = route($collection->get('route') . '.' . $action, $model->id);
            } else if ($this->default_actions_route) {
                $link = route($this->default_actions_route . '.' . $action, $model->id);
            } else {
                $link = "{$action}/{$model->id}";
            }
            $content[] = HtmlFacade::link($link, $collection->get('title'), $collection->get('options'), false, false);
        }
        return HtmlFacade::tag('td', implode('', $content), $this->item_options);
    }

    /**
     * Generate pagination links.
     *
     * @return string
     */
    public function renderLinks()
    {
        if (method_exists($this->data_provider, 'links')) {
            return $this->data_provider->links();
        }
        return '';
    }
}