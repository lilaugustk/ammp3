<?php

use Illuminate\Support\Facades\Route;
use App\Models\TiengDongCategory;
use App\Models\TiengDongSound;
use Illuminate\Http\Request;

Route::get('/', function (Request $request) {
    $categories = TiengDongCategory::orderBy('name')->get();
    $sounds = TiengDongSound::with('category')->orderBy('id', 'desc')->get();
    $searchQuery = $request->query('s', '');
    return view('welcome', compact('categories', 'sounds', 'searchQuery'));
});

Route::get('/instant/{slug_with_id}', function ($slug_with_id) {
    $parts = explode('-', $slug_with_id);
    $id = end($parts);
    
    if (!is_numeric($id)) {
        abort(404);
    }
    
    $sound = TiengDongSound::with('category')->findOrFail($id);
    return view('detail', compact('sound'));
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
