<?php

namespace App\Http\Controllers\Backend;

use aayaresko\table\TablesFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogFilterCategory;
use App\Models\Entities\CatalogProductProperty;
use Collective\Html\FormFacade;
use Illuminate\Http\Request;

class CatalogProductPropertyController extends Controller
{
    public function index()
    {
        $models = CatalogProductProperty::paginate(20);
        $table = new TablesFacade($models, ['id', 'visible_name', 'value', 'category.visible_name', 'created'], 'backend.catalog-product-property');
        return view('backend.catalog-product-property.index', ['table' => $table]);
    }

    public function create()
    {
        $model = new CatalogProductProperty();
        $categories = CatalogFilterCategory::all()->pluck('visible_name', 'id');
        return view('backend.catalog-product-property.create', ['model' => $model, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $model = new CatalogProductProperty($request->all());
        $this->validate($request, [
            'visible_name' => "required|string|max:255|unique:{$model->getTable()},visible_name",
        ]);
        $model->save();
        return redirect()->route('backend.catalog-product-property.index')->with('success', trans('models.saved'));
    }

    public function show($id)
    {
        $model = CatalogProductProperty::findOrFail($id);
        return view('backend.catalog-product-property.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = CatalogProductProperty::findOrFail($id);
        $categories = CatalogFilterCategory::all()->pluck('visible_name', 'id');
        return view('backend.catalog-product-property.update', ['model' => $model, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $model = CatalogProductProperty::findOrFail($id);
        /** @var CatalogProductProperty $model */
        $model->fill($request->all());
        $requirements = [
            'description' => 'string',
        ];
        if ($model->isDirty('visible_name')) {
            $requirements['visible_name'] = "required|string|max:255|unique:{$model->getTable()},visible_name";
        }
        $this->validate($request, $requirements);
        $model->save();
        return redirect()->route('backend.catalog-product-property.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = CatalogProductProperty::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.catalog-product-property.index')->with('success', trans('models.deleted'));
        }
    }

    public function generateDropdown(Request $request)
    {
        if ($request->ajax()) {
            $category_id = $request->input('category_id');
            if ($category_id) {
                $category = CatalogFilterCategory::findOrFail($category_id);
                if ($category) {
                    $property_values = $category->properties()->get();
                    $property_values->prepend(['visible_name' => 'unselected'], null);
                    $property_values = $property_values->pluck('visible_name', 'id');
                    return FormFacade::select('property', $property_values, null, ['class' => 'form-control', 'id' => 'property']);
                }
            }
        }
    }
}
