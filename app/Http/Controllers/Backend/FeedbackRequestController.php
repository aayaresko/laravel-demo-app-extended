<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Entities\ContactMessage;
use Illuminate\Http\Request;

class FeedbackRequestController extends Controller
{
    public function index()
    {
        $models = ContactMessage::paginate(6);
        return view('backend.feedback-request.index', ['models' => $models]);
    }

    public function show($id)
    {
        $model = ContactMessage::findOrFail($id);
        return view('backend.feedback-request.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = ContactMessage::findOrFail($id);
        return view('backend.feedback-request.update', ['model' => $model]);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'content' => 'required|string',
        ]);
        $model = ContactMessage::findOrFail($id);
        /** @var ContactMessage $model */
        $model->fill($request->all());
        $model->save();
        return redirect()->route('backend.feedback-request.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = ContactMessage::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.feedback-request.index')->with('success', trans('models.deleted'));
        }
    }
}
