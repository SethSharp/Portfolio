<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Policies\BlogPolicy;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (app()->environment('production')) {
            Url::forceScheme('https');
        }

        Gate::policy(Blog::class, BlogPolicy::class);
    }
}
