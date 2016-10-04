<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogProduct;
use App\Models\Entities\CatalogProductProperty;
use Illuminate\Http\Request;

class ProductPropertiesController extends Controller
{
    public function edit($id)
    {
        $model = CatalogProduct::findOrFail($id);
        $available_properties = CatalogProductProperty::all()->pluck('value_label', 'id');
        return view('backend.catalog-product-properties.update', ['model' => $model, 'available_properties' => $available_properties]);
    }

    public function store(Request $request, $id)
    {
        $model = CatalogProduct::findOrFail($id);
        /** @var CatalogProduct $model */
        $model->properties()->sync($request->input('properties'));
        return redirect()->route('backend.catalog-product.edit', $model->id)->with('success', trans('models.saved'));
    }
}
