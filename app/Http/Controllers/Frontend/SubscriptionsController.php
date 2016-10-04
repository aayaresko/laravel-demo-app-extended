<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionsController extends Controller
{
    public function edit()
    {
        if ($account = Auth::user()) {
            $model = $account->subscriptions;
            return view('frontend.subscriptions.update', ['model' => $model]);
        }
        return redirect()->route('not-found');
    }

    public function update(Request $request)
    {
        if ($account = $request->user()) {
            $model = $account->subscriptions;
            $model->fill($request->all());
            $model->save();
            return redirect()->route('frontend.subscriptions.edit')->with('success', trans('models.updated'));
        }
        return redirect()->route('not-found');
    }
}
