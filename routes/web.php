<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});
Route::get('/home', function () {
    return view('frontend.index');
});
Route::get('/index', function () {
    return view('frontend.index');
});

Route::get('auth/github', [
    'uses' => 'Auth\GithubController@redirectToProvider',
    'as' => 'auth.github'
]);
Route::get('auth/github/callback', 'Auth\GithubController@handleProviderCallback');
Route::get('auth/facebook', [
    'uses' => 'Auth\FacebookController@redirectToProvider',
    'as' => 'auth.facebook'
]);
Route::get('auth/facebook/callback', 'Auth\FacebookController@handleProviderCallback');
Route::get('auth/google', [
    'uses' => 'Auth\GoogleController@redirectToProvider',
    'as' => 'auth.google'
]);
Route::get('auth/google/callback', 'Auth\GoogleController@handleProviderCallback');
Route::get('auth/vkontakte', [
    'uses' => 'Auth\VkontakteController@redirectToProvider',
    'as' => 'auth.vkontakte'
]);
Route::get('auth/vkontakte/callback', 'Auth\VkontakteController@handleProviderCallback');

Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->where('token', '[0-9a-f]+');

Route::get('login', [
    'uses' => 'Auth\LoginController@showLoginForm',
    'as' => 'auth.login'
]);
Route::post('login', [
    'uses' => 'Auth\LoginController@login',
    'as' => 'auth.login'
]);
Route::get('logout', [
    'uses' => 'Auth\LoginController@logout',
    'as' => 'auth.logout'
]);

Route::group(['namespace' => 'Frontend'], function () {
    Route::post('update-browser-timezone-offset', [
        'uses' => 'SiteController@updateBrowserTimezoneOffset',
    ]);

    Route::get('{locale}/update-locale', [
        'uses' => 'SiteController@updateLocale',
        'as' => 'frontend.update-locale'
    ]);

    Route::post('like-blog-post', [
        'uses' => 'FavoriteController@likeBlogPost',
        'as' => 'frontend.like-blog-post'
    ]);

    Route::post('like-catalog-product', [
        'uses' => 'FavoriteController@likeCatalogProduct',
        'as' => 'frontend.like-catalog-product'
    ]);
});

Route::group(['prefix' => Language::getLocale()], function () {

    Route::get('/', function () {
        return view('frontend.index');
    })->name('frontend.index');
    Route::get('index', function () {
        return view('frontend.index');
    })->name('frontend.index');
    Route::get('home', function () {
        return view('frontend.index');
    })->name('frontend.index');
    Route::get('feedback', function () {
        return view('frontend.feedback-request.index');
    })->name('frontend.feedback');
    Route::get('not-allowed', function () {
        return view('frontend.not-allowed');
    })->name('frontend.not-allowed');

    Route::get('login', [
        'uses' => 'Auth\LoginController@showLoginForm',
        'as' => 'auth.login'
    ]);
    Route::post('login', [
        'uses' => 'Auth\LoginController@login',
        'as' => 'auth.login'
    ]);
    Route::get('logout', [
        'uses' => 'Auth\LoginController@logout',
        'as' => 'auth.logout'
    ]);

    Route::group(['prefix' => 'password'], function () {
        Route::get('request', [
            'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm',
            'as' => 'password.request',
        ]);
        Route::post('request', [
            'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail',
            'as' => 'password.request',
        ]);
        Route::get('reset/{token}', [
            'uses' => 'Auth\ResetPasswordController@showResetForm',
            'as' => 'password.reset',
        ])->where('token', '[0-9a-f]+');
        Route::post('reset', [
            'uses' => 'Auth\ResetPasswordController@reset',
            'as' => 'password.reset',
        ]);

    });

    Route::group(['namespace' => 'Frontend'], function () {
        Route::post('feedback', [
            'uses' => 'SiteController@postFeedback',
            'as' => 'frontend.feedback',
        ]);

        Route::get('article/show/{identifier}', [
            'uses' => 'SiteController@showArticle',
            'as' => 'frontend.article.show',
        ]);

        Route::group(['prefix' => 'account'], function () {
            Route::get('confirm/{token}', [
                'uses' => 'AccountController@confirm',
                'as' => 'frontend.account.confirm'
            ]);
            Route::get('create', [
                'uses' => 'AccountController@create',
                'as' => 'frontend.account.create'
            ]);
            Route::post('store', [
                'uses' => 'AccountController@store',
                'as' => 'frontend.account.store'
            ]);

            Route::group(['middleware' => 'auth'], function () {
                Route::get('/', [
                    'uses' => 'AccountController@edit',
                    'as' => 'frontend.account.edit'
                ]);
                Route::get('edit', [
                    'uses' => 'AccountController@edit',
                    'as' => 'frontend.account.edit'
                ]);
                Route::post('update', [
                    'uses' => 'AccountController@update',
                    'as' => 'frontend.account.update'
                ]);
                Route::get('show/{id}', [
                    'uses' => 'AccountController@show',
                    'as' => 'frontend.account.show'
                ]);
            });
        });

        Route::group(['prefix' => 'catalog-product'], function () {
            Route::get('show/{product}', [
                'uses' => 'CatalogProductController@show',
                'as' => 'frontend.catalog-product.show'
            ]);
            Route::get('index/{category?}/{filter?}', [
                'uses' => 'CatalogProductController@index',
                'as' => 'frontend.catalog-product.index'
            ]);
        });

        Route::group(['prefix' => 'blog-post'], function () {
            Route::get('index/{category?}', [
                'uses' => 'BlogPostController@index',
                'as' => 'frontend.blog-post.index'
            ]);
            Route::get('show/{id}', [
                'uses' => 'BlogPostController@show',
                'as' => 'frontend.blog-post.show'
            ]);

            Route::group(['middleware' => 'auth'], function () {
                Route::get('create', [
                    'uses' => 'BlogPostController@create',
                    'as' => 'frontend.blog-post.create'
                ]);
                Route::post('store', [
                    'uses' => 'BlogPostController@store',
                    'as' => 'frontend.blog-post.store'
                ]);
                Route::get('edit/{id}', [
                    'uses' => 'BlogPostController@edit',
                    'as' => 'frontend.blog-post.edit'
                ]);
                Route::post('update/{id}', [
                    'uses' => 'BlogPostController@update',
                    'as' => 'frontend.blog-post.update'
                ]);
            });
        });

        Route::group(['middleware' => 'auth', 'prefix' => 'live-chat'], function () {
            Route::get('index', [
                'uses' => 'LiveChatController@index',
                'as' => 'frontend.live-chat.index',
            ]);
        });

        Route::group(['prefix' => 'subscriptions'], function () {
            Route::group(['middleware' => 'auth'], function () {
                Route::get('edit', [
                    'uses' => 'SubscriptionsController@edit',
                    'as' => 'frontend.subscriptions.edit'
                ]);
                Route::post('update', [
                    'uses' => 'SubscriptionsController@update',
                    'as' => 'frontend.subscriptions.update'
                ]);
            });
        });

    });

    Route::group(['namespace' => 'Backend', 'middleware' => 'backend.auth', 'prefix' => 'admin', /*'domain' => 'admin.*'*/], function () {
        Route::get('/', [
            'uses' => 'SiteController@index',
            'as' => 'backend.index',
        ]);
        Route::get('index', [
            'uses' => 'SiteController@index',
            'as' => 'backend.index',
        ]);

        Route::group(['prefix' => 'feedback-request'], function () {
            Route::get('/', [
                'uses' => 'FeedbackRequestController@index',
                'as' => 'backend.feedback-request.index',
            ]);
            Route::get('index', [
                'uses' => 'FeedbackRequestController@index',
                'as' => 'backend.feedback-request.index',
            ]);
            Route::get('create', function () {
                return redirect()->route('backend.feedback-request.index')->with('message', 'Not allowed');
            });
            Route::get('show/{id}', [
                'uses' => 'FeedbackRequestController@show',
                'as' => 'backend.feedback-request.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'FeedbackRequestController@edit',
                'as' => 'backend.feedback-request.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'FeedbackRequestController@update',
                'as' => 'backend.feedback-request.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'FeedbackRequestController@destroy',
                'as' => 'backend.feedback-request.destroy',
            ]);
        });

        Route::group(['prefix' => 'account'], function () {
            Route::get('/', [
                'uses' => 'AccountController@index',
                'as' => 'backend.account.index',
            ]);
            Route::get('index', [
                'uses' => 'AccountController@index',
                'as' => 'backend.account.index',
            ]);
            Route::get('create', [
                'uses' => 'AccountController@create',
                'as' => 'backend.account.create',
            ]);
            Route::post('store', [
                'uses' => 'AccountController@store',
                'as' => 'backend.account.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'AccountController@show',
                'as' => 'backend.account.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'AccountController@edit',
                'as' => 'backend.account.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'AccountController@update',
                'as' => 'backend.account.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'AccountController@destroy',
                'as' => 'backend.account.destroy',
            ]);
        });

        Route::group(['prefix' => 'blog-post'], function () {
            Route::get('index/{category?}', [
                'uses' => 'BlogPostController@index',
                'as' => 'backend.blog-post.index',
            ]);
            Route::get('create', [
                'uses' => 'BlogPostController@create',
                'as' => 'backend.blog-post.create',
            ]);
            Route::post('store', [
                'uses' => 'BlogPostController@store',
                'as' => 'backend.blog-post.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'BlogPostController@show',
                'as' => 'backend.blog-post.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'BlogPostController@edit',
                'as' => 'backend.blog-post.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'BlogPostController@update',
                'as' => 'backend.blog-post.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'BlogPostController@destroy',
                'as' => 'backend.blog-post.destroy',
            ]);
        });

        Route::group(['prefix' => 'blog-category'], function () {
            Route::get('/', [
                'uses' => 'BlogCategoryController@index',
                'as' => 'backend.blog-category.index',
            ]);
            Route::get('index', [
                'uses' => 'BlogCategoryController@index',
                'as' => 'backend.blog-category.index',
            ]);
            Route::get('create', [
                'uses' => 'BlogCategoryController@create',
                'as' => 'backend.blog-category.create',
            ]);
            Route::post('store', [
                'uses' => 'BlogCategoryController@store',
                'as' => 'backend.blog-category.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'BlogCategoryController@show',
                'as' => 'backend.blog-category.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'BlogCategoryController@edit',
                'as' => 'backend.blog-category.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'BlogCategoryController@update',
                'as' => 'backend.blog-category.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'BlogCategoryController@destroy',
                'as' => 'backend.blog-category.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-product'], function () {
            Route::get('/', [
                'uses' => 'CatalogProductController@index',
                'as' => 'backend.catalog-product.index',
            ]);
            Route::get('index', [
                'uses' => 'CatalogProductController@index',
                'as' => 'backend.catalog-product.index',
            ]);
            Route::get('create', [
                'uses' => 'CatalogProductController@create',
                'as' => 'backend.catalog-product.create',
            ]);
            Route::post('store', [
                'uses' => 'CatalogProductController@store',
                'as' => 'backend.catalog-product.store',
            ]);
            Route::get('show/{product}', [
                'uses' => 'CatalogProductController@show',
                'as' => 'backend.catalog-product.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'CatalogProductController@edit',
                'as' => 'backend.catalog-product.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'CatalogProductController@update',
                'as' => 'backend.catalog-product.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'CatalogProductController@destroy',
                'as' => 'backend.catalog-product.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-product-images'], function () {
            Route::get('edit/{id}', [
                'uses' => 'ProductImagesController@edit',
                'as' => 'backend.catalog-product-images.update',
            ]);
            Route::post('store/{id}', [
                'uses' => 'ProductImagesController@store',
                'as' => 'backend.catalog-product-images.store',
            ]);
        });

        Route::group(['prefix' => 'catalog-product-properties'], function () {
            Route::get('edit/{id}', [
                'uses' => 'ProductPropertiesController@edit',
                'as' => 'backend.catalog-product-properties.update',
            ]);
            Route::post('store/{id}', [
                'uses' => 'ProductPropertiesController@store',
                'as' => 'backend.catalog-product-properties.store',
            ]);
        });

        Route::group(['prefix' => 'catalog-category'], function () {
            Route::get('/', [
                'uses' => 'CatalogCategoryController@index',
                'as' => 'backend.catalog-category.index',
            ]);
            Route::get('index', [
                'uses' => 'CatalogCategoryController@index',
                'as' => 'backend.catalog-category.index',
            ]);
            Route::get('create', [
                'uses' => 'CatalogCategoryController@create',
                'as' => 'backend.catalog-category.create',
            ]);
            Route::post('store', [
                'uses' => 'CatalogCategoryController@store',
                'as' => 'backend.catalog-category.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'CatalogCategoryController@show',
                'as' => 'backend.catalog-category.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'CatalogCategoryController@edit',
                'as' => 'backend.catalog-category.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'CatalogCategoryController@update',
                'as' => 'backend.catalog-category.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'CatalogCategoryController@destroy',
                'as' => 'backend.catalog-category.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-filter'], function () {
            Route::get('/', [
                'uses' => 'CatalogFilterController@index',
                'as' => 'backend.catalog-filter.index',
            ]);
            Route::get('index', [
                'uses' => 'CatalogFilterController@index',
                'as' => 'backend.catalog-filter.index',
            ]);
            Route::get('create', [
                'uses' => 'CatalogFilterController@create',
                'as' => 'backend.catalog-filter.create',
            ]);
            Route::post('store', [
                'uses' => 'CatalogFilterController@store',
                'as' => 'backend.catalog-filter.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'CatalogFilterController@show',
                'as' => 'backend.catalog-filter.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'CatalogFilterController@edit',
                'as' => 'backend.catalog-filter.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'CatalogFilterController@update',
                'as' => 'backend.catalog-filter.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'CatalogFilterController@destroy',
                'as' => 'backend.catalog-filter.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-filter-category'], function () {
            Route::get('/', [
                'uses' => 'CatalogFilterCategoryController@index',
                'as' => 'backend.catalog-filter-category.index',
            ]);
            Route::get('index', [
                'uses' => 'CatalogFilterCategoryController@index',
                'as' => 'backend.catalog-filter-category.index',
            ]);
            Route::get('create', [
                'uses' => 'CatalogFilterCategoryController@create',
                'as' => 'backend.catalog-filter-category.create',
            ]);
            Route::post('store', [
                'uses' => 'CatalogFilterCategoryController@store',
                'as' => 'backend.catalog-filter-category.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'CatalogFilterCategoryController@show',
                'as' => 'backend.catalog-filter-category.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'CatalogFilterCategoryController@edit',
                'as' => 'backend.catalog-filter-category.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'CatalogFilterCategoryController@update',
                'as' => 'backend.catalog-filter-category.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'CatalogFilterCategoryController@destroy',
                'as' => 'backend.catalog-filter-category.destroy',
            ]);
        });

        Route::group(['prefix' => 'catalog-product-property'], function () {
            Route::get('/', [
                'uses' => 'CatalogProductPropertyController@index',
                'as' => 'backend.catalog-product-property.index',
            ]);
            Route::get('index', [
                'uses' => 'CatalogProductPropertyController@index',
                'as' => 'backend.catalog-product-property.index',
            ]);
            Route::get('create', [
                'uses' => 'CatalogProductPropertyController@create',
                'as' => 'backend.catalog-product-property.create',
            ]);
            Route::post('store', [
                'uses' => 'CatalogProductPropertyController@store',
                'as' => 'backend.catalog-product-property.store',
            ]);
            Route::get('show/{id}', [
                'uses' => 'CatalogProductPropertyController@show',
                'as' => 'backend.catalog-product-property.show',
            ]);
            Route::get('edit/{id}', [
                'uses' => 'CatalogProductPropertyController@edit',
                'as' => 'backend.catalog-product-property.edit',
            ]);
            Route::post('update/{id}', [
                'uses' => 'CatalogProductPropertyController@update',
                'as' => 'backend.catalog-product-property.update',
            ]);
            Route::match(['get', 'post'], 'destroy/{id}', [
                'uses' => 'CatalogProductPropertyController@destroy',
                'as' => 'backend.catalog-product-property.destroy',
            ]);
            Route::post('generate-dropdown', [
                'uses' => 'CatalogProductPropertyController@generateDropdown',
                'as' => 'backend.catalog-product-property.generate-dropdown',
            ]);
        });

    });

});

Route::get('not-found', function() {
    return view('errors.404');
});

Route::get('/{any}', function() {
    return view('errors.404');
})->where('any', '.*');

//Auth::routes();
//Route::get('/home', 'HomeController@index');
