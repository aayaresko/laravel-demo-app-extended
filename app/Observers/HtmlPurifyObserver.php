<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 09.09.16
 * Time: 19:05
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;

class HtmlPurifyObserver
{
    protected $attributes = [
        'first_name',
        'last_name',
        'title',
        'content',
        'preview_content',
        'description',
        'visible_name',
        'alias_name',
    ];

    /**
     * Purify html.
     *
     * Will purify all attributes from `$attributes` array.
     *
     * @param Model $model
     */
    public function saving(Model $model)
    {
        foreach ($this->attributes as $attribute) {
            $value = $model->getAttribute($attribute);
            if ($value) {
                $model->setAttribute($attribute, clean($value));
            }
        }
    }
}