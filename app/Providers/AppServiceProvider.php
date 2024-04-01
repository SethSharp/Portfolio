<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use SethSharp\BlogCrud\Models\Blog\Tag;
use SethSharp\BlogCrud\Models\Blog\Blog;
use SethSharp\BlogCrud\Policies\TagPolicy;
use SethSharp\BlogCrud\Policies\BlogPolicy;
use SethSharp\BlogCrud\Models\Blog\Collection;
use SethSharp\BlogCrud\Policies\CollectionPolicy;

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
        Gate::policy(Tag::class, TagPolicy::class);
        Gate::policy(Collection::class, CollectionPolicy::class);
    }
}
