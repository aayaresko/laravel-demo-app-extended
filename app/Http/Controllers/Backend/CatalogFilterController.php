<?php

namespace App\Http\Controllers\Backend;

use App\Components\Facades\TablesFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogCategory;
use App\Models\Entities\CatalogFilter;
use App\Models\Entities\CatalogFilterCategory;
use Illuminate\Http\Request;

class CatalogFilterController extends Controller
{
    public function index()
    {
        $models = CatalogFilter::paginate(20);
        $table = new TablesFacade(
            $models,
            ['title', 'type', 'leftProperty.value', 'rightProperty.value', 'category.visible_name', 'catalogCategory.visible_name', 'created'],
            'backend.catalog-filter'
        );
        return view('backend.catalog-filter.index', ['table' => $table]);
    }

    public function create()
    {
        $model = new CatalogFilter();
        $types = CatalogFilter::getTypes();
        $catalog_categories = CatalogCategory::all()->pluck('visible_name', 'id');
        $categories = CatalogFilterCategory::all();
        $property_values = $categories->first()->properties;
        $property_values->prepend(['visible_name' => 'unselected'], null);
        $property_values = $property_values->pluck('visible_name', 'id');
        $categories = $categories->pluck('visible_name', 'id');
        return view('backend.catalog-filter.create', [
            'model' => $model,
            'types' => $types,
            'property_values' => $property_values,
            'categories' => $categories,
            'catalog_categories' => $catalog_categories
        ]);
    }

    public function store(Request $request)
    {
        $model = new CatalogFilter($request->all());
        $this->validate($request, [
            'title' => "required|string|max:255|unique:{$model->getTable()},title",
        ]);
        $model->save();
        return redirect()->route('backend.catalog-filter.index')->with('success', trans('models.saved', ['name' => 'Catalog filter']));
    }

    public function show($id)
    {
        $model = CatalogFilter::findOrFail($id);
        return view('backend.catalog-filter.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = CatalogFilter::findOrFail($id);
        $types = CatalogFilter::getTypes();
        $property_values = $model->category->properties()->get();
        $property_values->prepend(['visible_name' => 'unselected'], null);
        $property_values = $property_values->pluck('visible_name', 'id');
        $categories = CatalogFilterCategory::all()->pluck('visible_name', 'id');
        $catalog_categories = CatalogCategory::all()->pluck('visible_name', 'id');
        return view('backend.catalog-filter.update', [
            'model' => $model,
            'types' => $types,
            'property_values' => $property_values,
            'categories' => $categories,
            'catalog_categories' => $catalog_categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $model = CatalogFilter::findOrFail($id);
        /** @var CatalogFilter $model */
        $model->fill($request->all());
        if ($model->isDirty('alias_name')) {
            $requirements['title'] = "required|string|max:255|unique:{$model->getTable()},title";
            $this->validate($request, $requirements);
        }
        $model->save();
        return redirect()->route('backend.catalog-filter.edit', $model->id)->with('success', trans('models.updated', ['name' => 'Catalog filter']));
    }

    public function destroy(Request $request, $id)
    {
        $model = CatalogFilter::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.catalog-filter.index')->with('success', trans('models.deleted', ['name' => 'Catalog filter']));
        }
    }
}