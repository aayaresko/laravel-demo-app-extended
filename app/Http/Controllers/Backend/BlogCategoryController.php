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
use App\Models\Entities\BlogCategory;
use Illuminate\Http\Request;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $models = BlogCategory::paginate(20);
        $table = new TablesFacade($models, ['visible_name', 'alias_name', 'description', 'created'], 'backend.blog-category');
        return view('backend.blog-category.index', ['table' => $table]);
    }

    public function create()
    {
        $model = new BlogCategory();
        return view('backend.blog-category.create', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $model = new BlogCategory($request->all());
        $this->validate($request, [
            'visible_name' => "required|string|max:255|unique:{$model->getTable()},visible_name",
        ]);
        $model->save();
        return redirect()->route('backend.blog-category.index')->with('success', trans('models.saved'));
    }

    public function show($id)
    {
        $model = BlogCategory::findOrFail($id);
        return view('backend.blog-category.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = BlogCategory::findOrFail($id);
        return view('backend.blog-category.update', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $model = BlogCategory::findOrFail($id);
        /** @var BlogCategory $model */
        $model->fill($request->all());
        if ($model->isDirty('visible_name')) {
            $requirements['visible_name'] = "required|string|max:255|unique:{$model->getTable()},visible_name";
            $this->validate($request, $requirements);
        }
        $model->save();
        return redirect()->route('backend.blog-category.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = BlogCategory::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.blog-category.index')->with('success', trans('models.deleted'));
        }
    }
}