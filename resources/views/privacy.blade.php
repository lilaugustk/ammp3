<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chính Sách Bảo Mật - AMMP3.com</title>
    <meta name="description" content="Chính sách bảo mật và điều khoản sử dụng khi sử dụng dịch vụ soundboard meme trên AMMP3.com.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/chinh-sach') }}">
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
        ul { margin-bottom: 15px; padding-left: 20px; color: var(--text-muted); }
        li { margin-bottom: 5px; }
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
        <h1>Chính Sách Bảo Mật & Điều Khoản</h1>
        <p>Chào mừng bạn đến với AMMP3.com. Quyền riêng tư của bạn là ưu tiên hàng đầu của chúng tôi. Trang này giải thích cách chúng tôi thu thập, sử dụng thông tin khi bạn truy cập website.</p>
        
        <h2>1. Thông tin chúng tôi thu thập</h2>
        <p>Chúng tôi không yêu cầu bạn đăng ký tài khoản để sử dụng các tính năng cơ bản của website. Chúng tôi chỉ thu thập một số thông tin kỹ thuật không định danh như địa chỉ IP ẩn danh, loại trình duyệt, hệ điều hành và thời gian truy cập nhằm phân tích lưu lượng truy cập và tối ưu trải nghiệm website.</p>

        <h2>2. Sử dụng Cookie và LocalStorage</h2>
        <p>Chúng tôi sử dụng <strong>LocalStorage</strong> trên trình duyệt của bạn để lưu danh sách các âm thanh bạn đã đánh dấu là "Yêu thích". Dữ liệu này được lưu trữ trực tiếp trên thiết bị của bạn và chúng tôi không đồng bộ lên máy chủ của chúng tôi.</p>

        <h2>3. Bản quyền âm thanh</h2>
        <p>Tất cả các tệp hiệu ứng âm thanh, tiếng động và nhạc nền được chia sẻ trên website này được thu thập từ các nguồn công khai trực tuyến. Bản quyền của các âm thanh thuộc về tác giả gốc. Nếu bạn là chủ sở hữu bản quyền và không muốn âm thanh của mình xuất hiện trên website, vui lòng liên hệ với chúng tôi để yêu cầu gỡ bỏ.</p>

        <h2>4. Thay đổi điều khoản</h2>
        <p>Chúng tôi có quyền cập nhật chính sách bảo mật này bất cứ lúc nào. Mọi thay đổi sẽ có hiệu lực ngay khi được đăng tải lên website.</p>
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
