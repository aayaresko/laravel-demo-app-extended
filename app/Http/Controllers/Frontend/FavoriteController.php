<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Entities\Account;
use App\Models\Entities\BlogPost;
use App\Models\Entities\CatalogProduct;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function likeBlogPost(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $model = BlogPost::findOrFail($id);
            $account = $request->user();
            if ($account) {
                /** @var Account $account */
                $account->favoritePosts()->toggle($model);
                return count($model->userFavorites);
            }
        }
        return response(404);
    }

    public function likeCatalogProduct(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->input('id');
            $model = CatalogProduct::findOrFail($id);
            $account = $request->user();
            if ($account) {
                /** @var Account $account */
                $account->favoriteProducts()->toggle($model);
                return count($model->userFavorites);
            }
        }
        return response(404);
    }
}
