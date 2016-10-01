<?php

namespace App\Providers;

use App\Models\Entities\AccountProfile;
use App\Models\Entities\BlogCategory;
use App\Models\Entities\BlogPost;
use App\Models\Entities\CatalogCategory;
use App\Models\Entities\CatalogFilter;
use App\Models\Entities\CatalogFilterCategory;
use App\Models\Entities\CatalogProduct;
use App\Models\Entities\ChatMessage;
use App\Models\Entities\ContactMessage;
use App\Models\Entities\Favorite;
use App\Observers\BlogPostPublishedObserver;
use App\Observers\CatalogFilterObserver;
use App\Observers\DefaultImageObserver;
use App\Observers\HtmlPurifyObserver;
use App\Observers\SystemNameObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Relation::morphMap([
            Favorite::TYPE_POST => BlogPost::class,
            Favorite::TYPE_PRODUCT => CatalogProduct::class,
        ]);

        CatalogFilter::observe(CatalogFilterObserver::class);
        CatalogFilter::observe(HtmlPurifyObserver::class);

        AccountProfile::observe(HtmlPurifyObserver::class);
        AccountProfile::observe(DefaultImageObserver::class);

        ContactMessage::observe(HtmlPurifyObserver::class);
        ChatMessage::observe(HtmlPurifyObserver::class);

        BlogPost::observe(HtmlPurifyObserver::class);
        BlogPost::observe(SystemNameObserver::class);
        BlogPost::observe(BlogPostPublishedObserver::class);

        BlogCategory::observe(SystemNameObserver::class);
        BlogCategory::observe(HtmlPurifyObserver::class);

        CatalogProduct::observe(SystemNameObserver::class);
        CatalogProduct::observe(HtmlPurifyObserver::class);

        CatalogCategory::observe(SystemNameObserver::class);
        CatalogCategory::observe(HtmlPurifyObserver::class);

        CatalogFilterCategory::observe(SystemNameObserver::class);
        CatalogFilterCategory::observe(HtmlPurifyObserver::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
