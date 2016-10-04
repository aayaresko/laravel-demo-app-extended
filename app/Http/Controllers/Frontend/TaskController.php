<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Entities\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    public function index()
    {
        $models = Task::orderBy('created_at')->paginate(6);
        return view('frontend.task.index', ['models' => $models]);
    }

    public function create()
    {
        $model = new Task();
        $this->authorize('create', $model);
        return view('frontend.task.create', ['model' => $model]);
    }

    public function store(Request $request)
    {
        $model = new Task($request->all());
        $this->authorize('create', $model);
        $this->validate($request, [
            'title' => "required|string|max:255|unique:{$model->getTable()},title",
            'content' => 'required|string',
        ]);
        $model->author()->associate($request->user());
        $model->save();
        return redirect()->route('frontend.task.index')->with('success', trans('models.saved'));
    }

    public function show($id)
    {
        $model = Task::findOrFail($id);
        return view('frontend.task.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = Task::findOrFail($id);
        $this->authorize('update-own-task', $model);
        return view('frontend.task.update', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $model = Task::findOrFail($id);
        /** @var Task $model */
        $this->authorize('update-own-task', $model);
        $model->fill($request->all());
        $requirements = [
            'content' => 'required|string',
        ];
        if ($model->isDirty('title')) {
            $requirements['title'] = "required|max:120|unique:{$model->getTable()},title";
        }
        $this->validate($request, $requirements);
        $model->save();
        return redirect()->route('frontend.task.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = Task::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('frontend.task.index')->with('success', trans('models.deleted'));
        }
    }
}
