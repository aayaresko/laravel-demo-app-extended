<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 20.08.16
 * Time: 18:40
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Components\Extra;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ImageFacade;
use Intervention\Image\Image;

/**
 * Class ImagesTrait
 *
 * Will save image in three different sizes:
 * * normal size
 * * preview size
 * * thumbnail size
 * Each image size can be configured individually.
 * If you don't want to use any of available sizes - you can set corresponding property to false.
 * It can process multiple images.
 * It can store results in object properties or in local `$processed_images` property.
 * `$uploads_path` is default 'root' path for images of all sizes.
 *
 * @package App\Components\Temp
 */
trait StoresImages
{
    /**
     * Images public folder path.
     * @var string
     */
    public $uploads_path = '';
    /**
     * Preview images folder name.
     * @var string
     */
    public $preview_path = 'preview';
    /**
     * Normal size images folder name.
     * @var string
     */
    public $normal_path = 'normal';
    /**
     * Thumbnails folder name.
     * @var string
     */
    public $thumbnail_path = 'thumbnail';
    /**
     * Stores attribute names and associated uploaded instances.
     *
     * @var array
     */
    protected $images_attributes = [];
    /**
     * @var array
     */
    protected $loaded_images = [];
    /**
     * @var array
     */
    protected $processed_images = [];
    /**
     * Normal size options.
     * @var array
     */
    protected $normal_image_options = [
        'width' => 1200
    ];
    /**
     * Preview options.
     * @var array
     */
    protected $preview_image_options = [
        'width' => 550
    ];
    /**
     * Thumbnail options.
     * @var array
     */
    protected $thumbnail_image_options = [
        'width' => 80
    ];

    /**
     * Helper to access processed images.
     *
     * @return array
     */
    public function getProcessedImages()
    {
        return $this->processed_images;
    }

    /**
     * Generates full path to image with normal size.
     *
     * This method should be used to access saved image in public folder.
     * Generates a valid image path which can be used for access image from the web.
     * In default example it will looks something like this: 'http://localhost/uploads/users/normal/57b889d6ac0ee.jpeg'.
     * You can change this path via `$normal_path` property.
     *
     * @param $name
     * @return null|string
     */
    public function getImagePath($name)
    {
        $image_uri = $this->{$name};
        if ($image_uri && is_string($image_uri)) {
            return asset($this->getNormalPath() . '/' . $image_uri);
        }
        return null;
    }

    /**
     * @param int $type
     * @param string $path
     * @return string
     */
    protected function getNormalPath($type = 1, $path = '')
    {
        return ($this->getUploadsPath($type) . DIRECTORY_SEPARATOR . $this->normal_path) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Will return uploads folder path.
     *
     * If `$type` set to 2 - return relative local folder path (e.g. storage/app/public/uploads/user)
     * If `$type` set to 1 - return relative web folder path (e.g. http://demo.com/storage/uploads/users ).
     *
     * @param int $type
     * @return string
     */
    protected function getUploadsPath($type)
    {
        if (!$this->uploads_path) {
            $path = env('UPLOADS_PATH', null);
            if ($path) {
                $this->uploads_path = $path;
            }
        }
        switch ($type) {
            case 1:
                return Storage::url($this->uploads_path);
            case 2:
                return 'public' . DIRECTORY_SEPARATOR . $this->uploads_path;
        }
    }

    /**
     * Generates full path to image with 'preview' size.
     *
     * This method should be used to access saved image in public folder.
     * Generates a valid image path which can be used for access image from the web.
     * In default example it will looks something like this: 'http://localhost/uploads/users/preview/57b889d6ac0ee.jpeg'.
     * You can change this path via `$preview_path` property.
     *
     * @param $name
     * @return mixed
     */
    public function getImagePreviewPath($name)
    {
        $image_uri = $this->{$name};
        if ($image_uri && is_string($image_uri)) {
            return asset($this->getPreviewPath() . DIRECTORY_SEPARATOR . $image_uri);
        }
        return null;
    }

    /**
     * @param int $type
     * @param string $path
     * @return string
     */
    protected function getPreviewPath($type = 1, $path = '')
    {
        return ($this->getUploadsPath($type) . DIRECTORY_SEPARATOR . $this->preview_path) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * Generates full path to 'thumbnail'.
     *
     * This method should be used to access saved image in public folder.
     * Generates a valid image path which can be used for access image from the web.
     * In default example it will looks something like this: 'http://localhost/uploads/users/thumbnail/57b889d6ac0ee.jpeg'.
     * You can change this path via `$thumbnail_path` property.
     *
     * @param $name
     * @return null|string
     */
    public function getImageThumbnailPath($name)
    {
        $image_uri = $this->{$name};
        if ($image_uri && is_string($image_uri)) {
            return asset($this->getThumbnailPath() . DIRECTORY_SEPARATOR . $image_uri);
        }
        return null;
    }

    /**
     * @param int $type
     * @param string $path
     * @return string
     */
    protected function getThumbnailPath($type = 1, $path = '')
    {
        return ($this->getUploadsPath($type) . DIRECTORY_SEPARATOR . $this->thumbnail_path) . ($path ? DIRECTORY_SEPARATOR . $path : '');
    }

    /**
     * @param string $type
     * @param int $width
     * @param int $height
     */
    public function setImageSizes($type, $width = 0, $height = 0)
    {
        $property = "{$type}_image_options";
        if (property_exists($this, $property)) {
            if ($width > 0) {
                $this->{$property}['width'] = $width;
            } elseif ($width === 0 && $height > 0) {
                $this->{$property}['width'] = 0;
            }
            if ($height > 0) {
                $this->{$property}['height'] = $height;
            } elseif ($height === 0 && $width > 0) {
                $this->{$property}['height'] = 0;
            }
        }
    }


    /**
     * Handles each image collection item.
     *
     * For each image:
     * * generates new, random name
     * * resize
     * * save
     * Automatically sets corresponding attribute of the model equal to newly created image path.
     * This path includes only filename and extension.
     *
     * @param string $method
     * @return int
     */
    public function saveImages($method = 'resize')
    {
        $saved = 0;
        $this->ensureDestinationDirectoryExist();
        if (!empty($this->images_attributes)) {
            foreach ($this->images_attributes as $attribute_name => $image) {
                $file_name = $this->saveImageAndGetFileName($image, $method);
                if ($file_name) {
                    $this->{$attribute_name} = $file_name;
                    $saved++;
                }
            }
        }
        if (!empty($this->loaded_images)) {
            foreach ($this->loaded_images as $index => $image) {
                $file_name = $this->saveImageAndGetFileName($image, $method);
                if ($file_name) {
                    $this->processed_images[$index] = $file_name;
                    $saved++;
                }
            }
        }
        return $saved;
    }

    /**
     * Makes sure that all directories which is not null are exist.
     * Automatically pulls upload directory path from local env settings.
     * flysystem AbstractAdapter creates directories only if they are not exist.
     *
     */
    public function ensureDestinationDirectoryExist()
    {
        $path = $this->getNormalPath(2);
        if ($this->normal_path) {
            Storage::makeDirectory($path);
        }
        $path = $this->getPreviewPath(2);
        if ($this->preview_path) {
            Storage::makeDirectory($path);
        }
        $path = $this->getThumbnailPath(2);
        if ($this->thumbnail_path) {
            Storage::makeDirectory($path);
        }
    }

    /**
     * Store image.
     *
     * Store image only if corresponding directory path is set.
     * It can process Illuminate\Support\Collection and Illuminate\Http\UploadedFile instances.
     * Collection must contain Illuminate\Http\UploadedFile instances.
     *
     * @param string $method
     * @param UploadedFile|Collection|Image $item
     * @return string
     */
    protected function saveImageAndGetFileName($item, $method)
    {
        if ($item instanceof Collection) {
            if ($item->get('file')) {
                $uploaded = $item->pull('file');
                $options = $item;
            }
        } elseif ($item instanceof UploadedFile) {
            $uploaded = $item;
            $options = collect();
        }
        if (isset($uploaded) && isset($options)) {
            if (!method_exists($this, $method)) {
                $method = 'resize';
            }
            /** @var UploadedFile $uploaded */
            $file_name = $uploaded->hashName();
            $image = ImageFacade::make($uploaded->getPathname());
        }
        if ($item instanceof Image) {
            $image = $item;
            $file_name = $image->filename . '.' . $image->extension;
        }
        if (isset($file_name) && isset($image)) {
            $visibility = 'public';
            /** @var Image $processed */
            if ($this->normal_path) {
                $processed = $this->{$method}($image, $this->normal_image_options);
                Storage::put($this->getNormalPath(2, $file_name), $processed->getCore(), $visibility);
            }
            if ($this->preview_path) {
                $processed = $this->{$method}($image, $this->preview_image_options);
                Storage::put($this->getPreviewPath(2, $file_name), $processed->getCore(), $visibility);
            }
            if ($this->thumbnail_path) {
                $processed = $this->{$method}($image, $this->thumbnail_image_options);
                Storage::put($this->getThumbnailPath(2, $file_name), $processed->getCore(), $visibility);
            }
            return $file_name;
        }
        return null;
    }

    /**
     * It saves `$data` array in local variable.
     *
     * `$data` array should look like this:
     * ```php
     *  [
     *      'avatar_url' => [
     *          'file' => Illuminate\Http\UploadedFile,
     *          'width' => 100,
     *          'height' => 100,
     *      ],
     *  ]
     * ```
     * Array key is attribute name of the model.
     * Array values are:
     * * uploaded instance
     * * resize width
     * * resize height
     * Each `$data` array should be handled.
     *
     * @param string $attribute_name
     * @param array $data
     */
    public function assignImageToAttribute($attribute_name, array $data)
    {
        $this->images_attributes[$attribute_name] = collect($data);
    }

    /**
     * Stores images to process.
     *
     * @param array $images
     */
    public function loadMultipleImages(array $images)
    {
        $this->loaded_images = $images;
    }

    /**
     * Automates image resizing process.
     *
     * Determines method and parameters of resize based on 'width' and 'height' items of `$options` array.
     * `$options` should look like this:
     * ```php
     *  [
     *      'width' => 100,
     *      'height' => 100,
     *  ]
     * ```
     * If there is both 'width' and 'height' items - uses them to perform image resize.
     * If there is only 'height' - uses it to perform heighten resize.
     * In any other cases - will use the value of 'width' item and perform widen resize.
     *
     * @param Image $image
     * @param array $options
     * @return Image
     */
    protected function resize(Image $image, array $options)
    {
        $options = collect($options);
        $width = $options->get('width');
        $height = $options->get('height');
        if ($width && $height) {
            $image->resize($width, $height);
        } elseif ($height) {
            $image->heighten($height);
        } else {
            $image->widen($width);
        }
        return $image;
    }

    /**
     * Automates image crop process.
     *
     * `$options` should look like this:
     * ```php
     *  [
     *      'width' => 100,
     *      'height' => 100,
     *  ]
     * ```
     * Both width and height are required.
     *
     * @param Image $image
     * @param array $options
     * @return Image
     */
    protected function crop(Image $image, array $options)
    {
        $options = collect($options);
        $width = $options->get('width');
        $height = $options->get('height');
        if ($width && $height) {
            $image->crop($width, $height);
        }
        return $image;
    }
}