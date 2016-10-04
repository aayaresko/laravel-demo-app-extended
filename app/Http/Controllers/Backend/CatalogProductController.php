<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 02.09.16
 * Time: 11:03
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Entities\Account;
use App\Models\Entities\CatalogCategory;
use App\Models\Entities\CatalogProduct;
use Illuminate\Http\Request;

class CatalogProductController extends Controller
{
    public function index()
    {
        $models = CatalogProduct::paginate(6);
        return view('backend.catalog-product.index', ['models' => $models]);
    }

    public function create()
    {
        $authors = Account::all()->pluck('nickname', 'id');
        $categories = CatalogCategory::all()->pluck('visible_name', 'id');
        $model = new CatalogProduct();
        return view('backend.catalog-product.create', [
            'model' => $model,
            'authors' => $authors,
            'categories' => $categories,
        ]);
    }

    public function store(Request $request)
    {
        $model = new CatalogProduct($request->all());
        $this->validate($request, [
            'visible_name' => "required|string|max:255|unique:{$model->getTable()},visible_name",
            'alias_name' => "required|string|max:255|unique:{$model->getTable()},alias_name",
            'description' => 'string',
            'image_url' => 'image|max:1024',
        ]);
        $preview = $request->file('preview');
        if ($preview) {
            $model->assignImageToAttribute('image_url', ['file' => $preview]);
            $model->saveImages();
        }
        $model->save();
        $model->categories()->sync($request->input('categories'));
        return redirect()->route('backend.index')->with('success', trans('models.saved'));
    }

    public function show($identifier)
    {
        if (!(int)$identifier) {
            $model = CatalogProduct::where('alias_name', $identifier)->firstOrFail();
        } else {
            $model = CatalogProduct::findOrFail($identifier);
        }
        return view('backend.catalog-product.show', ['model' => $model, 'images' => $model->images, 'properties' => $model->properties]);
    }

    public function edit($id)
    {
        $model = CatalogProduct::findOrFail($id);
        $authors = Account::all()->pluck('nickname', 'id');
        $categories = CatalogCategory::all()->pluck('visible_name', 'id');
        return view('backend.catalog-product.update', [
            'model' => $model,
            'authors' => $authors,
            'categories' => $categories,
            'images' => $model->images,
            'properties' => $model->properties
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = CatalogProduct::findOrFail($id);
        /** @var CatalogProduct $model */
        $model->fill($request->all());
        $requirements = [
            'description' => 'string',
            'image_url' => 'image|max:1024',
        ];
        if ($model->isDirty('visible_name')) {
            $requirements['visible_name'] = "required|string|max:255|unique:{$model->getTable()},visible_name";
        }
        if ($model->isDirty('alias_name')) {
            $requirements['alias_name'] = "required|string|max:255|unique:{$model->getTable()},alias_name";
        }
        $this->validate($request, $requirements);
        $preview = $request->file('preview');
        if ($preview) {
            $model->assignImageToAttribute('image_url', ['file' => $preview]);
            $model->saveImages();
        }
        $model->save();
        $model->categories()->sync($request->input('categories'));
        return redirect()->route('backend.catalog-product.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = CatalogProduct::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.catalog-product.index')->with('success', trans('models.deleted'));
        }
    }
}