<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Trang web chuyên cung cấp tool công nghệ: lấy mã 2FA, AI tips, chia sẻ thủ thuật.">
    <!-- Google Site Verification - Hardcoded -->
    <meta name="google-site-verification" content="CYV1HbKNuQkpzF8A-7k-VGvZC0m9X7F5zs7gNOn2-o8" />
    <title>{{ \App\Models\Setting::getVal('site_title', $title ?? 'Layid - Trang chuyên Công nghệ & AI') }}</title>
    <!-- Favicon động -->
    <link rel="icon" type="image/x-icon" href="{{ \App\Models\Setting::getVal('favicon', '/favicon.ico') }}">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- FontAwesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    
    <!-- CSS Biến màu động (Ưu tiên cao nhất để ghi đè màu xanh lá) -->
    <style>
        :root {
            --accent-primary: {{ \App\Models\Setting::getVal('theme_color', '#10b981') }};
            --accent-secondary: {{ \App\Models\Setting::getVal('theme_color_sub', '#059669') }};
            --primary-color: {{ \App\Models\Setting::getVal('theme_color', '#10b981') }};
            --bg-color: {{ \App\Models\Setting::getVal('bg_color', '#f8fafc') }};
            --text-primary: {{ \App\Models\Setting::getVal('text_color', '#334155') }};
        }
        body { background-color: var(--bg-color) !important; color: var(--text-primary) !important; }
        
        /* Ghi đè màu xanh lá của Zilly mặc định */
        .highlight, .logo-icon, .logo-text .highlight, .logo i, .nav-links a:hover, .nav-links a.active, .action-link, .tool-icon, .dropdown-menu li a:hover, .footer-column ul li a:hover {
            color: var(--accent-primary) !important;
        }
        
        .btn-primary, .bg-primary, .badge.bg-danger, .cart-badge, .search-btn, .tool-icon-wrapper:hover, .social-icon-btn:hover {
            background-color: var(--accent-primary) !important;
            border-color: var(--accent-primary) !important;
            color: white !important;
        }

        .btn-outline:hover {
            border-color: var(--accent-primary) !important;
            color: var(--accent-primary) !important;
            background-color: transparent !important;
        }

        /* Nút Tìm kiếm & Các nút submit */
        .search-btn, button#search-btn, .search-bar button, button[type="submit"].btn-primary {
            background-color: var(--accent-primary) !important;
            border-color: var(--accent-primary) !important;
        }
        .search-btn:hover {
            background-color: var(--accent-secondary) !important;
        }
        
        .search-bar:focus-within, .form-group input:focus {
            border-color: var(--accent-primary) !important;
        }
    </style>
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
            
            @livewire('header-search')

            <div class="auth-buttons">
                <!-- Lịch sử đơn hàng (Orders) -->
                <a href="{{ route('orders.index') }}" class="cart-icon" style="text-decoration:none; color: var(--text-primary); margin-right: 15px; font-size: 1.2rem; position: relative; display: flex; align-items: center;" title="Lịch sử đơn hàng">
                    <i class="fa-solid fa-clipboard-list"></i>
                    @auth
                        @php 
                            $orderCount = Auth::user()->orders()->where('status', 'pending')->count(); 
                        @endphp
                        @if($orderCount > 0)
                            <span class="cart-badge" style="position: absolute; top: -10px; right: -12px; background: #ef4444; color: white; font-size: 0.7rem; border-radius: 50%; padding: 2px 6px; font-weight: bold;">{{ $orderCount }}</span>
                        @endif
                    @endauth
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
            <div class="mobile-actions d-flex d-md-none">
                <button class="mobile-search-toggle-btn" onclick="document.querySelector('.search-bar').classList.toggle('show-mobile-search')">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
                <button class="mobile-menu-btn" onclick="document.getElementById('nav-links').classList.toggle('show-mobile-nav')">
                    <i class="fa-solid fa-bars"></i>
                </button>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="app-nav">
        <div class="container nav-container">
            <ul class="nav-links" id="nav-links">
                @foreach($public_menus as $menu)
                    @if($menu->submenus->count() > 0)
                        <li class="has-dropdown">
                            <a href="{{ $menu->url }}" 
                               class="{{ request()->is(ltrim($menu->url, '/').'*') ? 'active' : '' }}"
                               onclick="if(window.innerWidth <= 768) { event.preventDefault(); event.stopPropagation(); this.parentElement.classList.toggle('open'); return false; }">
                                @if($menu->icon) <i class="{{ $menu->icon }}"></i> @endif
                                {{ $menu->name }} 
                                <i class="fa-solid fa-chevron-down" style="font-size: 0.8em; margin-left: auto;"></i>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach($menu->submenus as $submenu)
                                    <li>
                                        <a wire:navigate href="{{ $submenu->url }}">
                                            @if($submenu->icon) <i class="{{ $submenu->icon }}"></i> @endif
                                            {{ $submenu->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                    @else
                        <li>
                            <a wire:navigate href="{{ $menu->url }}" class="{{ request()->is(ltrim($menu->url, '/')) ? 'active' : '' }}">
                                @if($menu->icon) <i class="{{ $menu->icon }}"></i> @endif
                                {{ $menu->name }}
                            </a>
                        </li>
                    @endif
                @endforeach
                
                <!-- MOBILE AUTH ACTIONS -->
                <li class="d-md-none border-top pt-3 mt-2">
                    <a wire:navigate href="{{ route('orders.index') }}" class="d-flex align-items-center gap-2">
                        <i class="fa-solid fa-clipboard-list text-secondary"></i> Lịch sử đơn hàng
                        @auth
                            @php 
                                $orderCount = Auth::user()->orders()->where('status', 'pending')->count();
                            @endphp
                            @if($orderCount > 0)
                                <span class="badge bg-danger rounded-pill">{{ $orderCount }}</span>
                            @endif
                        @endauth
                    </a>
                </li>
                @auth
                    <li class="d-md-none">
                        @if(Auth::user()->role === 'admin')
                            <a wire:navigate href="{{ route('admin.dashboard') }}" style="color: var(--accent-primary);"><i class="fa-solid fa-user-shield"></i> Quản trị viên</a>
                        @else
                            <a wire:navigate href="{{ route('profile.index') }}" style="color: var(--accent-primary);"><i class="fa-solid fa-user"></i> {{ Auth::user()->name }}</a>
                        @endif
                    </li>
                    <li class="d-md-none">
                        <form method="POST" action="{{ route('logout') }}" class="w-100 m-0">
                            @csrf
                            <button type="submit" style="background:none; border:none; padding:10px 0; color:#ef4444; font-size:0.95rem; font-weight:500; display:flex; align-items:center; gap:8px;">
                                <i class="fa-solid fa-right-from-bracket"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                @else
                    <li class="d-md-none mt-3 pb-2 d-flex gap-3">
                        <a href="/login" class="btn btn-outline flex-grow-1 text-center" style="padding: 8px 15px; justify-content:center;">Đăng nhập</a>
                        <a href="/register" class="btn btn-primary flex-grow-1 text-center" style="padding: 8px 15px; border:none; justify-content:center;">Đăng ký</a>
                    </li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Main Content Area -->
    <main class="app-main container">
        @isset($slot)
            {{ $slot }}
        @else
            @yield('content')
        @endisset
    </main>

    <!-- Footer -->
    <footer class="app-footer py-5 border-top bg-white">
        <div class="container footer-container">
            <div class="footer-column">
                <div class="logo mb-3">
                    <a href="/" style="text-decoration:none; color:inherit; display:flex; align-items:center; gap:10px;">
                        <i class="fa-solid fa-microchip logo-icon" style="font-size: 1.5rem; color: #10b981;"></i>
                        <span class="logo-text" style="font-size: 1.8rem;">Lay<span class="highlight">id</span></span>
                    </a>
                </div>
                <p class="footer-desc text-muted mb-4" style="line-height: 1.6;">Lấy ID Online - Nền tảng tổng hợp thủ thuật AI đỉnh cao, cung cấp tài khoản AI Premium giá rẻ và các công cụ tự động hóa mạnh mẽ nhất hiện nay.</p>
                <div class="contact-info small text-muted">
                    <div class="mb-2"><i class="fa-solid fa-envelope me-2 text-primary"></i> tranthanhtuanfix@gmail.com</div>
                    <div><i class="fa-solid fa-location-dot me-2 text-primary"></i> TP.HCM</div>
                </div>
            </div>
            <div class="footer-column">
                <h3 class="fw-bold fs-5 mb-4 text-dark">Khám phá AI</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a wire:navigate href="/store/ai-accounts" class="text-decoration-none text-muted hover-primary transition-all">Mua tài khoản AI giá rẻ</a></li>
                    <li class="mb-2"><a href="#" class="text-decoration-none text-muted hover-primary transition-all">Hỗ trợ khách hàng</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3 class="fw-bold fs-5 mb-4 text-dark">Liên kết nhanh</h3>
                <ul class="list-unstyled">
                    <li class="mb-2"><a wire:navigate href="/" class="text-decoration-none text-muted hover-primary transition-all">Trang Chủ</a></li>
                </ul>
            </div>
            <div class="footer-column">
                <h3 class="fw-bold fs-5 mb-4 text-dark">Theo dõi cộng đồng</h3>
                <p class="small text-muted mb-3">Tham gia cộng đồng cùng hàng nghìn người dùng thông thái.</p>
                <div class="social-links d-flex flex-column gap-3">
                    <a href="https://www.facebook.com/profile.php?id=61570761620125" class="social-link-item" target="_blank" rel="noopener noreferrer">
                        <span class="social-icon-btn facebook m-0"><i class="fa-brands fa-facebook-f"></i></span>
                        <span class="text-muted small fw-medium transition-all">Fanpage Facebook</span>
                    </a>
                    <a href="https://zalo.me/0772698113" class="social-link-item" target="_blank" rel="noopener noreferrer">
                        <span class="social-icon-btn zalo m-0"><i class="fa-solid fa-comment-dots"></i></span>
                        <span class="text-muted small fw-medium transition-all">Zalo Hỗ Trợ</span>
                    </a>
                    <a href="https://t.me/specademy" class="social-link-item" target="_blank" rel="noopener noreferrer">
                        <span class="social-icon-btn telegram m-0"><i class="fa-brands fa-telegram"></i></span>
                        <span class="text-muted small fw-medium transition-all">Telegram: @specademy</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom mt-5 pt-4 border-top text-center text-muted small">
            <p class="mb-0">&copy; 2026 <strong>Layid.online</strong>. Bảo lưu mọi quyền. <br class="d-md-none"> Tối ưu hóa hiệu suất bởi Layid Dev Team.</p>
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
