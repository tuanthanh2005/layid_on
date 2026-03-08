<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang web chuyên cung cấp tool công nghệ: lấy mã 2FA, AI tips, chia sẻ thủ thuật.">
    <title>{{ $title ?? 'Tech Tools - Trang chuyên Công nghệ & AI' }}</title>
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @livewireStyles
</head>
<body class="dark-theme">
    <!-- Header -->
    <header class="app-header">
        <div class="container header-container">
            <div class="logo">
                <a href="/" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:10px;">
                    <i class="fa-solid fa-microchip logo-icon"></i>
                    <span class="logo-text">Tech<span class="highlight">Tools</span></span>
                </a>
            </div>
            
            <div class="search-bar">
                <input type="text" placeholder="Tìm kiếm công cụ, bài viết...">
                <button class="search-btn"><i class="fa-solid fa-search"></i></button>
            </div>

            <div class="auth-buttons">
                @auth
                    <span style="color: var(--accent-primary); margin-right: 15px; font-weight: bold; align-self: center;">
                        <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                    </span>
                    <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-outline">Đăng xuất</button>
                    </form>
                @else
                    <a href="/login" class="btn btn-outline" style="text-decoration:none; display:inline-block;">Đăng nhập</a>
                    <a href="/register" class="btn btn-primary" style="text-decoration:none; display:inline-block;">Đăng ký</a>
                @endauth
            </div>
            
            <button class="mobile-menu-btn" onclick="document.getElementById('nav-links').classList.toggle('show-mobile-nav')"><i class="fa-solid fa-bars"></i></button>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="app-nav">
        <div class="container nav-container">
            <ul class="nav-links" id="nav-links">
                <li><a wire:navigate href="/" class="{{ request()->is('/') ? 'active' : '' }}"><i class="fa-solid fa-home"></i> Trang chủ</a></li>
                <li><a wire:navigate href="/tools/2fa" class="{{ request()->is('tools/2fa') ? 'active' : '' }}"><i class="fa-solid fa-shield-halved"></i> 2FA Code</a></li>
                <li><a wire:navigate href="/placeholder/gemini" class="{{ request()->is('placeholder/gemini') ? 'active' : '' }}"><i class="fa-solid fa-robot"></i> Gemini Free/Watermark</a></li>
                <li><a wire:navigate href="/placeholder/blog" class="{{ request()->is('placeholder/blog') ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Blog & Mẹo AI</a></li>
                <li><a wire:navigate href="/placeholder/buff" class="{{ request()->is('placeholder/buff') ? 'active' : '' }}"><i class="fa-solid fa-fire"></i> Dịch vụ Mạng Xã Hội</a></li>
                <li><a wire:navigate href="/placeholder/proxy" class="{{ request()->is('placeholder/proxy') ? 'active' : '' }}"><i class="fa-solid fa-network-wired"></i> Proxy Giá Rẻ</a></li>
            </ul>
        </div>
    </nav>
    <style>
        .show-mobile-nav {
            display: flex !important;
            flex-direction: column;
            position: absolute;
            top: 100%;
            left: 0;
            width: 100%;
            background: var(--bg-primary);
            padding: 20px;
            z-index: 999;
        }
    </style>

    <!-- Main Content Area -->
    <main class="app-main container">
        {{ $slot }}
    </main>

    <!-- Footer -->
    <footer class="app-footer">
        <div class="container footer-container">
            <div class="footer-column">
                <div class="logo">
                    <span class="logo-text">Tech<span class="highlight">Tools</span></span>
                </div>
                <p class="footer-desc">Cung cấp các công cụ tiện ích mạnh mẽ, hệ thống proxy ổn định, mẹo AI mới nhất và đa dạng các dịch vụ mạng xã hội.</p>
            </div>
            <div class="footer-column">
                <h3>Khám phá</h3>
                <ul>
                    <li><a wire:navigate href="/tools/2fa">Công cụ 2FA</a></li>
                    <li><a wire:navigate href="/placeholder/blog">Blog công nghệ</a></li>
                    <li><a wire:navigate href="/placeholder/gemini">Mẹo sử dụng AI</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Dịch vụ</h3>
                <ul>
                    <li><a wire:navigate href="/placeholder/buff">Tăng tương tác MXH</a></li>
                    <li><a wire:navigate href="/placeholder/proxy">Proxy tư nhân</a></li>
                    <li><a href="#">Hỗ trợ khách hàng</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Theo dõi chúng tôi</h3>
                <div class="social-links">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-youtube"></i></a>
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2026 TechTools. Chuẩn SEO, Mobile Responsive (Laravel + Livewire).</p>
        </div>
    </footer>

    @livewireScripts
</body>
</html>
