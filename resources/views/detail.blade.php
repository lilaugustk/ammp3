<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tải {{ $sound->title }} Mp3 miễn phí - Download hiệu ứng âm thanh | AMMP3.com</title>

    <!-- SEO Meta Tags -->
    <meta name="description"
        content="Tải {{ $sound->title }} chất lượng cao, download file mp3 {{ $sound->title }} miễn phí. Hiệu ứng âm thanh {{ $sound->title }} không bản quyền cực hay phục vụ dựng phim, edit video CapCut, TikTok, YouTube.">
    <meta name="keywords"
        content="{{ $sound->title }} mp3, tải {{ $sound->title }}, {{ $sound->title }} không bản quyền, ammp3, meme soundboard, hiệu ứng âm thanh, tiếng động">
    <meta name="author" content="AMMP3.com">
    <link rel="canonical" href="{{ url('/' . $sound->slug . '-' . $sound->id) }}">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="music.song">
    <meta property="og:url" content="{{ url('/' . $sound->slug . '-' . $sound->id) }}">
    <meta property="og:title" content="Tải {{ $sound->title }} Mp3 miễn phí - AMMP3.com">
    <meta property="og:description"
        content="Nghe và tải xuống hiệu ứng âm thanh '{{ $sound->title }}' chất lượng cao hoàn toàn miễn phí không bản quyền trên AMMP3.com!">
    <meta property="og:image" content="{{ asset('favicon.png') }}">

    <!-- JSON-LD Structured Data / Schema Markup -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@graph": [
        {
          "@@type": "BreadcrumbList",
          "@@id": "{{ url('/' . $sound->slug . '-' . $sound->id) }}#breadcrumb",
          "itemListElement": [
            {
              "@@type": "ListItem",
              "position": 1,
              "name": "Trang chủ",
              "item": "{{ url('/') }}"
            },
            @if($sound->category)
            {
              "@@type": "ListItem",
              "position": 2,
              "name": "{{ $sound->category->name }}",
              "item": "{{ url('/?category=' . $sound->category->slug) }}"
            },
            @endif
            {
              "@@type": "ListItem",
              "position": 3,
              "name": "{{ $sound->title }}",
              "item": "{{ url('/' . $sound->slug . '-' . $sound->id) }}"
            }
          ]
        },
        {
          "@@type": "AudioObject",
          "@@id": "{{ url('/' . $sound->slug . '-' . $sound->id) }}#audio",
          "name": "{{ $sound->title }}",
          "description": "{{ $sound->description ?? 'Tải hiệu ứng âm thanh ' . $sound->title . ' chất lượng cao miễn phí không bản quyền' }}",
          "contentUrl": "{{ $sound->local_path ? asset($sound->local_path) : $sound->mp3_url }}",
          "encodingFormat": "audio/mpeg"
        }
      ]
    }
    </script>

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
            -webkit-tap-highlight-color: transparent;
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
            height: 44px;
            padding: 0 46px 0 16px;
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
            padding: 20px 10px;
        }

        /* Detail Panel Card */
        .detail-panel {
            background-color: transparent;
            border: none;
            border-radius: 0;
            padding: 0 10px;
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
            top: -7px;
            /* Raised state */
            transition: all 0.08s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }

        /* Colors deterministic mapping class base */
        @php $colors =['red', 'green', 'blue', 'orange', 'purple', 'cyan', 'pink', 'yellow', 'indigo', 'teal'];
        $color =$colors[($sound->id) % count($colors)];
        $audioUrl =$sound->local_path ? asset($sound->local_path) : $sound->mp3_url;
        @endphp

        .btn-red {
            background: radial-gradient(circle at 50% 30%, #fca5a5 0%, #ef4444 65%, #dc2626 100%);
            box-shadow: 0 8px 0 #991b1b, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-red:active,
        .btn-red.playing {
            top: 0px;
            box-shadow: 0 1px 0 #991b1b, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-green {
            background: radial-gradient(circle at 50% 30%, #86efac 0%, #22c55e 65%, #16a34a 100%);
            box-shadow: 0 8px 0 #166534, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-green:active,
        .btn-green.playing {
            top: 0px;
            box-shadow: 0 1px 0 #166534, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-blue {
            background: radial-gradient(circle at 50% 30%, #93c5fd 0%, #3b82f6 65%, #2563eb 100%);
            box-shadow: 0 8px 0 #1e40af, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-blue:active,
        .btn-blue.playing {
            top: 0px;
            box-shadow: 0 1px 0 #1e40af, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-orange {
            background: radial-gradient(circle at 50% 30%, #fed7aa 0%, #f97316 65%, #ea580c 100%);
            box-shadow: 0 8px 0 #9a3412, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-orange:active,
        .btn-orange.playing {
            top: 0px;
            box-shadow: 0 1px 0 #9a3412, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-purple {
            background: radial-gradient(circle at 50% 30%, #e9d5ff 0%, #a855f7 65%, #9333ea 100%);
            box-shadow: 0 8px 0 #6b21a8, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-purple:active,
        .btn-purple.playing {
            top: 0px;
            box-shadow: 0 1px 0 #6b21a8, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-cyan {
            background: radial-gradient(circle at 50% 30%, #a5f3fc 0%, #06b6d4 65%, #0891b2 100%);
            box-shadow: 0 8px 0 #155e75, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-cyan:active,
        .btn-cyan.playing {
            top: 0px;
            box-shadow: 0 1px 0 #155e75, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-pink {
            background: radial-gradient(circle at 50% 30%, #fbcfe8 0%, #ec4899 65%, #db2777 100%);
            box-shadow: 0 8px 0 #9d174d, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-pink:active,
        .btn-pink.playing {
            top: 0px;
            box-shadow: 0 1px 0 #9d174d, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-yellow {
            background: radial-gradient(circle at 50% 30%, #fef08a 0%, #eab308 65%, #ca8a04 100%);
            box-shadow: 0 8px 0 #854d0e, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-yellow:active,
        .btn-yellow.playing {
            top: 0px;
            box-shadow: 0 1px 0 #854d0e, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-indigo {
            background: radial-gradient(circle at 50% 30%, #c7d2fe 0%, #6366f1 65%, #4f46e5 100%);
            box-shadow: 0 8px 0 #3730a3, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-indigo:active,
        .btn-indigo.playing {
            top: 0px;
            box-shadow: 0 1px 0 #3730a3, 0 3px 5px rgba(0, 0, 0, 0.5);
        }

        .btn-teal {
            background: radial-gradient(circle at 50% 30%, #99f6e4 0%, #14b8a6 65%, #0d9488 100%);
            box-shadow: 0 8px 0 #115e59, 0 10px 15px rgba(0, 0, 0, 0.6);
        }

        .btn-teal:active,
        .btn-teal.playing {
            top: 0px;
            box-shadow: 0 1px 0 #115e59, 0 3px 5px rgba(0, 0, 0, 0.5);
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

        @keyframes pulse-loading {
            0% { transform: scale(1); opacity: 1; }
            50% { transform: scale(0.95); opacity: 0.6; }
            100% { transform: scale(1); opacity: 1; }
        }
        .instant-btn-large.loading {
            animation: pulse-loading 1s infinite ease-in-out;
            cursor: wait;
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
            outline: none;
            -webkit-tap-highlight-color: transparent;
        }

        @media (hover: hover) {
            .large-action-btn:hover {
                background-color: #374151;
                border-color: #4b5563;
            }
        }

        .large-action-btn:active {
            background-color: #111827;
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

        /* Audio Player Bar */
        .audio-player-row {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            max-width: 450px;
            margin: 0 auto 30px auto;
            user-select: none;
        }

        .player-ctrl-btn {
            background: #ef4444;
            border: none;
            color: #ffffff;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);
            flex-shrink: 0;
        }

        .player-ctrl-btn:hover {
            background: #dc2626;
            transform: scale(1.05);
        }

        .player-ctrl-btn svg {
            width: 18px;
            height: 18px;
            fill: currentColor;
            display: block;
        }

        .player-time {
            font-size: 12px;
            font-weight: 600;
            color: var(--text-muted);
            min-width: 38px;
            text-align: center;
        }

        .progress-bar-wrapper {
            flex: 1;
            display: flex;
            align-items: center;
            position: relative;
        }

        .player-progress {
            width: 100%;
            height: 6px;
            border-radius: 3px;
            background: #1f2937;
            outline: none;
            pointer-events: none;
            -webkit-appearance: none;
            appearance: none;
            transition: background 0.1s;
        }

        .player-progress::-webkit-slider-runnable-track {
            width: 100%;
            height: 6px;
            cursor: default;
        }

        .player-progress::-webkit-slider-thumb {
            height: 14px;
            width: 14px;
            border-radius: 50%;
            background: #ef4444;
            cursor: default;
            -webkit-appearance: none;
            margin-top: -4px;
            box-shadow: 0 0 4px rgba(0, 0, 0, 0.5);
            transition: transform 0.1s;
        }

        .volume-container {
            display: flex;
            align-items: center;
            gap: 6px;
            position: relative;
        }

        .volume-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 4px;
            transition: color 0.2s;
        }

        .volume-btn:hover {
            color: #ffffff;
        }

        .volume-btn svg {
            width: 16px;
            height: 16px;
            fill: currentColor;
            display: block;
        }

        .volume-slider {
            width: 60px;
            height: 4px;
            border-radius: 2px;
            background: #1f2937;
            outline: none;
            cursor: pointer;
            -webkit-appearance: none;
            appearance: none;
        }

        .volume-slider::-webkit-slider-thumb {
            height: 10px;
            width: 10px;
            border-radius: 50%;
            background: var(--text-muted);
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -3px;
        }

        .volume-slider::-webkit-slider-thumb:hover {
            background: #ffffff;
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
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
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
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.5);
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

        .dropdown-content a:hover,
        .dropdown-content a.active {
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

        /* Mobile Optimization */
        @media (max-width: 640px) {
            .navbar {
                padding: 12px 15px;
                gap: 10px;
            }
            .brand-logo {
                font-size: 20px;
            }
            .search-container {
                order: 3;
                width: 100%;
                max-width: 100%;
                margin-top: 4px;
            }
            .search-input {
                font-size: 13px;
                padding: 7px 15px;
            }
            .nav-links {
                gap: 10px;
            }
            .nav-link, .dropdown-btn {
                font-size: 13px;
            }
            .container {
                padding: 15px 10px;
            }
            .detail-panel {
                padding: 0 5px;
            }
            .sound-title {
                font-size: 20px;
                line-height: 1.4;
                margin-bottom: 6px;
            }
            .sound-category {
                margin-bottom: 20px;
            }
            .instant-btn-wrapper-large {
                margin-bottom: 20px;
            }
            .audio-player-row {
                gap: 8px;
                margin-bottom: 20px;
                padding: 0 5px;
            }
            .player-time {
                font-size: 11px;
                min-width: 32px;
            }
        }

        @media (max-width: 480px) {
            .volume-slider {
                display: none;
            }
            .volume-container {
                gap: 0;
            }
            .detail-actions {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 8px;
                width: 100%;
                max-width: 450px;
                margin-top: 15px;
            }
            .large-action-btn {
                padding: 10px 4px;
                font-size: 12px;
                flex-direction: column;
                gap: 6px;
                justify-content: center;
                align-items: center;
                text-align: center;
                border-radius: 8px;
                min-height: 64px;
            }
            .large-action-btn svg {
                width: 18px;
                height: 18px;
            }
        }
        /* Related Sounds & Suggested Topics Section styles */
        .related-sounds-section,
        .suggested-topics-section {
            width: 100%;
            padding-top: 40px;
        }

        .related-title {
            font-size: 18px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 20px;
            text-align: left;
            /* border-left: 4px solid #ef4444; */
            padding-left: 10px;
        }

        .related-sounds-list {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .related-sound-item {
            display: flex;
            align-items: center;
            background-color: transparent;
            border: none;
            padding: 10px 0;
            gap: 12px;
            transition: all 0.2s ease;
        }

        .related-sound-item:last-child {
            border-bottom: none;
        }

        .related-sound-item .play-col {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .related-sound-item .list-play-btn {
            background-color: #1f2937;
            color: #ffffff;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            outline: none;
        }

        .related-sound-item .list-play-btn:hover {
            background-color: #3b82f6;
            transform: scale(1.05);
        }

        .related-sound-item .list-play-btn svg {
            width: 16px;
            height: 16px;
        }

        .related-sound-item .list-play-btn .play-svg {
            margin-left: 2px;
        }

        .related-sound-item .info-col {
            flex: 1;
            min-width: 0;
            display: flex;
            align-items: center;
        }

        .related-sound-item .sound-title-link {
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            text-align: left;
            margin-bottom: 0;
            padding: 0;
            height: auto;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .related-sound-item .sound-title-link:hover {
            color: #3b82f6;
            text-decoration: none;
        }

        .related-sound-item .actions-col {
            display: flex;
            align-items: center;
        }

        /* Mobile adaptation */
        @media (max-width: 640px) {
            .related-sound-item {
                padding: 8px 0;
                gap: 10px;
            }
            .related-sound-item .sound-title-link {
                font-size: 13.5px;
            }
            .related-sound-item .action-btn {
                width: 32px;
                height: 32px;
            }
            .related-sound-item .action-btn svg {
                width: 18px;
                height: 18px;
            }
        }
        .actions-row {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-top: auto;
        }

        .action-btn {
            background: transparent;
            border: none;
            cursor: pointer;
            color: var(--text-muted);
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
            color: #ef4444 !important;
        }

        .action-btn svg {
            width: 22px;
            height: 22px;
            fill: currentColor;
        }

        .topic-pill {
            display: inline-block;
            color: #ffffff;
            padding: 8px 16px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .topics-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
            width: 100%;
        }

        @media (max-width: 768px) {
            .topics-grid {
                /* flex-wrap: nowrap; */
                overflow-x: auto;
                padding-bottom: 12px;
                scrollbar-width: none;
                -ms-overflow-style: none;
                -webkit-overflow-scrolling: touch;
            }
            .topics-grid::-webkit-scrollbar {
                display: none;
            }
            .topic-pill {
                white-space: nowrap;
                font-size: 12.5px;
                padding: 6px 12px;
            }
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

            <form action="{{ url('/') }}" method="GET" class="search-container" id="searchForm">
                <input type="text" name="s" id="searchInput" class="search-input" placeholder="Tìm kiếm âm thanh...">
                <button type="submit" aria-label="Tìm kiếm"
                    style="background:none; border:none; position:absolute; right:2px; top:50%; transform:translateY(-50%); width:44px; height:44px; color:var(--text-muted); cursor:pointer; display:flex; align-items:center; justify-content:center;">
                    <svg style="width:16px; height:16px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>

            <nav class="nav-links">
                <a href="{{ url('/') }}" class="nav-link">Trang chủ</a>
                <span style="color: var(--border-color)">|</span>
                <div class="dropdown" id="categoryDropdown">
                    <button class="dropdown-btn" aria-haspopup="true" aria-expanded="false" id="categoryDropdownBtn">
                        Danh mục
                        <svg viewBox="0 0 24 24">
                            <path d="M7 10l5 5 5-5z" />
                        </svg>
                    </button>
                    <div class="dropdown-content" aria-labelledby="categoryDropdownBtn">
                        <a class="category-menu-item" data-category="all" href="{{ url('/') }}">Tất cả</a>
                        @foreach ($globalCategories as $category)
                            <a class="category-menu-item {{ isset($sound) && $sound->category && $sound->category->slug == $category->slug ? 'active' : '' }}"
                                data-category="{{ $category->slug }}"
                                href="{{ url('/?category=' . $category->slug) }}">
                                {{ $category->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <span style="color: var(--border-color)">|</span>
                <a href="{{ url('/?filter=favorites') }}" class="nav-link">Yêu thích</a>
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
                <button id="play-btn" class="instant-btn-large btn-{{ $color }}"
                    data-audio="{{ $audioUrl }}" title="Phát {{ $sound->title }}"
                    aria-label="Play {{ $sound->title }}" onclick="playAudio(this)">
                </button>
            </div>

            <!-- Simple Music Player Bar -->
            <div class="audio-player-row">
                <button id="player-play-btn" class="player-ctrl-btn" onclick="togglePlay()" aria-label="Play/Pause">
                    <!-- Play icon -->
                    <svg id="play-icon" viewBox="0 0 24 24">
                        <path d="M8 5v14l11-7z" />
                    </svg>
                    <!-- Pause icon (hidden by default) -->
                    <svg id="pause-icon" viewBox="0 0 24 24" style="display: none;">
                        <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                    </svg>
                </button>

                <span id="player-current-time" class="player-time">0:00</span>

                <div class="progress-bar-wrapper">
                    <input type="range" id="player-progress" class="player-progress" min="0" max="100"
                        value="0" step="0.01">
                </div>

                <span id="player-duration" class="player-time">0:00</span>

                <div class="volume-container">
                    <button id="player-volume-btn" class="volume-btn" onclick="toggleMute()" aria-label="Mute/Unmute">
                        <svg id="volume-icon" viewBox="0 0 24 24">
                            <path
                                d="M3 9v6h4l5 5V4L7 9H3zm13.5 3c0-1.77-1.02-3.29-2.5-4.03v8.05c1.48-.73 2.5-2.25 2.5-4.02zM14 3.23v2.06c2.89.86 5 3.54 5 6.71s-2.11 5.85-5 6.71v2.06c4.01-.91 7-4.49 7-8.77s-2.99-7.86-7-8.77z" />
                        </svg>
                        <svg id="mute-icon" viewBox="0 0 24 24" style="display: none;">
                            <path
                                d="M16.5 12c0-1.77-1.02-3.29-2.5-4.03v2.21l2.45 2.45c.03-.21.05-.42.05-.63zm2.5 0c0 .94-.2 1.82-.54 2.64l1.51 1.51C20.63 14.91 21 13.5 21 12c0-4.28-2.99-7.86-7-8.77v2.06c2.89.86 5 3.54 5 6.71zM4.27 3L3 4.27 7.73 9H3v6h4l5 5v-6.73l4.25 4.25c-.67.52-1.42.93-2.25 1.18v2.06c1.38-.31 2.63-.95 3.69-1.81L19.73 21 21 19.73l-9-9L4.27 3zM12 4L9.91 6.09 12 8.18V4z" />
                        </svg>
                    </button>
                    <input type="range" id="player-volume-slider" class="volume-slider" min="0" max="1"
                        value="1" step="0.05" oninput="setVolume(this.value)">
                </div>
            </div>

            <div class="detail-actions">
                <!-- Favorite -->
                <button id="fav-btn" class="large-action-btn" onclick="toggleFavorite()">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z" />
                    </svg>
                    <span id="fav-text">Yêu thích</span>
                </button>

                <!-- Copy Link -->
                <button class="large-action-btn" onclick="copyLink()">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M3.9 12c0-1.71 1.39-3.1 3.1-3.1h4V7H7c-2.76 0-5 2.24-5 5s2.24 5 5 5h4v-1.9H7c-1.71 0-3.1-1.39-3.1-3.1zM8 13h8v-2H8v2zm9-6h-4v1.9h4c1.71 0 3.1 1.39 3.1 3.1s-1.39 3.1-3.1 3.1h-4V17h4c2.76 0 5-2.24 5-5s-2.24-5-5-5z" />
                    </svg>
                    <span>Copy Link</span>
                </button>

                <!-- Download MP3 -->
                <a href="{{ $audioUrl }}" download="{{ $sound->slug }}.mp3" class="large-action-btn">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M19.35 10.04C18.67 6.59 15.64 4 12 4 9.11 4 6.6 5.64 5.35 8.04 2.34 8.36 0 10.91 0 14c0 3.31 2.69 6 6 6h13c2.76 0 5-2.24 5-5 0-2.64-2.05-4.78-4.65-4.96zM17 13l-5 5-5-5h3V9h4v4h3z" />
                    </svg>
                    <span>Tải MP3</span>
                </a>
            </div>

            <!-- File Information Table -->
            @php
                $fileSizeStr = 'Không rõ';
                if ($sound->local_path && file_exists(public_path($sound->local_path))) {
                    $bytes = filesize(public_path($sound->local_path));
                    if ($bytes >= 1048576) {
                        $fileSizeStr = number_format($bytes / 1048576, 2) . ' MB';
                    } elseif ($bytes >= 1024) {
                        $fileSizeStr = number_format($bytes / 1024, 0) . ' KB';
                    } else {
                        $fileSizeStr = $bytes . ' Bytes';
                    }
                }
            @endphp
            <div class="file-info-box" style="text-align: left; width: 100%; padding-top: 20px;">
                <table style="width: 100%; border-collapse: collapse; font-size: 13.5px; color: var(--text-muted); margin-bottom: 20px;">
                    <tbody>
                        <tr>
                            <td style="padding: 8px 0; font-weight: 600; color: #ffffff; width: 120px;">Bản quyền:</td>
                            <td style="padding: 8px 0;">Miễn phí (Free)</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; font-weight: 600; color: #ffffff;">Thể loại:</td>
                            <td style="padding: 8px 0;">
                                <a href="{{ url('/?category=' . ($sound->category->slug ?? '')) }}" style="color: #3b82f6; text-decoration: none; font-weight: 600;">
                                    {{ $sound->category->name ?? 'Meme' }}
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; font-weight: 600; color: #ffffff;">Định dạng:</td>
                            <td style="padding: 8px 0;">.mp3</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; font-weight: 600; color: #ffffff;">Dung lượng:</td>
                            <td style="padding: 8px 0;">{{ $fileSizeStr }}</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; font-weight: 600; color: #ffffff;">Chất lượng:</td>
                            <td style="padding: 8px 0;">Chất lượng gốc (HQ)</td>
                        </tr>
                        <tr>
                            <td style="padding: 8px 0; font-weight: 600; color: #ffffff;">Cung cấp bởi:</td>
                            <td style="padding: 8px 0; font-weight: 600; color: #ef4444;">AMMP3.com</td>
                        </tr>
                    </tbody>
                </table>

                <h3 style="font-size: 15px; font-weight: 700; color: #ffffff; margin-bottom: 10px;">
                    Mô tả chi tiết:
                </h3>
                <p style="font-size: 13.5px; color: var(--text-muted); line-height: 1.6; margin: 0;">
                    <strong>{{ $sound->title }}</strong> là hiệu ứng âm thanh chất lượng cao thuộc danh mục 
                    <a href="{{ url('/?category=' . ($sound->category->slug ?? '')) }}" style="color: #3b82f6; text-decoration: none; font-weight: 600;">{{ $sound->category->name ?? 'Meme' }}</a>.
                    @if($sound->description)
                        {{ $sound->description }}
                    @else
                        Đây là đoạn âm thanh cực hay phù hợp dùng làm hiệu ứng tiếng động chèn vào các video hài hước, làm clip chế meme troll, dựng phim ngắn chuyên nghiệp, hoặc edit video ngắn trên các nền tảng mạng xã hội phổ biến như TikTok, YouTube Shorts, CapCut, Facebook Reels.
                    @endif
                </p>

                @if(isset($sound->tags) && $sound->tags->count() > 0)
                    <p style="margin-top: 15px; font-size: 13.5px; color: var(--text-muted); line-height: 1.6;">
                        <span style="font-weight: 600; color: #ffffff; margin-right: 5px;">Chủ đề liên quan:</span>
                        @foreach($sound->tags as $tag)
                            <a href="{{ url('/tag/' . $tag->slug) }}" style="color: #3b82f6; text-decoration: none; margin-right: 8px; font-weight: 600; display: inline-block;">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </p>
                @endif
            </div>

            <a href="{{ url('/') }}" class="back-link">Quay lại danh sách chính</a>
        </div>

        <!-- Related Sounds Section -->
        @if(isset($relatedSounds) && $relatedSounds->count() > 0)
        <div class="related-sounds-section">
            <h2 class="related-title">
                Âm thanh cùng chủ đề
            </h2>
            <div class="related-sounds-list">
                @php
                    $colors = ['red', 'green', 'blue', 'orange', 'purple', 'cyan', 'pink', 'yellow', 'indigo', 'teal'];
                @endphp
                @foreach($relatedSounds as $relSound)
                    @php
                        $color = $colors[($relSound->id) % count($colors)];
                        $relAudioUrl = $relSound->local_path ? asset($relSound->local_path) : $relSound->mp3_url;
                    @endphp
                    <div class="related-sound-item" id="card-{{ $relSound->id }}">
                        <div class="play-col">
                            <button 
                                id="play-btn-{{ $relSound->id }}"
                                class="list-play-btn" 
                                data-audio="{{ $relAudioUrl }}"
                                title="Phát {{ $relSound->title }}"
                                aria-label="Play {{ $relSound->title }}"
                                onclick="playRelatedAudio(this, '{{ $relSound->id }}')">
                                <!-- Triangle Play Icon -->
                                <svg class="play-svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8 5v14l11-7z" />
                                </svg>
                                <!-- Pause Icon -->
                                <svg class="pause-svg" viewBox="0 0 24 24" fill="currentColor" style="display: none;">
                                    <path d="M6 19h4V5H6v14zm8-14v14h4V5h-4z" />
                                </svg>
                            </button>
                        </div>
                        
                        <div class="info-col">
                            <a href="{{ url('/' . $relSound->slug . '-' . $relSound->id) }}" class="sound-title-link" title="{{ $relSound->title }}" id="title-link-{{ $relSound->id }}">
                                {{ $relSound->title }}
                            </a>
                        </div>

                        <div class="actions-col">
                            <!-- Favorite Button -->
                            <button 
                                id="fav-btn-{{ $relSound->id }}"
                                class="action-btn" 
                                title="Thêm vào yêu thích" 
                                aria-label="Favorite {{ $relSound->title }}"
                                onclick="toggleRelatedFavorite('{{ $relSound->id }}')">
                                <svg viewBox="0 0 24 24"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Suggested Topics Section -->
        @if(isset($globalCategories) && count($globalCategories) > 0)
        <div class="suggested-topics-section">
            <h2 class="related-title">
                Chủ đề đề xuất
            </h2>
            <div class="topics-grid">
                @foreach ($globalCategories as $cat)
                    <a href="{{ url('/' . $cat->slug) }}" class="topic-pill">
                        # {{ $cat->name }}
                    </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Bottom Search Bar Section -->
        <div class="bottom-search-section" style="width: 100%; max-width: 600px; margin: 40px auto 10px auto; box-sizing: border-box;">
            <form action="{{ url('/') }}" method="GET" style="position: relative; width: 100%; display: flex; align-items: center;">
                <input type="text" name="s" placeholder="Tìm kiếm âm thanh, tiếng động..." style="width: 100%; padding: 14px 50px 14px 20px; border-radius: 12px; border: 1px solid #334155; background-color: #1e293b; color: #ffffff; font-size: 15px; outline: none; transition: all 0.2s ease; box-shadow: 0 4px 6px rgba(0,0,0,0.2);" onfocus="this.style.borderColor='#ef4444'; this.style.boxShadow='0 0 0 2px rgba(239, 68, 68, 0.2)'" onblur="this.style.borderColor='#334155'; this.style.boxShadow='0 4px 6px rgba(0,0,0,0.2)'">
                <button type="submit" style="background: none; border: none; position: absolute; right: 16px; top: 50%; transform: translateY(-50%); color: var(--text-muted); cursor: pointer; display: flex; align-items: center; justify-content: center; padding: 0;">
                    <svg style="width: 20px; height: 20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
            </form>
        </div>

    </main>

    <!-- Footer -->
    <footer>
        <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 10px;">
            <a href="{{ url('/gioi-thieu') }}"
                style="color: var(--text-muted); text-decoration: none; font-size: 12px;">Giới thiệu</a>
            <span style="color: var(--border-color); font-size: 12px;">|</span>
            <a href="{{ url('/chinh-sach') }}"
                style="color: var(--text-muted); text-decoration: none; font-size: 12px;">Chính sách</a>
            <span style="color: var(--border-color); font-size: 12px;">|</span>
            <a href="{{ url('/lien-he') }}"
                style="color: var(--text-muted); text-decoration: none; font-size: 12px;">Liên hệ</a>
        </div>
        <p>&copy; {{ date('Y') }} AMMP3.com. Bản quyền nội dung âm thanh thuộc về các tác giả gốc.</p>
    </footer>

    <!-- Toast Notification Element -->
    <div id="toast" class="toast">Đã sao chép liên kết!</div>

    <!-- JS Audio & Favorites Logic -->
    <script>
        const soundId = "{{ $sound->id }}";
        const audioUrl = "{{ $audioUrl }}";
        const favoritedIds = JSON.parse(localStorage.getItem('fav_sounds') || '[]');

        // Related sounds audio cache
        const relatedAudioElements = {};
        let currentlyPlayingRelatedId = null;

        // Native HTML5 Audio Element - supports streaming and instant playback
        const audio = new Audio(audioUrl);
        audio.preload = 'auto'; // Load automatically on detail page load

        const playBtn = document.getElementById('play-btn');
        const playerPlayBtn = document.getElementById('player-play-btn');
        const playIcon = document.getElementById('play-icon');
        const pauseIcon = document.getElementById('pause-icon');
        const currentTimeEl = document.getElementById('player-current-time');
        const durationEl = document.getElementById('player-duration');
        const progressSlider = document.getElementById('player-progress');
        const volumeBtn = document.getElementById('player-volume-btn');
        const volumeSlider = document.getElementById('player-volume-slider');
        const volumeIcon = document.getElementById('volume-icon');
        const muteIcon = document.getElementById('mute-icon');

        let isDragging = false;

        // Helper to format time
        function formatTime(seconds) {
            if (isNaN(seconds) || seconds < 0) return '0:00';
            const mins = Math.floor(seconds / 60);
            const secs = Math.floor(seconds % 60);
            return `${mins}:${secs < 10 ? '0' : ''}${secs}`;
        }

        function updateDuration() {
            if (audio.duration && !isNaN(audio.duration) && isFinite(audio.duration)) {
                durationEl.textContent = formatTime(audio.duration);
                progressSlider.max = audio.duration;
            }
        }        // Initialize when page loads
        document.addEventListener('DOMContentLoaded', () => {
            initFavoriteUI();
            setupDropdown();
            
            // Listen to metadata loaded
            audio.addEventListener('loadedmetadata', updateDuration);
            audio.addEventListener('durationchange', updateDuration);
            audio.addEventListener('canplay', updateDuration);
            
            // In case it's already loaded
            if (audio.readyState >= 1 || (audio.duration && !isNaN(audio.duration))) {
                updateDuration();
            }

            // Listen to time updates
            audio.addEventListener('timeupdate', () => {
                progressSlider.value = audio.currentTime;
                currentTimeEl.textContent = formatTime(audio.currentTime);
            });

            // Audio ended
            audio.addEventListener('ended', () => {
                resetPlayerState();
            });
        });
        function playAudio(btn) {
            togglePlay();
        }

        function togglePlay() {
            // Stop related sounds if any are playing
            Object.keys(relatedAudioElements).forEach(key => {
                const otherAudio = relatedAudioElements[key];
                otherAudio.pause();
                otherAudio.currentTime = 0;
                const otherBtn = document.getElementById(`play-btn-${key}`);
                if (otherBtn) {
                    otherBtn.classList.remove('playing');
                    const oPlayIcon = otherBtn.querySelector('.play-svg');
                    const oPauseIcon = otherBtn.querySelector('.pause-svg');
                    if (oPlayIcon) oPlayIcon.style.display = 'block';
                    if (oPauseIcon) oPauseIcon.style.display = 'none';
                }
            });
            currentlyPlayingRelatedId = null;

            if (audio.paused) {
                // Play
                audio.play().catch(e => console.error("Playback failed:", e));
                playBtn.classList.add('playing');
                playIcon.style.display = 'none';
                pauseIcon.style.display = 'block';
                updateDuration();
            } else {
                // Pause
                audio.pause();
                playBtn.classList.remove('playing');
                playIcon.style.display = 'block';
                pauseIcon.style.display = 'none';
            }
        }

        function resetPlayerState() {
            playBtn.classList.remove('playing');
            playIcon.style.display = 'block';
            pauseIcon.style.display = 'none';
            progressSlider.value = 0;
            currentTimeEl.textContent = '0:00';
        }

        // Volume Controls
        function setVolume(val) {
            audio.volume = parseFloat(val);
            audio.muted = false;
            updateVolumeUI();
        }

        function toggleMute() {
            audio.muted = !audio.muted;
            updateVolumeUI();
        }

        function updateVolumeUI() {
            if (audio.muted || audio.volume === 0) {
                volumeIcon.style.display = 'none';
                muteIcon.style.display = 'block';
                volumeSlider.value = 0;
            } else {
                volumeIcon.style.display = 'block';
                muteIcon.style.display = 'none';
                volumeSlider.value = audio.volume;
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
            if (favBtn && (favoritedIds.includes(soundId.toString()) || favoritedIds.includes(soundId))) {
                favBtn.classList.add('active-fav');
                if (favText) favText.textContent = 'Đã Yêu thích';
            }

            // Sync related sounds favorite icons
            favoritedIds.forEach(id => {
                const btn = document.getElementById(`fav-btn-${id}`);
                if (btn) {
                    btn.classList.add('active-fav');
                }
            });
        }

        // Dropdown setup
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

        // Toggle Favorite
        function toggleFavorite() {
            const index = favoritedIds.indexOf(soundId.toString());
            const indexStr = favoritedIds.indexOf(soundId);
            const finalIndex = index !== -1 ? index : indexStr;
            const favBtn = document.getElementById('fav-btn');
            const favText = document.getElementById('fav-text');
            const relatedFavBtn = document.getElementById(`fav-btn-${soundId}`);

            if (finalIndex === -1) {
                favoritedIds.push(soundId.toString());
                if (favBtn) favBtn.classList.add('active-fav');
                if (favText) favText.textContent = 'Đã Yêu thích';
                if (relatedFavBtn) relatedFavBtn.classList.add('active-fav');
            } else {
                favoritedIds.splice(finalIndex, 1);
                if (favBtn) favBtn.classList.remove('active-fav');
                if (favText) favText.textContent = 'Yêu thích';
                if (relatedFavBtn) relatedFavBtn.classList.remove('active-fav');
            }

            localStorage.setItem('fav_sounds', JSON.stringify(favoritedIds));
        }

        // Toggle Favorite for Related Sounds
        function toggleRelatedFavorite(id) {
            const index = favoritedIds.indexOf(id.toString());
            const indexStr = favoritedIds.indexOf(id);
            const finalIndex = index !== -1 ? index : indexStr;
            const favBtn = document.getElementById(`fav-btn-${id}`);

            if (finalIndex === -1) {
                favoritedIds.push(id.toString());
                if (favBtn) favBtn.classList.add('active-fav');
            } else {
                favoritedIds.splice(finalIndex, 1);
                if (favBtn) favBtn.classList.remove('active-fav');
            }

            localStorage.setItem('fav_sounds', JSON.stringify(favoritedIds));

            // If the related sound is the same as the main page sound, sync main UI
            if (id.toString() === soundId.toString()) {
                const mainFavBtn = document.getElementById('fav-btn');
                const mainFavText = document.getElementById('fav-text');
                if (mainFavBtn) {
                    if (finalIndex === -1) {
                        mainFavBtn.classList.add('active-fav');
                        if (mainFavText) mainFavText.textContent = 'Đã Yêu thích';
                    } else {
                        mainFavBtn.classList.remove('active-fav');
                        if (mainFavText) mainFavText.textContent = 'Yêu thích';
                    }
                }
            }
        }

        // Copy Link for Related Sounds
        function copyRelatedLink(url) {
            navigator.clipboard.writeText(url).then(() => {
                showToast("Đã sao chép liên kết chi tiết!");
            }).catch(() => {
                showToast("Không thể sao chép liên kết.");
            });
        }

        // Play related audio functions
        function getRelatedAudio(id, url) {
            if (!relatedAudioElements[id]) {
                const a = new Audio(url);
                a.preload = 'none';
                relatedAudioElements[id] = a;
                a.addEventListener('ended', () => {
                    const btn = document.getElementById(`play-btn-${id}`);
                    if (btn) {
                        btn.classList.remove('playing');
                        const playIcon = btn.querySelector('.play-svg');
                        const pauseIcon = btn.querySelector('.pause-svg');
                        if (playIcon) playIcon.style.display = 'block';
                        if (pauseIcon) pauseIcon.style.display = 'none';
                    }
                    if (currentlyPlayingRelatedId === id) {
                        currentlyPlayingRelatedId = null;
                    }
                });
            }
            return relatedAudioElements[id];
        }

        function playRelatedAudio(btn, id) {
            const relAudioUrl = btn.getAttribute('data-audio');
            const relAudio = getRelatedAudio(id, relAudioUrl);

            // 1. Stop main audio playing
            if (!audio.paused) {
                audio.pause();
                resetPlayerState();
            }

            // 2. Stop other related audios
            Object.keys(relatedAudioElements).forEach(key => {
                if (key !== id) {
                    const otherAudio = relatedAudioElements[key];
                    otherAudio.pause();
                    otherAudio.currentTime = 0;
                    const otherBtn = document.getElementById(`play-btn-${key}`);
                    if (otherBtn) {
                        otherBtn.classList.remove('playing');
                        const oPlayIcon = otherBtn.querySelector('.play-svg');
                        const oPauseIcon = otherBtn.querySelector('.pause-svg');
                        if (oPlayIcon) oPlayIcon.style.display = 'block';
                        if (oPauseIcon) oPauseIcon.style.display = 'none';
                    }
                }
            });

            // 3. Toggle this one
            const playIcon = btn.querySelector('.play-svg');
            const pauseIcon = btn.querySelector('.pause-svg');

            if (currentlyPlayingRelatedId === id && !relAudio.paused) {
                relAudio.pause();
                relAudio.currentTime = 0;
                btn.classList.remove('playing');
                if (playIcon) playIcon.style.display = 'block';
                if (pauseIcon) pauseIcon.style.display = 'none';
                currentlyPlayingRelatedId = null;
            } else {
                btn.classList.add('playing');
                if (playIcon) playIcon.style.display = 'none';
                if (pauseIcon) pauseIcon.style.display = 'block';
                currentlyPlayingRelatedId = id;
                relAudio.play().catch(e => {
                    console.error("Playback failed:", e);
                    btn.classList.remove('playing');
                    if (playIcon) playIcon.style.display = 'block';
                    if (pauseIcon) pauseIcon.style.display = 'none';
                    currentlyPlayingRelatedId = null;
                });
            }
        }
    </script>
</body>

</html>
