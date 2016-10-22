<?php

namespace App\Http\Controllers\Backend;

use aayaresko\table\TablesFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogFilterCategory;
use Illuminate\Http\Request;

class CatalogFilterCategoryController extends Controller
{
    public function index()
    {
        $models = CatalogFilterCategory::paginate(12);
        $table = new TablesFacade($models, ['visible_name', 'alias_name', 'description', 'created'], 'backend.catalog-filter-category');
        return view('backend.catalog-filter-category.index', ['table' => $table]);
    }

    public function create()
    {
        $model = new CatalogFilterCategory();
        return view('backend.catalog-filter-category.create', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $model = new CatalogFilterCategory($request->all());
        $this->validate($request, [
            'visible_name' => "required|string|max:255|unique:{$model->getTable()},visible_name",
            'alias_name' => "required|string|max:255|unique:{$model->getTable()},alias_name",
            'description' => 'string',
        ]);
        $model->save();
        return redirect()->route('backend.catalog-filter-category.index')->with('success', trans('models.saved'));
    }

    public function show($id)
    {
        $model = CatalogFilterCategory::findOrFail($id);
        return view('backend.catalog-filter-category.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = CatalogFilterCategory::findOrFail($id);
        return view('backend.catalog-filter-category.update', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $model = CatalogFilterCategory::findOrFail($id);
        /** @var CatalogFilterCategory $model */
        $model->fill($request->all());
        $requirements = [
            'description' => 'string',
        ];
        if ($model->isDirty('visible_name')) {
            $requirements['visible_name'] = "required|string|max:255|unique:{$model->getTable()},visible_name";
        }
        if ($model->isDirty('alias_name')) {
            $requirements['alias_name'] = "required|string|max:255|unique:{$model->getTable()},alias_name";
        }
        $this->validate($request, $requirements);
        $model->save();
        return redirect()->route('backend.catalog-filter-category.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = CatalogFilterCategory::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.catalog-filter-category.index')->with('success', trans('models.deleted'));
        }
    }
}
