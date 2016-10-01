<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 18.09.16
 * Time: 21:49
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Observers;

use App\Components\Extra\StoresImages;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;


class DefaultImageObserver
{
    use StoresImages;

    public $image_attribute_name = 'avatar_url';
    public $default_image_name = 'unknown.png';

    /**
     * Sticky default image.
     *
     * If `$model` attribute with image name, specified in `$image_attribute_name`, is empty - makes it equal to `$default_image_name`.
     * Automatically publishes image with name, specified in `$default_image_name`:
     * * creates an image of 'thumbnail' size
     * * creates an image of 'preview' size
     * * creates an image of 'normal' size
     * * stores images in 'thumbnail' directory, 'preview' directory and 'normal' directory respectively
     * Make sure that `$default_image_name` exists.
     *
     * @param Model $model
     */
    public function saving(Model $model)
    {
        $file_name = $model->getAttribute($this->image_attribute_name);
        if (
            (!$file_name) ||
            (!Storage::has($this->getNormalPath(2, $file_name)))
        ) {
            if (
                (Storage::has("public/application/{$this->default_image_name}")) &&
                (!Storage::has($this->getNormalPath(2, $this->default_image_name)))
            ) {
                try {
                    /** @var Image $image */
                    $image = ImageFacade::make(storage_path("app/public/application/{$this->default_image_name}"));
                    $this->loadMultipleImages([$image]);
                    $this->saveImages();
                } catch (\RuntimeException $exception) {
                    logger($exception->getMessage());
                }
            }
            $model->setAttribute($this->image_attribute_name, $this->default_image_name);
        }
    }
}