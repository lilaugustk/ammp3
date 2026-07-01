<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $sound->title }} - AMMP3.com</title>
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="Nghe và tải xuống hiệu ứng âm thanh '{{ $sound->title }}' chất lượng cao miễn phí trên AMMP3.com. Sử dụng cho dựng video, livestream, meme soundboard.">
    <meta name="keywords" content="{{ $sound->title }}, ammp3, meme soundboard, hiệu ứng âm thanh, tiếng cười, âm thanh hài hước">
    <meta name="author" content="AMMP3.com">
    <link rel="canonical" href="{{ url('/instant/' . $sound->slug . '-' . $sound->id) }}">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="music.song">
    <meta property="og:url" content="{{ url('/instant/' . $sound->slug . '-' . $sound->id) }}">
    <meta property="og:title" content="{{ $sound->title }} - AMMP3.com">
    <meta property="og:description" content="Nghe và tải xuống hiệu ứng âm thanh '{{ $sound->title }}' chất lượng cao miễn phí trên AMMP3.com!">
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
            max-width: 800px;
            margin: 0 auto;
            padding: 40px 15px;
        }

        /* Detail Panel Card */
        .detail-panel {
            background-color: transparent;
            border: none;
            border-radius: 0;
            padding: 40px 20px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            box-shadow: none;
        }

        .sound-title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
            color: #ffffff;
        }

        .sound-category {
            font-size: 14px;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 600;
            margin-bottom: 30px;
        }

        .sound-category:hover {
            text-decoration: underline;
        }

        /* Large 3D Button Socket (Arcade style Rim) */
        .instant-btn-wrapper-large {
            width: 134px;
            height: 134px;
            border-radius: 50%;
            background: transparent;
            border: none;
            box-shadow: none;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-bottom: 30px;
        }

        .instant-btn-large {
            width: 125px;
            height: 125px;
            border-radius: 50%;
            border: none;
            cursor: pointer;
            outline: none;
            position: relative;
            top: -7px; /* Raised state */
            transition: all 0.08s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Colors deterministic mapping class base */
        @php
            $colors = ['red', 'green', 'blue', 'orange', 'purple', 'cyan', 'pink', 'yellow', 'indigo', 'teal'];
            $color = $colors[($sound->id) % count($colors)];
            $audioUrl = $sound->local_path ? asset($sound->local_path) : $sound->mp3_url;
        @endphp

        .btn-red { 
            background: radial-gradient(circle at 50% 30%, #fca5a5 0%, #ef4444 65%, #dc2626 100%); 
            box-shadow: 0 8px 0 #991b1b, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-red:active, .btn-red.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #991b1b, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-green { 
            background: radial-gradient(circle at 50% 30%, #86efac 0%, #22c55e 65%, #16a34a 100%); 
            box-shadow: 0 8px 0 #166534, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-green:active, .btn-green.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #166534, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-blue { 
            background: radial-gradient(circle at 50% 30%, #93c5fd 0%, #3b82f6 65%, #2563eb 100%); 
            box-shadow: 0 8px 0 #1e40af, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-blue:active, .btn-blue.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #1e40af, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-orange { 
            background: radial-gradient(circle at 50% 30%, #fed7aa 0%, #f97316 65%, #ea580c 100%); 
            box-shadow: 0 8px 0 #9a3412, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-orange:active, .btn-orange.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #9a3412, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-purple { 
            background: radial-gradient(circle at 50% 30%, #e9d5ff 0%, #a855f7 65%, #9333ea 100%); 
            box-shadow: 0 8px 0 #6b21a8, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-purple:active, .btn-purple.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #6b21a8, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-cyan { 
            background: radial-gradient(circle at 50% 30%, #a5f3fc 0%, #06b6d4 65%, #0891b2 100%); 
            box-shadow: 0 8px 0 #155e75, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-cyan:active, .btn-cyan.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #155e75, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-pink { 
            background: radial-gradient(circle at 50% 30%, #fbcfe8 0%, #ec4899 65%, #db2777 100%); 
            box-shadow: 0 8px 0 #9d174d, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-pink:active, .btn-pink.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #9d174d, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-yellow { 
            background: radial-gradient(circle at 50% 30%, #fef08a 0%, #eab308 65%, #ca8a04 100%); 
            box-shadow: 0 8px 0 #854d0e, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-yellow:active, .btn-yellow.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #854d0e, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-indigo { 
            background: radial-gradient(circle at 50% 30%, #c7d2fe 0%, #6366f1 65%, #4f46e5 100%); 
            box-shadow: 0 8px 0 #3730a3, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-indigo:active, .btn-indigo.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #3730a3, 0 3px 5px rgba(0,0,0,0.5); 
        }

        .btn-teal { 
            background: radial-gradient(circle at 50% 30%, #99f6e4 0%, #14b8a6 65%, #0d9488 100%); 
            box-shadow: 0 8px 0 #115e59, 0 10px 15px rgba(0,0,0,0.6); 
        }
        .btn-teal:active, .btn-teal.playing { 
            top: 0px; 
            box-shadow: 0 1px 0 #115e59, 0 3px 5px rgba(0,0,0,0.5); 
        }

        /* Large control buttons block */
        .detail-actions {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
            flex-wrap: wrap;
        }

        .large-action-btn {
            background-color: #1f2937;
            border: 1px solid var(--border-color);
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 8px;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .large-action-btn:hover {
            background-color: #374151;
            border-color: #4b5563;
        }

        .large-action-btn.active-fav {
            color: #ef4444;
            border-color: #ef4444;
        }

        .large-action-btn svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .back-link {
            display: inline-block;
            margin-top: 30px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
        }

        .back-link:hover {
            color: #ffffff;
            text-decoration: underline;
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

        /* Footer */
        footer {
            max-width: 800px;
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
            
            <form action="{{ url('/') }}" method="GET" class="search-container">
                <input type="text" name="s" class="search-input" placeholder="Tìm kiếm âm thanh...">
                <button type="submit" style="background:none; border:none; position:absolute; right:12px; top:50%; transform:translateY(-50%); color:var(--text-muted); cursor:pointer; display:flex; align-items:center; justify-content:center;">
                    <svg style="width:16px; height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
                            <a class="category-menu-item {{ (isset($sound) && $sound->category && $sound->category->slug == $category->slug) ? 'active' : '' }}" data-category="{{ $category->slug }}" href="{{ url('/?category=' . $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Container -->
    <main class="container">
        
        <div class="detail-panel">
            <h1 class="sound-title">{{ $sound->title }}</h1>
            <a href="{{ url('/?category=' . ($sound->category->slug ?? '')) }}" class="sound-category">
                Danh mục: {{ $sound->category->name ?? 'Meme' }}
            </a>

            <div class="instant-btn-wrapper-large">
                <audio id="audio-player" src="{{ $audioUrl }}" preload="auto"></audio>
                <button 
                    id="play-btn"
                    class="instant-btn-large btn-{{ $color }}" 
                    data-audio="{{ $audioUrl }}"
                    title="Phát {{ $sound->title }}"
                    aria-label="Play {{ $sound->title }}"
                    onclick="playAudio(this)">
                </button>
            </div>

            <div class="detail-actions">
                <!-- Favorite -->
                <button 
                    id="fav-btn"
                    class="large-action-btn" 
                    onclick="toggleFavorite()">
                    <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    <span id="fav-text">Yêu thích</span>
                </button>

                <!-- Copy Link -->
                <button 
                    class="large-action-btn" 
                    onclick="copyLink()">
                    <svg viewBox="0 0 24 24"><path d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z"/></svg>
                    <span>Copy Link</span>
                </button>

                <!-- Download MP3 -->
                <a 
                    href="{{ $audioUrl }}" 
                    download="{{ $sound->slug }}.mp3" 
                    class="large-action-btn">
                    <svg viewBox="0 0 24 24"><path d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z"/></svg>
                    <span>Tải MP3</span>
                </a>
            </div>

            <a href="{{ url('/') }}" class="back-link">Quay lại danh sách chính</a>
        </div>

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

    <!-- JS Audio & Favorites Logic -->
    <script>
        let currentAudio = null;
        let soundId = "{{ $sound->id }}";
        let favoritedIds = JSON.parse(localStorage.getItem('fav_sounds') || '[]');

        document.addEventListener('DOMContentLoaded', () => {
            initFavoriteUI();
            setupDropdown();
            currentAudio = document.getElementById('audio-player');
        });

        // Hàm phát âm thanh
        function playAudio(btn) {
            if (!currentAudio) return;

            currentAudio.currentTime = 0;

            if (btn.bounceTimeout) clearTimeout(btn.bounceTimeout);
            btn.classList.add('playing');
            btn.bounceTimeout = setTimeout(() => {
                btn.classList.remove('playing');
            }, 1000);

            const playPromise = currentAudio.play();
            if (playPromise !== undefined) {
                playPromise.catch(error => {
                    btn.classList.remove('playing');
                    if (btn.bounceTimeout) clearTimeout(btn.bounceTimeout);
                    showToast("Lỗi khi phát âm thanh!");
                });
            }
        }

        // Copy Link
        function copyLink() {
            const link = window.location.href;
            navigator.clipboard.writeText(link).then(() => {
                showToast("Đã sao chép liên kết!");
            }).catch(() => {
                showToast("Không thể sao chép liên kết.");
            });
        }

        // Show Toast
        function showToast(message) {
            const toast = document.getElementById('toast');
            toast.textContent = message;
            toast.classList.add('show');
            setTimeout(() => {
                toast.classList.remove('show');
            }, 2000);
        }

        // Init Favorite UI
        function initFavoriteUI() {
            const favBtn = document.getElementById('fav-btn');
            const favText = document.getElementById('fav-text');
            if (favoritedIds.includes(soundId)) {
                favBtn.classList.add('active-fav');
                favText.textContent = 'Đã Yêu thích';
            }
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
        }

        // Toggle Favorite
        function toggleFavorite() {
            const index = favoritedIds.indexOf(soundId);
            const favBtn = document.getElementById('fav-btn');
            const favText = document.getElementById('fav-text');

            if (index === -1) {
                favoritedIds.push(soundId);
                favBtn.classList.add('active-fav');
                favText.textContent = 'Đã Yêu thích';
                showToast("Đã lưu vào danh sách yêu thích!");
            } else {
                favoritedIds.splice(index, 1);
                favBtn.classList.remove('active-fav');
                favText.textContent = 'Yêu thích';
                showToast("Đã xóa khỏi danh sách yêu thích!");
            }

            localStorage.setItem('fav_sounds', JSON.stringify(favoritedIds));
        }
    </script>
</body>
</html>
