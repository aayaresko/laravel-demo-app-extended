<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 02.09.16
 * Time: 15:34
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogProduct;
use App\Models\Entities\CatalogProductImage;
use Illuminate\Http\Request;

class ProductImagesController extends Controller
{
    public function edit($id)
    {
        $model = CatalogProduct::findOrFail($id);
        return view('backend.catalog-product-images.update', ['model' => $model, 'images' => $model->images]);
    }

    public function store(Request $request, $id)
    {
        $model = CatalogProduct::findOrFail($id);
        /** @var CatalogProduct $model */
        $old_images = $request->input('assigned_images');
        $new_images = $request->file('uploaded_images');
        $model->loadMultipleImages($new_images);
        $model->setImageSizes('preview', 500);
        $model->saveImages();
        foreach ($model->getProcessedImages() as $item) {
            $image = new CatalogProductImage();
            $image->url = $item;
            $model->images()->save($image);
            $old_images[] = $image->id;
        }
        $query = $model->images();
        if ($old_images) {
            $query->whereNotIn('id', $old_images)->delete();
        } else {
            $query->delete();
        }
        return redirect()->route('backend.catalog-product-images.edit', $model->id)->with('success', trans('models.updated', ['name' => 'Catalog product images']));
    }
}