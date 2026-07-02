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
    
    $sounds = $query->paginate(48)->withQueryString();
    
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
    $parts = explode('-', $slug_with_id);
    $id = end($parts);
    
    if (!is_numeric($id)) {
        abort(404);
    }
    
    $sound = TiengDongSound::with(['category', 'tags'])->findOrFail($id);
    return view('detail', compact('sound'));
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
    
    $sounds = $query->paginate(48)->withQueryString();
    
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

Route::get('/{category_slug}', function ($category_slug, Request $request) {
    $category = App\Models\TiengDongCategory::where('slug', $category_slug)->first();
    if ($category) {
        $query = $category->sounds()->with('category')->orderBy('id', 'desc');
        
        $searchQuery = $request->query('s', '');
        if ($searchQuery) {
            $query->where(function($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                  ->orWhere('slug', 'like', '%' . $searchQuery . '%');
            });
        }
        
        $sounds = $query->paginate(48)->withQueryString();
        $activeCategory = $category;
        
        $pageTitle = "Hiệu ứng âm thanh " . $category->name . " chất lượng cao - Tải MP3 | AMMP3.com";
        $pageDescription = "Nghe và tải xuống các hiệu ứng âm thanh thuộc danh mục " . $category->name . " chất lượng cao miễn phí, phục vụ dựng video, làm phim, livestream trên AMMP3.com.";
        
        return view('welcome', compact('sounds', 'searchQuery', 'activeCategory', 'pageTitle', 'pageDescription'));
    }
    abort(404);
});
