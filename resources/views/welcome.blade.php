<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AMMP3.com - Meme Soundboard Việt Nam - Kho Hiệu Ứng Âm Thanh Hài Hước</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Nghe và tải xuống hàng ngàn hiệu ứng âm thanh meme, tiếng cười, câu nói viral Việt Nam độc đáo nhất trên AMMP3.com. Giao diện soundboard đơn giản, cực nhanh, miễn phí!">
    <meta name="keywords" content="ammp3, meme soundboard, hiệu ứng âm thanh, tiếng cười, âm thanh meme, âm thanh hài hước, tiếng động, câu nói viral">
    <meta name="author" content="AMMP3.com">
    <link rel="canonical" href="{{ url('/') }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="AMMP3.com - Meme Soundboard Việt Nam">
    <meta property="og:description" content="Nghe và tải xuống hàng ngàn hiệu ứng âm thanh meme, tiếng cười độc đáo nhất trên AMMP3.com. Giao diện soundboard đơn giản, tải cực nhanh!">
    <meta property="og:image" content="{{ asset('favicon.png') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS Styles -->
    <style>
        :root {
            --bg-color: #0b0f19;
            --nav-bg: #101726;
            --card-text: #ffffff;
            --text-muted: #9ca3af;
            --border-color: #1f2937;
            --font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            overflow-y: scroll;
        }

        body {
            background-color: var(--bg-color);
            color: var(--card-text);
            font-family: var(--font-family);
            line-height: 1.5;
            padding-bottom: 50px;
        }

        /* Header & Navbar */
        header {
            background-color: var(--nav-bg);
            border-bottom: 1px solid var(--border-color);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .brand-logo {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .brand-logo span {
            color: #ef4444;
        }

        .search-container {
            position: relative;
            flex: 1;
            max-width: 400px;
        }

        .search-input {
            width: 100%;
            padding: 8px 15px;
            padding-right: 35px;
            border-radius: 9999px;
            border: 1px solid var(--border-color);
            background-color: #1f2937;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            transition: border-color 0.2s;
        }

        .search-input:focus {
            border-color: #3b82f6;
        }

        .search-icon {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            pointer-events: none;
            width: 16px;
            height: 16px;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .nav-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .nav-link:hover {
            text-decoration: underline;
        }

        /* Main Container */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 15px;
        }

        /* SEO Title area */
        .hero-section {
            text-align: center;
            margin-bottom: 25px;
            padding: 10px 0;
        }

        .hero-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .hero-desc {
            font-size: 14px;
            color: var(--text-muted);
            max-width: 600px;
            margin: 0 auto;
        }

        /* Categories Scroller */
        .categories-wrapper {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            padding-bottom: 12px;
            margin-bottom: 25px;
            scrollbar-width: thin;
            scrollbar-color: #1f2937 var(--bg-color);
        }

        .categories-wrapper::-webkit-scrollbar {
            height: 6px;
        }

        .categories-wrapper::-webkit-scrollbar-thumb {
            background-color: #1f2937;
            border-radius: 3px;
        }

        .category-pill {
            background-color: #1f2937;
            color: #ffffff;
            padding: 6px 14px;
            border-radius: 9999px;
            font-size: 13px;
            font-weight: 600;
            white-space: nowrap;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.2s;
            user-select: none;
        }

        .category-pill:hover {
            background-color: #374151;
        }

        .category-pill.active {
            background-color: #3b82f6;
            border-color: #60a5fa;
        }

        /* Sounds Grid */
        .sounds-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(110px, 1fr));
            gap: 24px 16px;
            justify-content: center;
        }

        /* Sound Card (MyInstants style) */
        .sound-card {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            max-width: 125px;
            margin: 0 auto;
            position: relative;
        }

        /* 3D Button Socket (Arcade style Rim) */
        .instant-btn-wrapper {
            width: 82px;
            height: 82px;
            border-radius: 50%;
            background: transparent;
            border: none;
            box-shadow: none;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 12px;
        }

        .instant-btn {
            width: 54px; /* Distinct gap between button and rim (54px inside 82px) */
            height: 54px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            outline: none;
            position: relative;
            top: -5px; /* Noticeably raised height */
            transition: all 0.08s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* 3D arcade buttons with radial gradients and color-matched deep edges */
        .btn-red { 
            background: radial-gradient(circle at 50% 30%, #fca5a5 0%, #ef4444 65%, #dc2626 100%); 
            box-shadow: 0 6px 0 #991b1b, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-red:active, .btn-red.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #991b1b, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-green { 
            background: radial-gradient(circle at 50% 30%, #86efac 0%, #22c55e 65%, #16a34a 100%); 
            box-shadow: 0 6px 0 #166534, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-green:active, .btn-green.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #166534, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-blue { 
            background: radial-gradient(circle at 50% 30%, #93c5fd 0%, #3b82f6 65%, #2563eb 100%); 
            box-shadow: 0 6px 0 #1e40af, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-blue:active, .btn-blue.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #1e40af, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-orange { 
            background: radial-gradient(circle at 50% 30%, #fed7aa 0%, #f97316 65%, #ea580c 100%); 
            box-shadow: 0 6px 0 #9a3412, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-orange:active, .btn-orange.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #9a3412, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-purple { 
            background: radial-gradient(circle at 50% 30%, #e9d5ff 0%, #a855f7 65%, #9333ea 100%); 
            box-shadow: 0 6px 0 #6b21a8, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-purple:active, .btn-purple.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #6b21a8, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-cyan { 
            background: radial-gradient(circle at 50% 30%, #a5f3fc 0%, #06b6d4 65%, #0891b2 100%); 
            box-shadow: 0 6px 0 #155e75, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-cyan:active, .btn-cyan.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #155e75, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-pink { 
            background: radial-gradient(circle at 50% 30%, #fbcfe8 0%, #ec4899 65%, #db2777 100%); 
            box-shadow: 0 6px 0 #9d174d, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-pink:active, .btn-pink.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #9d174d, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-yellow { 
            background: radial-gradient(circle at 50% 30%, #fef08a 0%, #eab308 65%, #ca8a04 100%); 
            box-shadow: 0 6px 0 #854d0e, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-yellow:active, .btn-yellow.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #854d0e, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-indigo { 
            background: radial-gradient(circle at 50% 30%, #c7d2fe 0%, #6366f1 65%, #4f46e5 100%); 
            box-shadow: 0 6px 0 #3730a3, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-indigo:active, .btn-indigo.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #3730a3, 0 2px 4px rgba(0,0,0,0.5); 
        }

        .btn-teal { 
            background: radial-gradient(circle at 50% 30%, #99f6e4 0%, #14b8a6 65%, #0d9488 100%); 
            box-shadow: 0 6px 0 #115e59, 0 8px 12px rgba(0,0,0,0.6); 
        }
        .btn-teal:active, .btn-teal.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #115e59, 0 2px 4px rgba(0,0,0,0.5); 
        }

        /* Sound titles and link tags */
        .sound-title {
            color: #ffffff;
            font-size: 12px;
            font-weight: 600;
            text-decoration: none;
            height: 36px;
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            margin-bottom: 6px;
            padding: 0 4px;
            line-height: 1.4;
            width: 100%;
        }

        .sound-title:hover {
            text-decoration: underline;
        }

        /* Action Buttons Area below title */
        .actions-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: auto;
        }

        .action-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
            padding: 3px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            transition: all 0.2s;
        }

        .action-btn:hover {
            color: #ffffff;
            background-color: #1f2937;
        }

        .action-btn.active-fav {
            color: #ef4444 !important;
        }

        .action-btn svg {
            width: 14px;
            height: 14px;
            fill: currentColor;
        }

        /* Toast notifications */
        .toast {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%) translateY(100px);
            background-color: #1e293b;
            border: 1px solid #334155;
            color: #ffffff;
            padding: 8px 16px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            z-index: 1000;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            pointer-events: none;
        }

        .toast.show {
            transform: translateX(-50%) translateY(0);
        }

        /* Footer */
        footer {
            max-width: 1200px;
            margin: 50px auto 0;
            padding: 20px 15px;
            border-top: 1px solid var(--border-color);
            text-align: center;
            color: var(--text-muted);
            font-size: 12px;
        }

        /* No Results styling */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 40px 20px;
            color: var(--text-muted);
            font-size: 14px;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .navbar {
                justify-content: center;
            }
            .search-container {
                max-width: 100%;
            }
            .hero-title {
                font-size: 20px;
            }
        }

        /* Dropdown Container */
        .dropdown {
            position: relative;
            display: inline-block;
        }

        /* Dropdown Button */
        .dropdown-btn {
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            background: none;
            border: none;
            cursor: pointer;
            outline: none;
            display: flex;
            align-items: center;
            gap: 4px;
            padding: 4px 0;
            transition: color 0.2s;
        }

        .dropdown-btn:hover {
            color: #3b82f6;
        }

        .dropdown-btn svg {
            width: 12px;
            height: 12px;
            fill: currentColor;
            transition: transform 0.2s;
        }

        /* Dropdown Content */
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: var(--nav-bg);
            min-width: 220px;
            max-height: 350px;
            overflow-y: auto;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.5);
            z-index: 200;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(10px);
            padding: 6px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.2s ease;
            scrollbar-width: thin;
            scrollbar-color: #1f2937 var(--bg-color);
        }

        .dropdown-content::-webkit-scrollbar {
            width: 6px;
        }

        .dropdown-content::-webkit-scrollbar-thumb {
            background-color: #1f2937;
            border-radius: 3px;
        }

        .dropdown-content a {
            color: #ffffff;
            padding: 8px 16px;
            text-decoration: none;
            display: block;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
            text-align: left;
            cursor: pointer;
        }

        .dropdown-content a:hover, .dropdown-content a.active {
            background-color: #1f2937;
            color: #3b82f6;
        }

        /* Show the dropdown menu */
        .dropdown.show-menu .dropdown-content {
            display: block;
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .dropdown.show-menu .dropdown-btn svg {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <header>
        <div class="navbar">
            <a href="{{ url('/') }}" class="brand-logo" id="main-logo-link">
                AMMP3 <span>.com</span>
            </a>
            
            <div class="search-container">
                <input type="text" id="searchInput" class="search-input" placeholder="Tìm kiếm âm thanh..." value="{{ $searchQuery }}">
                <svg class="search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
            
            <nav class="nav-links">
                <a href="{{ url('/') }}" class="nav-link">Trang chủ</a>
                <span style="color: var(--border-color)">|</span>
                <div class="dropdown" id="categoryDropdown">
                    <button class="dropdown-btn" aria-haspopup="true" aria-expanded="false" id="categoryDropdownBtn">
                        Danh mục
                        <svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div class="dropdown-content" aria-labelledby="categoryDropdownBtn">
                        <a class="category-menu-item active" data-category="all" href="{{ url('/') }}">Tất cả</a>
                        @foreach($globalCategories as $category)
                            <a class="category-menu-item" data-category="{{ $category->slug }}" href="{{ url('/?category=' . $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <span style="color: var(--border-color)">|</span>
                <button id="show-fav-btn" class="nav-link" style="background:none; border:none; cursor:pointer; outline:none;">Yêu thích</button>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <main class="container">
        
        <!-- SEO friendly titles and summary info -->
        <section class="hero-section">
            <h1 class="hero-title">AMMP3.com - Meme Soundboard Việt Nam</h1>
            <p class="hero-desc">Click vào nút để phát âm thanh tức thì. Kho hiệu ứng âm thanh, tiếng cười, câu nói viral Việt Nam hài hước nhất dùng cho dựng video, livestream trên AMMP3.com.</p>
        </section>

        <!-- Sounds Buttons Grid -->
        <section class="sounds-grid" id="soundsGrid">
            @php
                $colors = ['red', 'green', 'blue', 'orange', 'purple', 'cyan', 'pink', 'yellow', 'indigo', 'teal'];
            @endphp
            
            @forelse($sounds as $sound)
                @php
                    // Deterministic button color based on post_id/slug length
                    $color = $colors[($sound->id) % count($colors)];
                    $audioUrl = $sound->local_path ? asset($sound->local_path) : $sound->mp3_url;
                @endphp
                <article class="sound-card" data-category="{{ $sound->category->slug ?? '' }}" data-search-term="{{ Str::slug($sound->title) }}" id="card-{{ $sound->id }}">
                    <div class="instant-btn-wrapper">
                        <button 
                            id="play-btn-{{ $sound->id }}"
                            class="instant-btn btn-{{ $color }}" 
                            data-audio="{{ $audioUrl }}"
                            title="Phát {{ $sound->title }}"
                            aria-label="Play {{ $sound->title }}"
                            onclick="playAudio(this, '{{ $sound->id }}')">
                        </button>
                    </div>
                    
                    <a href="{{ url('/instant/' . $sound->slug . '-' . $sound->id) }}" class="sound-title" title="{{ $sound->title }}" id="title-link-{{ $sound->id }}">
                        {{ $sound->title }}
                    </a>
                    
                    <div class="actions-row">
                        <!-- Favorite Button -->
                        <button 
                            id="fav-btn-{{ $sound->id }}"
                            class="action-btn" 
                            title="Thêm vào yêu thích" 
                            aria-label="Favorite {{ $sound->title }}"
                            onclick="toggleFavorite('{{ $sound->id }}')">
                            <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                        </button>

                        <!-- Copy URL Button -->
                        <button 
                            id="copy-btn-{{ $sound->id }}"
                            class="action-btn" 
                            title="Copy link liên kết" 
                            aria-label="Copy link {{ $sound->title }}"
                            onclick="copyLink('{{ url('/instant/' . $sound->slug . '-' . $sound->id) }}')">
                            <svg viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
                        </button>

                        <!-- Direct download MP3 Button -->
                        <a 
                            id="download-btn-{{ $sound->id }}"
                            href="{{ $audioUrl }}" 
                            download="{{ $sound->slug }}.mp3" 
                            class="action-btn" 
                            title="Tải nhạc MP3" 
                            aria-label="Download {{ $sound->title }}">
                            <svg viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="no-results" id="empty-state">
                    Không tìm thấy âm thanh nào.
                </div>
            @endforelse
            <div class="no-results" id="client-empty-state" style="display: none;">
                Không tìm thấy âm thanh phù hợp.
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer>
        <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 10px;">
            <a href="{{ url('/gioi-thieu') }}" style="color: var(--text-muted); text-decoration: none; font-size: 12px;">Giới thiệu</a>
            <span style="color: var(--border-color); font-size: 12px;">|</span>
            <a href="{{ url('/chinh-sach') }}" style="color: var(--text-muted); text-decoration: none; font-size: 12px;">Chính sách</a>
            <span style="color: var(--border-color); font-size: 12px;">|</span>
            <a href="{{ url('/lien-he') }}" style="color: var(--text-muted); text-decoration: none; font-size: 12px;">Liên hệ</a>
        </div>
        <p>&copy; {{ date('Y') }} AMMP3.com. Bản quyền nội dung âm thanh thuộc về các tác giả gốc.</p>
    </footer>

    <!-- Toast Notification Element -->
    <div id="toast" class="toast">Đã sao chép liên kết!</div>

    <!-- JS Audio & Search Logic -->
    <script>
        // Trình phát âm thanh duy nhất
        let currentAudio = null;
        let currentBtn = null;
        let favoritedIds = JSON.parse(localStorage.getItem('fav_sounds') || '[]');
        let showOnlyFavs = false;
        let activeCategory = 'all';

        // Khởi động khi load xong trang
        document.addEventListener('DOMContentLoaded', () => {
            initFavoritesUI();
            setupSearch();
            setupCategories();
            setupFavToggle();
            setupDropdown();
            setupPreload();
            
            // Lọc danh mục nếu có sẵn từ query string
            const urlParams = new URLSearchParams(window.location.search);
            const initialCat = urlParams.get('category');
            if (initialCat) {
                const item = document.querySelector(`.category-menu-item[data-category="${initialCat}"]`);
                if (item) {
                    document.querySelectorAll('.category-menu-item').forEach(m => m.classList.remove('active'));
                    item.classList.add('active');
                    activeCategory = initialCat;
                }
            }

            // Lọc tìm kiếm nếu có sẵn từ query string
            const initialSearch = document.getElementById('searchInput').value;
            if (initialSearch || initialCat) {
                filterSounds();
            }
        });

        // Hàm phát âm thanh
        function playAudio(btn, id) {
            const audio = document.getElementById(`audio-element-${id}`);
            if (!audio) return;

            // Nếu đang phát nút khác -> dừng nút khác lại
            if (currentAudio && currentAudio !== audio) {
                currentAudio.pause();
                if (currentBtn) {
                    currentBtn.classList.remove('playing');
                    if (currentBtn.bounceTimeout) clearTimeout(currentBtn.bounceTimeout);
                }
            }

            currentAudio = audio;
            currentBtn = btn;
            
            // Phát lại từ đầu
            audio.currentTime = 0;

            if (btn.bounceTimeout) clearTimeout(btn.bounceTimeout);
            btn.classList.add('playing');
            btn.bounceTimeout = setTimeout(() => {
                btn.classList.remove('playing');
            }, 1000);

            const playPromise = audio.play();
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    btn.classList.remove('playing');
                    if (btn.bounceTimeout) clearTimeout(btn.bounceTimeout);
                    showToast("Lỗi khi phát âm thanh!");
                });
            }
        }

        // Tạo audio element ẩn và preload động khi hover/touch
        function setupPreload() {
            const cards = document.querySelectorAll('.sound-card');
            cards.forEach(card => {
                const id = card.id.replace('card-', '');
                const btn = document.getElementById(`play-btn-${id}`);
                if (!btn) return;
                const audioUrl = btn.getAttribute('data-audio');
                
                // Tạo audio element ẩn
                const audio = document.createElement('audio');
                audio.id = `audio-element-${id}`;
                audio.src = audioUrl;
                audio.preload = 'none';
                card.appendChild(audio);

                // Preload khi di chuột vào card
                card.addEventListener('mouseenter', () => {
                    if (audio.preload !== 'auto') {
                        audio.preload = 'auto';
                        audio.load();
                    }
                }, { once: true });

                // Preload khi chạm vào trên mobile
                card.addEventListener('touchstart', () => {
                    if (audio.preload !== 'auto') {
                        audio.preload = 'auto';
                        audio.load();
                    }
                }, { once: true });
            });
        }

        // Sao chép liên kết vào clipboard
        function copyLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                showToast("Đã sao chép liên kết chi tiết!");
            }).catch(err => {
                showToast("Không thể sao chép liên kết.");
            });
        }

        // Hiện thông báo dạng toast nhanh
        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2000);
        }

        // Chuyển tiếng Việt có dấu thành không dấu
        function removeVietnameseTones(str) {
            str = str.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g, "a");
            str = str.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g, "e");
            str = str.replace(/ì|í|ị|ỉ|ĩ/g, "i");
            str = str.replace(/ò|ó|ọ|ỏ|ã|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g, "o");
            str = str.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g, "u");
            str = str.replace(/ỳ|ý|ỵ|ỷ|ỹ/g, "y");
            str = str.replace(/đ/g, "d");
            str = str.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
            str = str.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
            str = str.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
            str = str.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
            str = str.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
            str = str.replace(/Ỳ|Ý|Y|Ỷ|Ỹ/g, "Y");
            str = str.replace(/Đ/g, "D");
            // Hỗ trợ thêm các ký tự đặc biệt khác
            str = str.normalize("NFD").replace(/[\u0300-\u036f]/g, "");
            return str.toLowerCase().trim();
        }

        // Lọc hiển thị soundboard
        function filterSounds() {
            const query = removeVietnameseTones(document.getElementById('searchInput').value);
            const cards = document.querySelectorAll('.sound-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const category = card.getAttribute('data-category');
                const searchTerm = card.getAttribute('data-search-term');
                const id = card.id.replace('card-', '');

                // Kiểm tra danh mục
                const categoryMatches = (activeCategory === 'all' || category === activeCategory);
                
                // Kiểm tra tìm kiếm
                const searchMatches = (!query || searchTerm.includes(query));
                
                // Kiểm tra yêu thích
                const favoriteMatches = (!showOnlyFavs || favoritedIds.includes(id));

                if (categoryMatches && searchMatches && favoriteMatches) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Hiển thị trạng thái rỗng
            const clientEmptyState = document.getElementById('client-empty-state');
            if (visibleCount === 0) {
                clientEmptyState.style.display = 'block';
            } else {
                clientEmptyState.style.display = 'none';
            }
        }

        // Đăng ký Tìm kiếm
        function setupSearch() {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('input', () => {
                filterSounds();
            });
        }

        // Đăng ký Lọc danh mục
        function setupCategories() {
            const menuItems = document.querySelectorAll('.category-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', (e) => {
                    e.preventDefault();
                    menuItems.forEach(m => m.classList.remove('active'));
                    item.classList.add('active');
                    activeCategory = item.getAttribute('data-category');
                    
                    const url = new URL(window.location.href);
                    if (activeCategory === 'all') {
                        url.searchParams.delete('category');
                    } else {
                        url.searchParams.set('category', activeCategory);
                    }
                    window.history.pushState({}, '', url);

                    filterSounds();
                });
            });
        }

        // Đăng ký và quản lý dropdown danh mục (đóng/mở bằng click & hover)
        function setupDropdown() {
            const dropdown = document.getElementById('categoryDropdown');
            const btn = document.getElementById('categoryDropdownBtn');
            if (!dropdown || !btn) return;

            // Toggle khi click vào nút Danh mục
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show-menu');
            });

            // Đóng khi click ra bên ngoài
            document.addEventListener('click', (e) => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('show-menu');
                }
            });

            // Tự đóng khi chọn một danh mục
            const menuItems = dropdown.querySelectorAll('.category-menu-item');
            menuItems.forEach(item => {
                item.addEventListener('click', () => {
                    dropdown.classList.remove('show-menu');
                });
            });
        }

        // Toggle chỉ hiện danh sách yêu thích trên menu
        function setupFavToggle() {
            const favBtn = document.getElementById('show-fav-btn');
            favBtn.addEventListener('click', () => {
                showOnlyFavs = !showOnlyFavs;
                if (showOnlyFavs) {
                    favBtn.style.color = '#ef4444';
                    favBtn.textContent = 'Yêu thích';
                } else {
                    favBtn.style.color = '';
                    favBtn.textContent = 'Yêu thích';
                }
                filterSounds();
            });
        }

        // Đồng bộ hóa trạng thái Yêu thích khi load trang
        function initFavoritesUI() {
            favoritedIds.forEach(id => {
                const favBtn = document.getElementById(`fav-btn-${id}`);
                if (favBtn) {
                    favBtn.classList.add('active-fav'); 
                }
            });
        }

        // Thêm/Xóa âm thanh khỏi Yêu thích
        function toggleFavorite(id) {
            const index = favoritedIds.indexOf(id);
            const favBtn = document.getElementById(`fav-btn-${id}`);

            if (index === -1) {
                // Thêm vào yêu thích
                favoritedIds.push(id);
                if (favBtn) favBtn.classList.add('active-fav');
                showToast("Đã lưu vào danh sách yêu thích!");
            } else {
                // Xóa khỏi yêu thích
                favoritedIds.splice(index, 1);
                if (favBtn) favBtn.classList.remove('active-fav');
                showToast("Đã xóa khỏi danh sách yêu thích!");
            }

            localStorage.setItem('fav_sounds', JSON.stringify(favoritedIds));

            // Nếu đang lọc chỉ hiện yêu thích, thì cập nhật lại danh sách ngay lập tức
            if (showOnlyFavs) {
                filterSounds();
            }
        }
    </script>
</body>
</html>
