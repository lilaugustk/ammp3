<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liên Hệ - AMMP3.com</title>
    <meta name="description" content="Liên hệ với ban quản trị website AMMP3.com để đóng góp ý kiến hoặc yêu cầu gỡ bỏ âm thanh bản quyền.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url('/lien-he') }}">
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
        .container { max-width: 600px; margin: 40px auto; padding: 0 15px; }
        h1 { font-size: 28px; margin-bottom: 20px; text-align: center; }
        p { margin-bottom: 20px; color: var(--text-muted); text-align: center; }
        
        /* Contact Form Styles */
        .contact-form-wrapper {
            background-color: var(--nav-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 30px 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #ffffff;
        }
        .form-control {
            width: 100%;
            padding: 10px 14px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            background-color: #1f2937;
            color: #ffffff;
            font-size: 14px;
            outline: none;
            font-family: inherit;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #3b82f6;
        }
        textarea.form-control {
            resize: vertical;
            min-height: 120px;
        }
        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: #1d4ed8;
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
        }
        .submit-btn:hover {
            background-color: #1e40af;
        }
        .submit-btn:disabled {
            background-color: #1e40af;
            opacity: 0.6;
            cursor: not-allowed;
        }
        
        /* Feedback Alerts */
        .alert {
            padding: 12px 15px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 20px;
            display: none;
        }
        .alert-success {
            background-color: #064e3b;
            border: 1px solid #047857;
            color: #34d399;
        }
        .alert-danger {
            background-color: #7f1d1d;
            border: 1px solid #b91c1c;
            color: #f87171;
        }

        .direct-contact {
            text-align: center;
            font-size: 13px;
            color: var(--text-muted);
        }
        .direct-contact a {
            color: #60a5fa;
            text-decoration: underline;
        }
        .direct-contact a:hover {
            color: #93c5fd;
        }

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
        <h1>Liên Hệ Với Chúng Tôi</h1>
        <p>Gửi thư đóng góp ý kiến, báo lỗi hoặc gửi yêu cầu gỡ bỏ âm thanh bản quyền. Chúng tôi sẽ phản hồi trong thời gian sớm nhất.</p>
        
        <div class="contact-form-wrapper">
            <!-- CSRF Token stored for JS fetch -->
            <meta name="csrf-token" content="{{ csrf_token() }}">

            <div id="successAlert" class="alert alert-success"></div>
            <div id="errorAlert" class="alert alert-danger"></div>

            <form id="contactForm" onsubmit="submitContactForm(event)">
                <div class="form-group">
                    <label for="name" class="form-label">Họ và tên <span style="color: #ef4444">*</span></label>
                    <input type="text" id="name" required class="form-control" placeholder="Nhập họ tên của bạn">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Địa chỉ Email <span style="color: #ef4444">*</span></label>
                    <input type="email" id="email" required class="form-control" placeholder="example@domain.com">
                </div>

                <div class="form-group">
                    <label for="subject" class="form-label">Tiêu đề liên hệ</label>
                    <input type="text" id="subject" class="form-control" placeholder="Ý kiến đóng góp, Báo lỗi, Bản quyền...">
                </div>

                <div class="form-group">
                    <label for="message" class="form-label">Nội dung tin nhắn <span style="color: #ef4444">*</span></label>
                    <textarea id="message" required class="form-control" placeholder="Nhập chi tiết nội dung tin nhắn của bạn (tối thiểu 10 ký tự)..."></textarea>
                </div>

                <button type="submit" id="submitBtn" class="submit-btn">Gửi thông tin liên hệ</button>
            </form>
        </div>

        <div class="direct-contact">
            Hoặc liên hệ trực tiếp qua hòm thư hỗ trợ: <a href="mailto:support@ammp3.com">support@ammp3.com</a>
        </div>
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

    <script>
        function submitContactForm(event) {
            event.preventDefault();
            
            const submitBtn = document.getElementById('submitBtn');
            const successAlert = document.getElementById('successAlert');
            const errorAlert = document.getElementById('errorAlert');
            
            // Ẩn các thông báo cũ
            successAlert.style.display = 'none';
            errorAlert.style.display = 'none';
            
            // Lấy dữ liệu form
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const subject = document.getElementById('subject').value;
            const message = document.getElementById('message').value;

            if (message.trim().length < 10) {
                errorAlert.textContent = 'Nội dung tin nhắn phải có tối thiểu 10 ký tự.';
                errorAlert.style.display = 'block';
                return;
            }

            // Disable submit button
            submitBtn.disabled = true;
            submitBtn.textContent = 'Đang gửi...';

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Gửi dữ liệu qua AJAX POST
            fetch("{{ url('/lien-he') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    name: name,
                    email: email,
                    subject: subject,
                    message: message
                })
            })
            .then(response => {
                if (!response.ok) {
                    return response.json().then(err => { throw err; });
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    successAlert.textContent = data.message;
                    successAlert.style.display = 'block';
                    document.getElementById('contactForm').reset();
                } else {
                    throw new Error(data.message || 'Có lỗi xảy ra khi gửi tin nhắn.');
                }
            })
            .catch(error => {
                let errorMsg = 'Không thể kết nối đến máy chủ. Vui lòng kiểm tra lại.';
                if (error.errors) {
                    // Hiển thị lỗi validate của Laravel
                    errorMsg = Object.values(error.errors).flat().join('<br>');
                } else if (error.message) {
                    errorMsg = error.message;
                }
                errorAlert.innerHTML = errorMsg;
                errorAlert.style.display = 'block';
            })
            .finally(() => {
                submitBtn.disabled = false;
                submitBtn.textContent = 'Gửi thông tin liên hệ';
            });
        }
    </script>
</body>
</html>
