<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    const TYPE_POST = 'post';
    const TYPE_PRODUCT = 'product';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function favorite()
    {
        return $this->morphTo();
    }
}
