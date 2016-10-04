<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Entities\Account;
use App\Models\Entities\BlogCategory;
use App\Models\Entities\BlogPost;
use Illuminate\Http\Request;

class BlogPostController extends Controller
{
    /**
     * AccountController constructor.
     *
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index($category = null)
    {
        $models = BlogPost::orderBy('created_at', 'desc')
            ->whereHas('categories', function ($query) use ($category) {
                $query->blog();
                if ($category) {
                    $query->where('alias_name', $category);
                }
            })
            ->paginate(6);
        return view('frontend.blog-post.index', ['models' => $models]);
    }

    public function create()
    {
        $model = new BlogPost();
        $this->authorize('create', $model);
        $authors = Account::all()->pluck('nickname', 'id');
        $categories = BlogCategory::all()->pluck('alias_name', 'id');
        return view('frontend.blog-post.create', ['model' => $model, 'authors' => $authors, 'categories' => $categories]);
    }

    public function store(Request $request)
    {
        $model = new BlogPost($request->all());
        $this->authorize('create', $model);
        $this->validate($request, [
            'title' => "required|string|max:255|unique:{$model->getTable()},title",
            'content' => 'required|string',
            'preview_image_url' => 'image|max:1024',
        ]);
        $model->author()->associate($request->user());
        $preview = $request->file('preview');
        if ($preview) {
            $model->assignImageToAttribute('preview_image_url', ['file' => $preview]);
            $model->setImageSizes('normal', 2048);
            $model->setImageSizes('preview', 800);
            $model->saveImages();
        }
        $model->save();
        $model->categories()->sync($request->input('categories'));
        return redirect()->route('frontend.blog-post.index')->with('success', trans('models.saved'));
    }

    public function show($identifier)
    {
        if (!(int)$identifier) {
            $model = BlogPost::where('alias_name', $identifier)->firstOrFail();
        } else {
            $model = BlogPost::findOrFail($identifier);
        }
        return view('frontend.blog-post.show', ['model' => $model]);
    }

    public function edit($id)
    {
        $model = BlogPost::findOrFail($id);
        $categories = BlogCategory::all()->pluck('alias_name', 'id');
        $this->authorize('update-own-post', $model);
        return view('frontend.blog-post.update', ['model' => $model, 'categories' => $categories]);
    }

    public function update(Request $request, $id)
    {
        $model = BlogPost::findOrFail($id);
        /** @var BlogPost $model */
        $this->authorize('update-own-post', $model);
        $model->fill($request->all());
        $requirements = [
            'content' => 'required|string',
            'image_url' => 'image|max:1024',
        ];
        if ($model->isDirty('title')) {
            $requirements['title'] = "required|max:120|unique:{$model->getTable()},title";
        }
        $this->validate($request, $requirements);
        $preview = $request->file('preview');
        if ($preview) {
            $model->assignImageToAttribute('preview_image_url', ['file' => $preview]);
            $model->setImageSizes('normal', 2048);
            $model->setImageSizes('preview', 800);
            $model->saveImages();
        }
        $model->save();
        $model->categories()->sync($request->input('categories'));
        return redirect()->route('frontend.blog-post.edit', $model->id)->with('success', trans('models.updated'));
    }
}
