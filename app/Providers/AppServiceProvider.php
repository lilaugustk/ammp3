<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Support\Facades\View::composer('*', function ($view) {
            if (class_exists(\App\Models\TiengDongCategory::class)) {
                $categories = \Illuminate\Support\Facades\Cache::rememberForever('global_categories_list', function () {
                    return \App\Models\TiengDongCategory::orderBy('name')->get();
                });
                $view->with('globalCategories', $categories);
            }
        });
    }
}
