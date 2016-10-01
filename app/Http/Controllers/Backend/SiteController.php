<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Entities\BlogPost;
use App\Models\Entities\CatalogProduct;

class SiteController extends Controller
{
    public function index()
    {
        $posts = BlogPost::orderBy('created_at', 'desc')->get();
        $products = CatalogProduct::orderBy('created_at', 'desc')->get();
        return view('backend.index', ['posts' => $posts, 'products' => $products]);
    }
}
