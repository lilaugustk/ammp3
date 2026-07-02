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
                $categories = \Illuminate\Support\Facades\Cache::rememberForever('global_categories_list_v3', function () {
                    return \Illuminate\Support\Facades\DB::table('tiengdong_categories')
                        ->orderBy('name')
                        ->get(['id', 'name', 'slug'])
                        ->toArray();
                });
                $view->with('globalCategories', $categories);
            }
        });
    }
}
