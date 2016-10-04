<?php
/**
 * Created by PhpStorm.
 * User: aayaresko
 * Date: 18.08.16
 * Time: 17:25
 *
 * @author Andrey Yaresko <aayaresko@gmail.com>
 */

namespace App\Http\Controllers\Backend;

use App\Components\Facades\TablesFacade;
use App\Http\Controllers\Controller;
use App\Models\Entities\CatalogCategory;
use Illuminate\Http\Request;

class CatalogCategoryController extends Controller
{
    public function index()
    {
        $models = CatalogCategory::paginate(12);
        $table = new TablesFacade($models, ['visible_name', 'alias_name', 'description', 'created'], 'backend.catalog-category');
        return view('backend.catalog-category.index', ['table' => $table]);
    }

    public function create()
    {
        $model = new CatalogCategory();
        return view('backend.catalog-category.create', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $model = new CatalogCategory($request->all());
        $this->validate($request, [
            'visible_name' => "required|string|max:255|unique:{$model->getTable()},visible_name",
            'description' => 'string',
        ]);
        $model->save();
        return redirect()->route('backend.catalog-category.index')->with('success', trans('models.saved'));
    }

    public function show($id)
    {
        $model = CatalogCategory::findOrFail($id);
        return view('backend.catalog-category.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = CatalogCategory::findOrFail($id);
        return view('backend.catalog-category.update', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $model = CatalogCategory::findOrFail($id);
        /** @var CatalogCategory $model */
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
        return redirect()->route('backend.catalog-category.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = CatalogCategory::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.catalog-category.index')->with('success', trans('models.deleted'));
        }
    }
}