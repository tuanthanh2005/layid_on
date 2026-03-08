<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang web chuyên cung cấp tool công nghệ: lấy mã 2FA, AI tips, chia sẻ thủ thuật.">
    <title>{{ $title ?? 'Layid - Trang chuyên Công nghệ & AI' }}</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    @livewireStyles
</head>
<body class="light-theme">
    <!-- Header -->
    <header class="app-header">
        <div class="container header-container">
            <div class="logo">
                <a href="/" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:10px;">
                    <i class="fa-solid fa-microchip logo-icon"></i>
                    <span class="logo-text">Lay<span class="highlight">id</span></span>
                </a>
            </div>
            
            <div class="search-bar">
                <i class="fa-solid fa-magnifying-glass search-icon"></i>
                <input type="text" placeholder="Bạn đang tìm sản phẩm AI, công cụ nào...">
                <button class="search-btn">Tìm kiếm</button>
            </div>

            <div class="auth-buttons">
                <!-- Giỏ hàng (Cart) -->
                <a href="#" class="cart-icon" style="text-decoration:none; color: var(--text-primary); margin-right: 15px; font-size: 1.2rem; position: relative; display: flex; align-items: center;" title="Giỏ Hàng">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span class="cart-badge" style="position: absolute; top: -10px; right: -12px; background: #ef4444; color: white; font-size: 0.7rem; border-radius: 50%; padding: 2px 6px; font-weight: bold;">0</span>
                </a>

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" style="color: var(--accent-primary); margin-right: 15px; font-weight: bold; align-self: center; text-decoration: none;">
                            <i class="fa-solid fa-user-shield"></i> Quản trị viên
                        </a>
                    @else
                        <a href="{{ route('profile.index') }}" style="color: var(--accent-primary); margin-right: 15px; font-weight: bold; align-self: center; text-decoration: none;">
                            <i class="fa-solid fa-user"></i> {{ Auth::user()->name }}
                        </a>
                    @endif
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
                
                <li><a wire:navigate href="/store/ai-accounts" class="{{ request()->is('store/ai-accounts') ? 'active' : '' }}"><i class="fa-solid fa-store"></i> AI Giá Rẻ</a></li>
                
                <li class="has-dropdown">
                    <a wire:navigate href="/placeholder/gemini" class="{{ request()->is('placeholder/gemini') ? 'active' : '' }}"><i class="fa-solid fa-robot"></i> Tool AI <i class="fa-solid fa-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i></a>
                    <ul class="dropdown-menu">
                        <li><a wire:navigate href="/placeholder/gemini"><i class="fa-solid fa-gift"></i> Gemini Business Free</a></li>
                        <li><a wire:navigate href="/placeholder/watermark"><i class="fa-solid fa-eraser"></i> Xóa Watermark Ảnh</a></li>
                    </ul>
                </li>

                <li><a wire:navigate href="/tools/2fa" class="{{ request()->is('tools/2fa') ? 'active' : '' }}"><i class="fa-solid fa-shield-halved"></i> 2FA Code</a></li>

                <li class="has-dropdown">
                    <a wire:navigate href="/placeholder/buff" class="{{ request()->is('placeholder/buff') ? 'active' : '' }}"><i class="fa-solid fa-fire"></i> Dịch vụ MXH <i class="fa-solid fa-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i></a>
                    <ul class="dropdown-menu">
                        <li><a wire:navigate href="/placeholder/buff"><i class="fa-brands fa-tiktok"></i> Buff TikTok</a></li>
                        <li><a wire:navigate href="/placeholder/buff"><i class="fa-brands fa-facebook"></i> Buff Facebook</a></li>
                    </ul>
                </li>
                
                <li><a wire:navigate href="/courses" class="{{ request()->is('courses*') ? 'active' : '' }}"><i class="fa-solid fa-graduation-cap"></i> Học IT Miễn Phí</a></li>

                <li><a wire:navigate href="/blog" class="{{ request()->is('blog') ? 'active' : '' }}"><i class="fa-solid fa-book"></i> Blog & Mẹo AI</a></li>
                <li><a wire:navigate href="/movies" class="{{ request()->is('movies') ? 'active' : '' }}"><i class="fa-solid fa-film"></i> Review Phim</a></li>
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
                    <li><a wire:navigate href="/blog">Blog công nghệ</a></li>
                    <li><a wire:navigate href="/placeholder/gemini">Mẹo sử dụng AI</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3>Dịch vụ</h3>
                <ul>
                    <li><a wire:navigate href="/placeholder/buff">Tăng tương tác MXH</a></li>
                    <li><a wire:navigate href="/courses">Học IT Miễn Phí</a></li>
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
            <p>&copy; 2026 Layid.online. Chuẩn SEO, Mobile Responsive (Laravel + Livewire).</p>
        </div>
    </footer>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        @if(session('success'))
        <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if(session('error') || $errors->any())
        <div id="errorToast" class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('error') ?? $errors->first() }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Auto-hide toasts after 5 seconds
        document.querySelectorAll('.toast').forEach(toastEl => {
            const toast = new bootstrap.Toast(toastEl, { delay: 5000 });
            toast.show();
        });
    </script>
    @livewireScripts
</body>
</html>
