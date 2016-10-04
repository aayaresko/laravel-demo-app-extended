<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Entities\Account;
use App\Models\Entities\BlogCategory;
use App\Models\Entities\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    public function index($category = null)
    {
        $models = BlogPost::orderBy('created_at', 'desc')
            ->whereHas('categories', function ($query) use ($category) {
                if ($category) {
                    $query->where('alias_name', $category);
                }
            })
            ->paginate(6);
        return view('backend.blog-post.index', ['models' => $models]);
    }

    public function create()
    {
        $authors = Account::all()->pluck('nickname', 'id');
        $categories = BlogCategory::all()->pluck('alias_name', 'id');
        $model = new BlogPost();
        return view('backend.blog-post.create', ['model' => $model, 'authors' => $authors, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $model = new BlogPost($request->all());
        $this->validate($request, [
            'title' => "required|string|max:255|unique:{$model->getTable()},title",
            'content' => 'required|string',
            'preview_image_url' => 'image|max:1024',
        ]);
        $preview = $request->file('preview');
        if ($preview) {
            $model->assignImageToAttribute('preview_image_url', ['file' => $preview]);
            $model->saveImages();
        }
        $model->save();
        $model->categories()->sync($request->input('categories'));
        return redirect()->route('backend.blog-post.index')->with('success', trans('models.saved'));
    }

    public function show($identifier)
    {
        if (!(int)$identifier) {
            $model = BlogPost::where('alias_name', $identifier)->firstOrFail();
        } else {
            $model = BlogPost::findOrFail($identifier);
        }
        return view('backend.blog-post.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = BlogPost::findOrFail($id);
        $authors = Account::all()->pluck('nickname', 'id');
        $categories = BlogCategory::all()->pluck('alias_name', 'id');
        return view('backend.blog-post.update', ['model' => $model, 'authors' => $authors, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $model = BlogPost::findOrFail($id);
        /** @var BlogPost $model */
        $model->fill($request->all());
        $requirements = [
            'content' => 'required|string',
            'image_url' => 'image|max:1024',
        ];
        if ($model->isDirty('title')) {
            $requirements['title'] = "required|string|max:255|unique:{$model->getTable()},title";
        }
        $this->validate($request, $requirements);
        $preview = $request->file('preview');
        if ($preview) {
            $model->assignImageToAttribute('preview_image_url', ['file' => $preview]);
            $model->saveImages();
        }
        $model->save();
        $model->categories()->sync($request->input('categories'));
        return redirect()->route('backend.blog-post.edit', $model->id)->with('success', trans('models.updated'));
    }

    public function destroy(Request $request, $id)
    {
        $model = BlogPost::findOrFail($id);
        $model->delete();
        if (!$request->ajax()) {
            return redirect()->route('backend.blog-post.index')->with('success', trans('models.deleted'));
        }
    }
}
