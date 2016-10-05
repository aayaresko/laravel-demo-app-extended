<?php

namespace App\Http\Controllers\REST;

use App\Models\Entities\Account;
use App\Models\Entities\Task;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class TaskController.
 *
 * @package App\Http\Controllers\REST
 */
class TaskController extends Controller
{
    // 200 (OK) if the response includes an entity describing the status,
    // 202 (Accepted) if the action has not yet been enacted, or
    // 204 (No Content) if the action has been enacted but the response does not include an entity

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Task::with('author.profile')->orderBy('created_at', 'asc')->get();
        return response($models);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response([], 501);
    }

    /**
     * Store a newly created resource in storage.
     *
     * response codes: 200; 204.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $account = $request->user();
        /** @var $account Account */
        $account->tasks()->create($request->all());
        return response([], 204);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Task::with('author.profile')->findOrFail($id);
        return response($model);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response([], 501);
    }

    /**
     * Update the specified resource in storage.
     *
     * response codes:
     * 200 or 204 - updated;
     * 201 - created;
     * 501 - unknown header.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = Task::firstOrNew(['id' => $id]);
        /** @var Model $model */
        $model->fill($request->all());
        if ($model->exists) {
            $code = 204;
        } else {
            $code = 201;
        }
        $model->save();
        return response([], $code);

    }

    /**
     * Remove the specified resource from storage.
     *
     * response codes: 200; 204.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Task::findOrFail($id);
        /** @var Model $model */
        $model->delete();
        return response([], 204);
    }
}
