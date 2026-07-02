<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải hiệu ứng âm thanh {{ $tag->name }} Mp3 miễn phí - AMMP3.com</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Tải hiệu ứng âm thanh chủ đề {{ $tag->name }} Mp3 miễn phí chất lượng cao. Tải file MP3 {{ $tag->name }} không bản quyền cho dựng phim, edit video CapCut, TikTok, YouTube.">
    <meta name="keywords" content="{{ $tag->name }}, ammp3, meme soundboard, hiệu ứng âm thanh, tiếng động">
    <meta name="author" content="AMMP3.com">
    <link rel="canonical" href="{{ url('/tag/' . $tag->slug) }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/tag/' . $tag->slug) }}">
    <meta property="og:title" content="Tải hiệu ứng âm thanh {{ $tag->name }} Mp3 miễn phí - AMMP3.com">
    <meta property="og:description" content="Danh sách các hiệu ứng âm thanh, tiếng động chủ đề {{ $tag->name }} chất lượng cao tải về miễn phí!">
    <meta property="og:image" content="{{ asset('favicon.png') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- JSON-LD Breadcrumb Schema -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "BreadcrumbList",
      "itemListElement": [
        {
          "@@type": "ListItem",
          "position": 1,
          "name": "Trang chủ",
          "item": "{{ url('/') }}"
        },
        {
          "@@type": "ListItem",
          "position": 2,
          "name": "Chủ đề: {{ $tag->name }}",
          "item": "{{ url('/tag/' . $tag->slug) }}"
        }
      ]
    }
    </script>

    <!-- CSS Styles (Replicating welcome.blade.php design system) -->
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
            padding: 30px 15px;
        }

        /* Hero / Header info */
        .hero-section {
            text-align: center;
            margin-bottom: 35px;
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            padding: 30px 20px;
            border-radius: 12px;
            border: 1px solid var(--border-color);
        }

        .hero-title {
            font-size: 26px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
        }

        .hero-desc {
            font-size: 14px;
            color: var(--text-muted);
            max-width: 700px;
            margin: 0 auto;
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
            text-decoration: none;
            display: inline-block;
        }

        .category-pill:hover {
            background-color: #374151;
            color: #ffffff;
        }

        .category-pill.active {
            background-color: #3b82f6;
            border-color: #60a5fa;
            color: #ffffff;
        }

        /* Navigation section on homepage & tags */
        .home-nav-section {
            margin-bottom: 30px;
            background-color: #101726;
            border: 1px solid #1f2937;
            border-radius: 12px;
            padding: 20px;
        }

        .home-nav-group {
            margin-bottom: 18px;
        }

        .home-nav-group:last-child {
            margin-bottom: 0;
        }

        .home-nav-title {
            font-size: 14px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .home-nav-title svg {
            width: 16px;
            height: 16px;
            fill: #ef4444;
        }

        .pills-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .topic-pill {
            background-color: #1f2937;
            color: #9ca3af;
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 12.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
            border: 1px solid transparent;
            display: inline-block;
        }

        .topic-pill:hover {
            background-color: #273549;
            color: #ffffff;
            border-color: #ef4444;
        }

        .topic-pill.active {
            background-color: #ef4444;
            color: #ffffff;
            border-color: #fca5a5;
        }

        /* Sound grid */
        .sounds-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(130px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .sound-card {
            background-color: #101726;
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 15px 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            position: relative;
        }

        .sound-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            border-color: #374151;
        }

        /* 3D Button Socket (Arcade Rim) */
        .instant-btn-wrapper {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: radial-gradient(circle, #27272a 0%, #09090b 100%);
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.8), 0 1px 1px rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 12px;
        }

        .instant-btn {
            width: 66px;
            height: 66px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            outline: none;
            position: relative;
            top: -4px; /* Raised state */
            transition: all 0.08s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Colors deterministic mapping classes */
        .btn-red {
            background: radial-gradient(circle at 50% 30%, #fca5a5 0%, #ef4444 65%, #dc2626 100%);
            box-shadow: 0 4px 0 #991b1b, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-red:active, .btn-red.playing {
            top: 0px;
            box-shadow: 0 1px 0 #991b1b, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-green {
            background: radial-gradient(circle at 50% 30%, #86efac 0%, #22c55e 65%, #16a34a 100%);
            box-shadow: 0 4px 0 #166534, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-green:active, .btn-green.playing {
            top: 0px;
            box-shadow: 0 1px 0 #166534, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-blue {
            background: radial-gradient(circle at 50% 30%, #93c5fd 0%, #3b82f6 65%, #2563eb 100%);
            box-shadow: 0 4px 0 #1e40af, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-blue:active, .btn-blue.playing {
            top: 0px;
            box-shadow: 0 1px 0 #1e40af, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-orange {
            background: radial-gradient(circle at 50% 30%, #fed7aa 0%, #f97316 65%, #ea580c 100%);
            box-shadow: 0 4px 0 #9a3412, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-orange:active, .btn-orange.playing {
            top: 0px;
            box-shadow: 0 1px 0 #9a3412, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-purple {
            background: radial-gradient(circle at 50% 30%, #e9d5ff 0%, #a855f7 65%, #9333ea 100%);
            box-shadow: 0 4px 0 #6b21a8, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-purple:active, .btn-purple.playing {
            top: 0px;
            box-shadow: 0 1px 0 #6b21a8, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-cyan {
            background: radial-gradient(circle at 50% 30%, #a5f3fc 0%, #06b6d4 65%, #0891b2 100%);
            box-shadow: 0 4px 0 #155e75, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-cyan:active, .btn-cyan.playing {
            top: 0px;
            box-shadow: 0 1px 0 #155e75, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-pink {
            background: radial-gradient(circle at 50% 30%, #fbcfe8 0%, #ec4899 65%, #db2777 100%);
            box-shadow: 0 4px 0 #9d174d, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-pink:active, .btn-pink.playing {
            top: 0px;
            box-shadow: 0 1px 0 #9d174d, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-yellow {
            background: radial-gradient(circle at 50% 30%, #fef08a 0%, #eab308 65%, #ca8a04 100%);
            box-shadow: 0 4px 0 #854d0e, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-yellow:active, .btn-yellow.playing {
            top: 0px;
            box-shadow: 0 1px 0 #854d0e, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-indigo {
            background: radial-gradient(circle at 50% 30%, #c7d2fe 0%, #6366f1 65%, #4f46e5 100%);
            box-shadow: 0 4px 0 #3730a3, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-indigo:active, .btn-indigo.playing {
            top: 0px;
            box-shadow: 0 1px 0 #3730a3, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        .btn-teal {
            background: radial-gradient(circle at 50% 30%, #99f6e4 0%, #14b8a6 65%, #0d9488 100%);
            box-shadow: 0 4px 0 #115e59, 0 5px 8px rgba(0, 0, 0, 0.6);
        }
        .btn-teal:active, .btn-teal.playing {
            top: 0px;
            box-shadow: 0 1px 0 #115e59, 0 2px 3px rgba(0, 0, 0, 0.5);
        }

        @keyframes pulse-loading {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(0.95); opacity: 0.6; }
            100% { transform: scale(1); opacity: 1; }
        }
        .instant-btn.loading {
            animation: pulse-loading 1s infinite ease-in-out;
            cursor: wait;
        }

        /* Sound title & actions */
        .sound-title {
            color: var(--card-text);
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            display: block;
            margin-bottom: 10px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            height: 2.8em;
            line-height: 1.4;
        }

        .sound-title:hover {
            color: #3b82f6;
            text-decoration: underline;
        }

        .actions-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            border-top: 1px solid var(--border-color);
            padding-top: 10px;
            margin-top: auto;
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 38px;
            height: 38px;
            transition: all 0.2s;
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }

        @media (hover: hover) {
            .action-btn:hover {
                color: #ffffff;
            }
        }

        .action-btn.active-fav {
            color: #ef4444;
        }

        .action-btn svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        /* Pagination */
        .pagination-container {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 30px;
        }

        .pagination-btn {
            background-color: #101726;
            border: 1px solid var(--border-color);
            color: #ffffff;
            padding: 6px 16px;
            border-radius: 6px;
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            transition: all 0.2s;
        }

        .pagination-btn:hover:not(.disabled) {
            background-color: #1f2937;
            border-color: #3b82f6;
        }

        .pagination-btn.disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .pagination-info {
            font-size: 13px;
            color: var(--text-muted);
            font-weight: 600;
        }

        /* Empty state */
        .no-results {
            grid-column: 1 / -1;
            text-align: center;
            padding: 50px 20px;
            color: var(--text-muted);
            font-size: 15px;
            font-weight: 600;
            background-color: #101726;
            border-radius: 12px;
            border: 1px solid var(--border-color);
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

        /* Dropdown Content (Hidden by Default) */
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
    </style>
</head>
<body>

    <!-- Header / Navbar -->
    <header>
        <div class="navbar">
            <a href="{{ url('/') }}" class="brand-logo" id="main-logo-link">
                AMMP3 <span>.com</span>
            </a>
            
            <form action="{{ url('/tag/' . $tag->slug) }}" method="GET" class="search-container" id="searchForm">
                <input type="text" name="s" id="searchInput" class="search-input" placeholder="Tìm trong chủ đề {{ $tag->name }}..." value="{{ $searchQuery }}">
                <button type="submit" style="background:none; border:none; position:absolute; right:12px; top:50%; transform:translateY(-50%); color:var(--text-muted); cursor:pointer; display:flex; align-items:center; justify-content:center;">
                    <svg class="search-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="position:static; transform:none; width:16px; height:16px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
            
            <nav class="nav-links">
                <a href="{{ url('/') }}" class="nav-link">Trang chủ</a>
                <span style="color: var(--border-color)">|</span>
                <div class="dropdown" id="categoryDropdown">
                    <button class="dropdown-btn" aria-haspopup="true" aria-expanded="false" id="categoryDropdownBtn">
                        Danh mục
                        <svg viewBox="0 0 24 24"><path d="M7 10l5 5 5-5z"/></svg>
                    </button>
                    <div class="dropdown-content" aria-labelledby="categoryDropdownBtn">
                        <a class="category-menu-item" data-category="all" href="{{ url('/') }}">Tất cả</a>
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
        
        <!-- Hero Section -->
        <section class="hero-section">
            <h1 class="hero-title">Chủ đề: {{ $tag->name }}</h1>
            <p class="hero-desc">Danh sách các hiệu ứng âm thanh, tiếng động liên quan đến chủ đề "{{ $tag->name }}" chất lượng cao miễn phí.</p>
        </section>



        <!-- Sounds Buttons Grid -->
        <section class="sounds-grid" id="soundsGrid">
            @php
                $colors = ['red', 'green', 'blue', 'orange', 'purple', 'cyan', 'pink', 'yellow', 'indigo', 'teal'];
            @endphp
            
            @forelse($sounds as $sound)
                @php
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
                    
                    <a href="{{ url('/' . $sound->slug . '-' . $sound->id) }}" class="sound-title" title="{{ $sound->title }}" id="title-link-{{ $sound->id }}">
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
                            onclick="copyLink('{{ url('/' . $sound->slug . '-' . $sound->id) }}')">
                            <svg viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
                        </button>

                        <!-- Direct download MP3 Button -->
                        <a 
                            id="download-btn-{{ $sound->id }}"
                            href="{{ url('/download/' . $sound->id) }}" 
                            class="action-btn" 
                            title="Tải nhạc MP3" 
                            aria-label="Download {{ $sound->title }}">
                            <svg viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
                        </a>
                    </div>
                </article>
            @empty
                <div class="no-results" id="empty-state">
                    Không tìm thấy âm thanh nào thuộc chủ đề này.
                </div>
            @endforelse
            <div class="no-results" id="client-empty-state" style="display: none;">
                Không tìm thấy âm thanh phù hợp.
            </div>
        </section>

        @if ($sounds->hasPages())
            <nav class="pagination-container" aria-label="Phân trang">
                @if ($sounds->onFirstPage())
                    <span class="pagination-btn disabled">Trước</span>
                @else
                    <a href="{{ $sounds->previousPageUrl() }}" class="pagination-btn">Trước</a>
                @endif

                <span class="pagination-info">
                    Trang {{ $sounds->currentPage() }}
                </span>

                @if ($sounds->hasMorePages())
                    <a href="{{ $sounds->nextPageUrl() }}" class="pagination-btn">Sau</a>
                @else
                    <span class="pagination-btn disabled">Sau</span>
                @endif
            </nav>
        @endif

        <!-- Categories Section -->
        @if(isset($globalCategories) && count($globalCategories) > 0)
        <div class="suggested-topics-section">
            <h2 class="related-title">
                Thể loại
            </h2>
            <div class="topics-grid">
                @foreach ($globalCategories as $cat)
                    <a href="{{ url('/' . $cat->slug) }}" class="topic-pill">
                        {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Suggested Topics Section -->
        @if(isset($globalTags) && count($globalTags) > 0)
        <div class="suggested-topics-section" style="padding-top: 0; padding-bottom: 30px;">
            <h2 class="related-title">
                Chủ đề phổ biến
            </h2>
            <div class="topics-grid">
                @foreach ($globalTags as $t)
                    <a href="{{ url('/tag/' . $t->slug) }}" class="topic-pill {{ ($tag->slug == $t->slug) ? 'active' : '' }}">
                        # {{ $t->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

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

    <!-- JS Audio & Search Logic (Same as welcome.blade.php) -->
    <script>
        const audioElements = {}; // Caches HTML5 Audio objects
        let currentlyPlayingId = null;

        function getAudio(id, url) {
            if (!audioElements[id]) {
                const audio = new Audio(url);
                audio.preload = 'none';
                audioElements[id] = audio;
            }
            return audioElements[id];
        }

        // Preload sounds
        function preloadSound(id, url) {
            const audio = getAudio(id, url);
            if (audio.preload !== 'auto') {
                audio.preload = 'auto';
                audio.load();
            }
        }

        let favoritedIds = JSON.parse(localStorage.getItem('fav_sounds') || '[]');
        let showOnlyFavs = false;

        document.addEventListener('DOMContentLoaded', () => {
            initFavoritesUI();
            setupSearch();
            setupFavToggle();
            setupDropdown();
            setupPreload();

            // Tự động kích hoạt lọc Yêu thích nếu URL có tham số filter=favorites
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('filter') === 'favorites') {
                const favBtn = document.getElementById('show-fav-btn');
                if (favBtn) {
                    favBtn.click();
                }
            }
        });

        function playAudio(btn, id) {
            const url = btn.getAttribute('data-audio');
            const audio = getAudio(id, url);

            // If another audio is playing, stop it
            if (currentlyPlayingId && currentlyPlayingId !== id) {
                const activeBtn = document.getElementById(`play-btn-${currentlyPlayingId}`);
                if (activeBtn) activeBtn.classList.remove('playing');
                
                const activeAudio = audioElements[currentlyPlayingId];
                if (activeAudio) {
                    activeAudio.pause();
                    activeAudio.currentTime = 0;
                }
            }

            if (audio.paused) {
                btn.classList.add('loading');
                audio.play()
                    .then(() => {
                        btn.classList.remove('loading');
                        btn.classList.add('playing');
                        currentlyPlayingId = id;
                    })
                    .catch(e => {
                        btn.classList.remove('loading');
                        console.error("Lỗi phát âm thanh:", e);
                    });

                // When audio ends
                audio.onended = () => {
                    btn.classList.remove('playing');
                    currentlyPlayingId = null;
                };
            } else {
                audio.pause();
                audio.currentTime = 0;
                btn.classList.remove('playing');
                currentlyPlayingId = null;
            }
        }

        function toggleFavorite(id) {
            const index = favoritedIds.indexOf(id);
            const btn = document.getElementById(`fav-btn-${id}`);

            if (index === -1) {
                favoritedIds.push(id);
                if (btn) btn.classList.add('active-fav');
            } else {
                favoritedIds.splice(index, 1);
                if (btn) btn.classList.remove('active-fav');

                // If in favorites-only mode, hide card immediately
                if (showOnlyFavs) {
                    const card = document.getElementById(`card-${id}`);
                    if (card) card.style.display = 'none';
                }
            }

            localStorage.setItem('fav_sounds', JSON.stringify(favoritedIds));
        }

        function initFavoritesUI() {
            favoritedIds.forEach(id => {
                const btn = document.getElementById(`fav-btn-${id}`);
                if (btn) btn.classList.add('active-fav');
            });
        }

        function setupFavToggle() {
            const favToggleBtn = document.getElementById('show-fav-btn');
            if (!favToggleBtn) return;

            favToggleBtn.addEventListener('click', (e) => {
                e.preventDefault();
                showOnlyFavs = !showOnlyFavs;
                
                const cards = document.querySelectorAll('.sound-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const id = card.id.replace('card-', '');
                    const isFav = favoritedIds.includes(id);

                    if (showOnlyFavs) {
                        if (isFav) {
                            card.style.display = 'flex';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    } else {
                        card.style.display = 'flex';
                        visibleCount++;
                    }
                });

                favToggleBtn.style.color = showOnlyFavs ? '#ef4444' : '#ffffff';
                
                const emptyState = document.getElementById('empty-state');
                if (visibleCount === 0) {
                    document.getElementById('client-empty-state').style.display = 'block';
                    if (emptyState) emptyState.style.display = 'none';
                } else {
                    document.getElementById('client-empty-state').style.display = 'none';
                }
            });
        }

        function setupSearch() {
            const input = document.getElementById('searchInput');
            if (!input) return;

            // Simple real-time client filter
            input.addEventListener('input', () => {
                const query = input.value.trim().toLowerCase();
                const cards = document.querySelectorAll('.sound-card');
                let visibleCount = 0;

                cards.forEach(card => {
                    const id = card.id.replace('card-', '');
                    const term = card.getAttribute('data-search-term') || '';
                    const titleText = card.querySelector('.sound-title').textContent.toLowerCase();
                    const isFav = favoritedIds.includes(id);

                    const matchesQuery = titleText.includes(query) || term.includes(query);
                    const matchesFav = !showOnlyFavs || isFav;

                    if (matchesQuery && matchesFav) {
                        card.style.display = 'flex';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                const emptyState = document.getElementById('empty-state');
                if (visibleCount === 0) {
                    document.getElementById('client-empty-state').style.display = 'block';
                    if (emptyState) emptyState.style.display = 'none';
                } else {
                    document.getElementById('client-empty-state').style.display = 'none';
                    if (emptyState && !showOnlyFavs) emptyState.style.display = 'block';
                }
            });
        }

        function copyLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                showToast("Đã sao chép liên kết!");
            }).catch(() => {
                showToast("Không thể sao chép liên kết.");
            });
        }

        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2000);
        }

        function setupDropdown() {
            const dropdown = document.getElementById('categoryDropdown');
            const btn = document.getElementById('categoryDropdownBtn');
            if (!dropdown || !btn) return;

            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                dropdown.classList.toggle('show-menu');
            });

            document.addEventListener('click', (e) => {
                if (!dropdown.contains(e.target)) {
                    dropdown.classList.remove('show-menu');
                }
            });
        }

        // Preload sounds when hovering over cards to reduce latency
        function setupPreload() {
            const cards = document.querySelectorAll('.sound-card');
            cards.forEach(card => {
                const btn = card.querySelector('.instant-btn');
                if (btn) {
                    const id = card.id.replace('card-', '');
                    const url = btn.getAttribute('data-audio');
                    
                    // Hover/Touch start events
                    card.addEventListener('mouseenter', () => preloadSound(id, url), { passive: true });
                    card.addEventListener('touchstart', () => preloadSound(id, url), { passive: true });
                }
            });
        }
    </script>
</body>
</html>
