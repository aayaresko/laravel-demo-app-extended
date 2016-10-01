<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Models\Entities\BlogPost' => 'App\Policies\BlogPolicy',
        'App\Models\Entities\BlogCategory' => 'App\Policies\BlogCategoryPolicy',
        'App\Models\Entities\CatalogProduct' => 'App\Policies\CatalogProductPolicy',
        'App\Models\Entities\CatalogCategory' => 'App\Policies\CatalogCategoryPolicy',
        'App\Models\Entities\CatalogFilter' => 'App\Policies\CatalogFilterPolicy',
        'App\Models\Entities\CatalogFilterCategory' => 'App\Policies\CatalogFilterCategoryPolicy',
        'App\Models\Entities\CatalogProductProperty' => 'App\Policies\CatalogProductPropertyPolicy',
        'App\Models\Entities\AccountProfile' => 'App\Policies\AccountProfilePolicy',
        'App\Models\Entities\Account' => 'App\Policies\AccountPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
