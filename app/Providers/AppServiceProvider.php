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

            if (class_exists(\App\Models\TiengDongTag::class)) {
                $tagsData = \Illuminate\Support\Facades\Cache::remember('global_tags_array', 86400, function () {
                    return \Illuminate\Support\Facades\DB::table('tiengdong_tags')
                        ->join('tiengdong_sound_tag', 'tiengdong_tags.id', '=', 'tiengdong_sound_tag.tag_id')
                        ->select('tiengdong_tags.id', 'tiengdong_tags.name', 'tiengdong_tags.slug', \Illuminate\Support\Facades\DB::raw('count(tiengdong_sound_tag.sound_id) as sounds_count'))
                        ->groupBy('tiengdong_tags.id', 'tiengdong_tags.name', 'tiengdong_tags.slug')
                        ->orderByDesc('sounds_count')
                        ->limit(24)
                        ->get()
                        ->map(function ($item) {
                            return (array) $item;
                        })
                        ->toArray();
                });

                $tags = array_map(function ($item) {
                    return (object) $item;
                }, $tagsData);

                $view->with('globalTags', $tags);
            }
        });
    }
}
