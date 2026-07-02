<?php

use Illuminate\Support\Facades\Route;
use App\Models\TiengDongCategory;
use App\Models\TiengDongSound;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $query = TiengDongSound::with('category')->orderBy('id', 'desc');
    
    // Filter by Category parameter (redirect to clean SEO URL)
    $categorySlug = $request->query('category', '');
    if ($categorySlug && $categorySlug !== 'all') {
        return redirect('/' . $categorySlug, 301);
    }
    
    // Filter by Search query
    $searchQuery = $request->query('s', '');
    if ($searchQuery) {
        // Simple search on title or slug
        $query->where(function($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
              ->orWhere('slug', 'like', '%' . $searchQuery . '%');
        });
    }
    
    $sounds = $query->paginate(24)->withQueryString();
    
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
    
    $query = $tag->sounds()->with('category')->orderBy('id', 'desc');
    
    // Filter by search query if any
    $searchQuery = $request->query('s', '');
    if ($searchQuery) {
        $query->where(function($q) use ($searchQuery) {
            $q->where('title', 'like', '%' . $searchQuery . '%')
              ->orWhere('slug', 'like', '%' . $searchQuery . '%');
        });
    }
    
    $sounds = $query->paginate(24)->withQueryString();
    
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
        $query = $category->sounds()->with('category')->orderBy('id', 'desc');
        
        $searchQuery = $request->query('s', '');
        if ($searchQuery) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                  ->orWhere('slug', 'like', '%' . $searchQuery . '%');
            });
        }
        
        $sounds = $query->paginate(24)->withQueryString();
        $activeCategory = $category;
        
        $pageTitle = "Tải hiệu ứng âm thanh " . $category->name . " Mp3 miễn phí - AMMP3.com";
        $pageDescription = "Tải hiệu ứng âm thanh danh mục " . $category->name . " Mp3 miễn phí chất lượng cao. Download âm thanh " . $category->name . " không bản quyền tốt nhất để dựng phim, làm video clip.";
        
        return view('welcome', compact('sounds', 'searchQuery', 'activeCategory', 'pageTitle', 'pageDescription'));
    }
    
    abort(404);
});
