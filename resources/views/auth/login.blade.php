<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập - Layid</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --primary: #3e8ef7;
            --bg: #f5f7fb;
            --text: #313a46;
        }
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg);
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
        }
        .login-card {
            background: white;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.05);
            width: 100%;
            max-width: 400px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            color: var(--primary);
            font-weight: 800;
            font-size: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
            color: #6c757d;
        }
        input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #eef2f7;
            border-radius: 8px;
            outline: none;
            transition: border 0.3s;
            box-sizing: border-box;
        }
        input:focus {
            border-color: var(--primary);
        }
        .btn {
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }
        .btn:hover {
            opacity: 0.9;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #6c757d;
        }
        .footer a {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
        }
        .error {
            color: #fa5c7c;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="header">
            <div class="logo">
                <i data-lucide="layers"></i>
                <span>LAYID</span>
            </div>
            <div class="title">Chào mừng trở lại!</div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required autofocus placeholder="name@example.com">
                @error('email') <div class="error">{{ $message }}</div> @enderror
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" required placeholder="••••••••">
                <div style="text-align: right; margin-top: 5px;">
                    <a href="{{ route('password.request') }}" style="font-size: 12px; color: var(--primary); text-decoration: none;">Quên mật khẩu?</a>
                </div>
            </div>
            <button type="submit" class="btn">Đăng nhập</button>
        </form>

        <div class="footer">
            Chưa có tài khoản? <a href="{{ route('register') }}">Đăng ký ngay</a>
        </div>
    </div>
    <script>lucide.createIcons();</script>
</body>
</html>
