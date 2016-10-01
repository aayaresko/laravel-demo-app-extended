<?php
/**
 * Copyright (c) 2016  Andrey Yaresko.
 */

namespace App\Http\Controllers\Frontend;

use App\Components\Extra\SiteFeatures;
use App\Http\Controllers\Controller;
use App\Models\Entities\BlogPost;
use App\Models\Entities\ContactMessage;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    use SiteFeatures;

    public function postFeedback(Request $request)
    {
        $this->validate($request, [
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|email|max:255',
            'content' => 'required|string',
        ]);
        $model = new ContactMessage($request->all());
        $model->fill($request->all());
        $model->save();
        return redirect()->route('frontend.feedback')->with('success', trans('models.saved', ['name' => 'Contact message']));
    }

    public function showArticle($identifier)
    {
        if (!(int)($identifier)) {
            $model = BlogPost::where('alias_name', $identifier)->firstOrFail();
        } else {
            $model = BlogPost::findOrFail($identifier);
        }
        return view('frontend.article', ['model' => $model]);
    }
}
