<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 19.08.16
 * Time: 10:57
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Decorators;

use Illuminate\Database\Eloquent\Model;

class BaseDecorator
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseDecorator constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->setModel($model);
    }

    /**
     * @return Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model $model
     */
    public function setModel(Model $model)
    {
        $this->model = $model;
    }
}