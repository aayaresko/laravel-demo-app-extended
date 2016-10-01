<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 07.09.16
 * Time: 14:06
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Observers;

use App\Models\Entities\CatalogFilter;

class CatalogFilterObserver
{
    /**
     * Reverts values to null if they are not specified
     *
     * @param CatalogFilter $model
     */
    public function saving(CatalogFilter $model)
    {
        if (!$model->left_property_id) {
            $model->left_property_id = null;
        }
        if (!$model->right_property_id) {
            $model->right_property_id = null;
        }
    }
}