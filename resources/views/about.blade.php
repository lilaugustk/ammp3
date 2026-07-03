<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giới Thiệu - AMMP3.com</title>
    <meta name="description" content="Giới thiệu về dự án AMMP3.com - Kho hiệu ứng âm thanh meme, tiếng cười, câu nói viral hài hước nhất.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/gioi-thieu') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #0b0f19;
            --nav-bg: #101726;
            --card-text: #ffffff;
            --text-muted: #9ca3af;
            --border-color: #1f2937;
            --font-family: 'Open Sans', -apple-system, BlinkMacSystemFont, sans-serif;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; -webkit-tap-highlight-color: transparent; }
        body { background-color: var(--bg-color); color: var(--card-text); font-family: var(--font-family); line-height: 1.6; }
        header { background-color: var(--nav-bg); border-bottom: 1px solid var(--border-color); position: sticky; top: 0; z-index: 100; }
        .navbar { max-width: 1200px; margin: 0 auto; display: flex; align-items: center; justify-content: space-between; padding: 15px; }
        .brand-logo { font-size: 22px; font-weight: 700; color: #ffffff; text-decoration: none; }
        .brand-logo span { color: #ef4444; }
        .nav-links { display: flex; gap: 15px; }
        .nav-link { color: #ffffff; text-decoration: none; font-size: 14px; font-weight: 600; }
        .nav-link:hover { text-decoration: underline; }
        .container { max-width: 800px; margin: 40px auto; padding: 0 15px; }
        h1 { font-size: 28px; margin-bottom: 20px; text-align: center; }
        h2 { font-size: 20px; margin: 25px 0 10px; color: #3b82f6; }
        p { margin-bottom: 15px; color: var(--text-muted); }
        footer { max-width: 1200px; margin: 50px auto 0; padding: 20px 15px; border-top: 1px solid var(--border-color); text-align: center; color: var(--text-muted); font-size: 12px; }
        .footer-links { display: flex; justify-content: center; gap: 15px; margin-bottom: 10px; }
        .footer-links a { color: var(--text-muted); text-decoration: none; }
        .footer-links a:hover { text-decoration: underline; color: #ffffff; }
    </style>
</head>
<body>
    <header>
        <div class="navbar">
            <a href="{{ url('/') }}" class="brand-logo">AMMP3 <span>.com</span></a>
            <nav class="nav-links">
                <a href="{{ url('/') }}" class="nav-link">Trang chủ</a>
            </nav>
        </div>
    </header>

    <main class="container">
        <h1>Giới Thiệu Về Chúng Tôi</h1>
        <p><strong>AMMP3.com</strong> là một nền tảng chia sẻ hiệu ứng âm thanh, tiếng động và nhạc nền meme hoàn toàn miễn phí.</p>
        
        <h2>Mục tiêu của chúng tôi</h2>
        <p>Chúng tôi mong muốn xây dựng một kho tài nguyên âm thanh hài hước, đa dạng và cập nhật xu hướng nhanh nhất, giúp cho các nhà sáng tạo nội dung (YouTuber, TikToker, Streamer) hoặc các biên tập viên video có được những tư liệu sinh động để lồng ghép vào sản phẩm của mình một cách dễ dàng và nhanh chóng.</p>

        <h2>Đơn giản & Tiện ích</h2>
        <p>Giao diện được thiết kế tối giản, tập trung vào trải nghiệm phát âm thanh tức thì và tải file nhanh chóng chỉ với một cú click chuột mà không yêu cầu các bước đăng ký hay chờ đợi phiền toái.</p>
    </main>

    <footer>
        <div class="footer-links">
            <a href="{{ url('/gioi-thieu') }}">Giới thiệu</a>
            <span>|</span>
            <a href="{{ url('/chinh-sach') }}">Chính sách</a>
            <span>|</span>
            <a href="{{ url('/lien-he') }}">Liên hệ</a>
        </div>
        <p>&copy; {{ date('Y') }} AMMP3.com. Bản quyền nội dung âm thanh thuộc về các tác giả gốc.</p>
    </footer>
</body>
</html>
