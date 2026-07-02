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
                $categoriesData = \Illuminate\Support\Facades\Cache::rememberForever('global_categories_array', function () {
                    return \Illuminate\Support\Facades\DB::table('tiengdong_categories')
                        ->orderBy('name')
                        ->get(['id', 'name', 'slug'])
                        ->map(function ($item) {
                            return (array) $item;
                        })
                        ->toArray();
                });

                $categories = array_map(function ($item) {
                    return (object) $item;
                }, $categoriesData);

                $view->with('globalCategories', $categories);
            }
        });
    }
}
