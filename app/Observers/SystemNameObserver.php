<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 07.09.16
 * Time: 14:36
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use IvanLemeshev\Laravel5CyrillicSlug\SlugFacade as Slug;

class SystemNameObserver
{
    /**
     * Fill model attributes with specific values.
     *
     * Creates new 'alias_name' attributes for `$model` if one is not set.
     *
     * @param Model $model
     */
    public function saving(Model $model)
    {
        $visible_name = $model->getAttributeValue('visible_name');
        $alias_name = $model->getAttributeValue('alias_name');
        if (!$visible_name) {
            $visible_name = $model->getAttributeValue('title');
        }
        if (!$alias_name) {
            if ($visible_name) {
                $value = Slug::make($visible_name);
            } else {
                $value = uniqid('c');
            }
            $model->setAttribute('alias_name', $value);
        }
    }
}