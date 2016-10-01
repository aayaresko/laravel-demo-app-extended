<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 27.09.16
 * Time: 13:35
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Decorators;

use Collective\Html\HtmlFacade;
use Illuminate\Support\Facades\Auth;

/**
 * Class LikableDecorator.
 *
 * Controls visibility of 'likes' counter.
 *
 * @package App\Components\Decorators
 */
class LikableDecorator extends BaseDecorator
{
    /**
     * Render 'likes' counter.
     *
     * If user is authenticated - renders 'likes' counter.
     *
     * @param $route
     * @return string
     */
    public function renderButton($route)
    {
        if (Auth::user()) {
            return
                HtmlFacade::tag('i', '', ['class' => 'glyphicon glyphicon-star']) .
                HtmlFacade::tag('a', (string)count($this->model->userFavorites), ['class' => 'like-button', 'data-key' => $this->model->id, 'href' => route($route)]);
        }
    }
}