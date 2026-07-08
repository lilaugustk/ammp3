<?php

use Illuminate\Support\Facades\Route;
use App\Models\TiengDongCategory;
use App\Models\TiengDongSound;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\SitemapController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);

Route::get('/', function (Request $request) {
    // Filter by Category parameter (redirect to clean SEO URL)
    $categorySlug = $request->query('category', '');
    if ($categorySlug && $categorySlug !== 'all') {
        return redirect('/' . $categorySlug, 301);
    }
    
    $page = $request->query('page', 1);
    $searchQuery = $request->query('s', '');
    $cacheKey = "home_sounds_page_{$page}_search_" . md5($searchQuery);
    
    $soundsData = Cache::remember($cacheKey, 3600, function () use ($searchQuery) {
        $query = TiengDongSound::with('category')->orderBy('id', 'desc');
        if ($searchQuery) {
            // Simple search on title or slug
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                  ->orWhere('slug', 'like', '%' . $searchQuery . '%');
            });
        }
        $paginator = $query->paginate(24);
        return [
            'items' => $paginator->getCollection()->map(function($sound) {
                return $sound->toArray();
            })->toArray(),
            'total' => $paginator->total(),
            'perPage' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
        ];
    });
    
    $items = collect($soundsData['items'])->map(function($item) {
        $sound = new TiengDongSound();
        $sound->exists = true;
        
        $categoryData = $item['category'] ?? null;
        unset($item['category']);
        
        $sound->setRawAttributes($item, true);
        
        if ($categoryData) {
            $cat = new TiengDongCategory();
            $cat->exists = true;
            $cat->setRawAttributes($categoryData, true);
            $sound->setRelation('category', $cat);
        }
        return $sound;
    });
    
    $sounds = new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $soundsData['total'],
        $soundsData['perPage'],
        $soundsData['currentPage'],
        ['path' => $request->url(), 'query' => $request->query()]
    );
    
    $sounds->withQueryString();
    
    $pageTitle = 'Tải hiệu ứng âm thanh, tiếng động miễn phí | AMMP3.com';
    $pageDescription = 'Nghe và tải xuống hàng ngàn hiệu ứng âm thanh meme, tiếng cười, câu nói viral độc đáo nhất trên AMMP3.com. Giao diện soundboard đơn giản, cực nhanh, miễn phí!';
    
    return view('welcome', compact('sounds', 'searchQuery', 'pageTitle', 'pageDescription'));
});

Route::get('/download/{id}', function ($id) {
    $sound = TiengDongSound::findOrFail($id);
    $audioUrl = $sound->local_path ? asset($sound->local_path) : $sound->mp3_url;
    return redirect($audioUrl);
});

Route::get('/instant/{slug_with_id}', function ($slug_with_id) {
    return redirect('/' . $slug_with_id, 301);
});

Route::get('/tag/{slug}', function ($slug, Request $request) {
    $tag = App\Models\TiengDongTag::where('slug', $slug)->firstOrFail();
    
    $page = $request->query('page', 1);
    $searchQuery = $request->query('s', '');
    $cacheKey = "tag_sounds_{$slug}_page_{$page}_search_" . md5($searchQuery);
    
    $soundsData = Cache::remember($cacheKey, 3600, function () use ($tag, $searchQuery) {
        $query = $tag->sounds()->with('category')->orderBy('id', 'desc');
        if ($searchQuery) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                  ->orWhere('slug', 'like', '%' . $searchQuery . '%');
            });
        }
        $paginator = $query->paginate(24);
        return [
            'items' => $paginator->getCollection()->map(function($sound) {
                return $sound->toArray();
            })->toArray(),
            'total' => $paginator->total(),
            'perPage' => $paginator->perPage(),
            'currentPage' => $paginator->currentPage(),
        ];
    });
    
    $items = collect($soundsData['items'])->map(function($item) {
        $sound = new TiengDongSound();
        $sound->exists = true;
        
        $categoryData = $item['category'] ?? null;
        unset($item['category']);
        
        $sound->setRawAttributes($item, true);
        
        if ($categoryData) {
            $cat = new TiengDongCategory();
            $cat->exists = true;
            $cat->setRawAttributes($categoryData, true);
            $sound->setRelation('category', $cat);
        }
        return $sound;
    });
    
    $sounds = new \Illuminate\Pagination\LengthAwarePaginator(
        $items,
        $soundsData['total'],
        $soundsData['perPage'],
        $soundsData['currentPage'],
        ['path' => $request->url(), 'query' => $request->query()]
    );
    
    $sounds->withQueryString();
    
    return view('tag', compact('tag', 'sounds', 'searchQuery'));
});

Route::get('/chinh-sach', function () {
    return view('privacy');
});

Route::get('/gioi-thieu', function () {
    return view('about');
});

Route::get('/lien-he', function () {
    return view('contact');
});

Route::post('/lien-he', function (Request $request) {
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'subject' => 'nullable|string|max:255',
        'message' => 'required|string|min:10',
    ]);

    \App\Models\ContactMessage::create($validated);

    return response()->json([
        'success' => true,
        'message' => 'Cảm ơn bạn! Thông tin liên hệ đã được gửi thành công.'
    ]);
});

Route::get('/{slug}', function ($slug, Request $request) {
    // 1. Try to check if it's a detail page (ends with -{id})
    $parts = explode('-', $slug);
    $id = end($parts);
    
    if (is_numeric($id)) {
        $sound = TiengDongSound::with(['category', 'tags'])->find($id);
        if ($sound) {
            $tagIds = $sound->tags->pluck('id');
            $relatedSounds = TiengDongSound::whereHas('tags', function($q) use ($tagIds) {
                    $q->whereIn('tiengdong_tags.id', $tagIds);
                })
                ->where('id', '!=', $sound->id)
                ->distinct()
                ->orderBy('id', 'desc')
                ->limit(12)
                ->get();
            
            return view('detail', compact('sound', 'relatedSounds'));
        }
    }

    // 2. Otherwise, check if it's a category page
    $category = App\Models\TiengDongCategory::where('slug', $slug)->first();
    if ($category) {
        $page = $request->query('page', 1);
        $searchQuery = $request->query('s', '');
        $cacheKey = "category_sounds_{$slug}_page_{$page}_search_" . md5($searchQuery);
        
        $soundsData = Cache::remember($cacheKey, 3600, function () use ($category, $searchQuery) {
            $query = $category->sounds()->with('category')->orderBy('id', 'desc');
            if ($searchQuery) {
                $query->where(function($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                      ->orWhere('slug', 'like', '%' . $searchQuery . '%');
                });
            }
            $paginator = $query->paginate(24);
            return [
                'items' => $paginator->getCollection()->map(function($sound) {
                    return $sound->toArray();
                })->toArray(),
                'total' => $paginator->total(),
                'perPage' => $paginator->perPage(),
                'currentPage' => $paginator->currentPage(),
            ];
        });
        
        $items = collect($soundsData['items'])->map(function($item) {
            $sound = new TiengDongSound();
            $sound->exists = true;
            
            $categoryData = $item['category'] ?? null;
            unset($item['category']);
            
            $sound->setRawAttributes($item, true);
            
            if ($categoryData) {
                $cat = new TiengDongCategory();
                $cat->exists = true;
                $cat->setRawAttributes($categoryData, true);
                $sound->setRelation('category', $cat);
            }
            return $sound;
        });
        
        $sounds = new \Illuminate\Pagination\LengthAwarePaginator(
            $items,
            $soundsData['total'],
            $soundsData['perPage'],
            $soundsData['currentPage'],
            ['path' => $request->url(), 'query' => $request->query()]
        );
        
        $sounds->withQueryString();
        $activeCategory = $category;
        
        $pageTitle = "Tải hiệu ứng âm thanh " . $category->name . " Mp3 miễn phí - AMMP3.com";
        $pageDescription = "Tải hiệu ứng âm thanh danh mục " . $category->name . " Mp3 miễn phí chất lượng cao. Download âm thanh " . $category->name . " không bản quyền tốt nhất để dựng phim, làm video clip.";
        
        return view('welcome', compact('sounds', 'searchQuery', 'activeCategory', 'pageTitle', 'pageDescription'));
    }
    
    abort(404);
});
