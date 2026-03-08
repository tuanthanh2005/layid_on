<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adminator - Premium Admin Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        :root {
            --sidebar-width: 260px;
            --header-height: 70px;
            --bg-color: #f8f9fa;
            --sidebar-bg: #ffffff;
            --text-primary: #313a46;
            --text-secondary: #6c757d;
            --accent-color: #3e8ef7;
            --border-color: #eef2f7;
            --card-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: var(--bg-color);
            color: var(--text-primary);
            overflow-x: hidden;
        }

        /* Layout */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */
        aside.sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            position: fixed;
            height: 100vh;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 25px;
            border-bottom: 1px solid var(--border-color);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            font-weight: 700;
            color: var(--accent-color);
            text-decoration: none;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
        }

        .menu-label {
            padding: 10px 25px;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #adb5bd;
            font-weight: 600;
        }

        .menu-item a {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: var(--text-secondary);
            text-decoration: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 14px;
            font-weight: 500;
            gap: 12px;
            border-radius: 8px;
            margin: 4px 15px;
        }

        .menu-item a:hover, .menu-item.active a {
            color: var(--accent-color);
            background: rgba(62, 142, 247, 0.08);
        }

        .menu-item.active a {
            font-weight: 600;
            background: rgba(62, 142, 247, 0.1);
        }

        /* Main Content */
        main.main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s ease;
        }

        /* Header */
        header.top-header {
            height: var(--header-height);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 30px;
            box-shadow: 0 0 35px 0 rgba(154, 161, 171, 0.05);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .header-left, .header-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .search-box {
            display: flex;
            align-items: center;
            background: #f1f3fa;
            padding: 8px 15px;
            border-radius: 30px;
            width: 250px;
        }

        .search-box input {
            background: transparent;
            border: none;
            outline: none;
            padding-left: 10px;
            width: 100%;
            font-size: 13px;
        }

        .icon-btn {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #fa5c7c;
            color: #fff;
            font-size: 10px;
            padding: 2px 5px;
            border-radius: 10px;
            border: 2px solid #fff;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            color: var(--text-secondary);
            font-size: 14px;
            font-weight: 500;
            position: relative;
            padding: 10px;
            border-radius: 8px;
        }

        .user-profile:hover {
            background: #f1f3fa;
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            width: 160px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
            border: 1px solid var(--border-color);
            padding: 10px 0;
            display: none;
            flex-direction: column;
            margin-top: 10px;
        }

        .profile-dropdown.show {
            display: flex;
        }

        .profile-dropdown a {
            padding: 10px 20px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.2s;
        }

        .profile-dropdown a:hover {
            color: var(--accent-color);
            background: rgba(62, 142, 247, 0.05);
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: #eee;
        }

        /* Dashboard Content */
        .content-body {
            padding: 30px;
        }

        .page-title {
            margin-bottom: 25px;
            font-size: 18px;
            font-weight: 700;
        }

        /* Responsive */
        @media (max-width: 992px) {
            aside.sidebar {
                transform: translateX(-100%);
            }
            main.main-content {
                margin-left: 0;
            }
            .sidebar-open aside.sidebar {
                transform: translateX(0);
            }
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <a href="#" class="logo">
                    <i data-lucide="layers"></i>
                    <span>ADMINATOR</span>
                </a>
            </div>
            <ul class="sidebar-menu">
                @if(Auth::user()->role === 'admin')
                <li class="menu-label">Main</li>
                <li class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i data-lucide="layout-dashboard" size="18"></i> Dashboard</a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.users.index') }}"><i data-lucide="users" size="18"></i> Quản lý khách hàng</a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.menus.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.menus.index') }}"><i data-lucide="menu" size="18"></i> Quản lý Menu</a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.posts.index') }}"><i data-lucide="file-text" size="18"></i> Quản lý trang chủ</a>
                </li>
                <li class="menu-item {{ request()->routeIs('admin.utilities.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.utilities.index') }}"><i data-lucide="blocks" size="18"></i> Quản lý tiện ích</a>
                </li>
                @endif
                @if(Auth::user()->role === 'admin')
                <li class="menu-item">
                    <a href="#"><i data-lucide="mail" size="18"></i> Email</a>
                </li>
                <li class="menu-item">
                    <a href="#"><i data-lucide="edit" size="18"></i> Compose</a>
                </li>
                <li class="menu-item">
                    <a href="#"><i data-lucide="calendar" size="18"></i> Calendar</a>
                </li>
                <li class="menu-item">
                    <a href="#"><i data-lucide="message-square" size="18"></i> Chat</a>
                </li>
                @endif
                
                @if(Auth::user()->role === 'admin')
                <li class="menu-label">UI Elements</li>
                <li class="menu-item">
                    <a href="#"><i data-lucide="pie-chart" size="18"></i> Charts</a>
                </li>
                <li class="menu-item">
                    <a href="#"><i data-lucide="check-square" size="18"></i> Forms</a>
                </li>
                <li class="menu-item">
                    <a href="#"><i data-lucide="box" size="18"></i> UI Elements</a>
                </li>
                @endif
                <li class="menu-label">Tài khoản</li>
                <li class="menu-item {{ request()->is('profile*') ? 'active' : '' }}">
                    <a href="{{ route('profile.index') }}"><i data-lucide="user" size="18"></i> Thông tin cá nhân</a>
                </li>
                <li class="menu-item {{ request()->is('orders*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}"><i data-lucide="shopping-bag" size="18"></i> Lịch sử đơn hàng</a>
                </li>
                <li class="menu-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #fa5c7c;">
                        <i data-lucide="log-out" size="18"></i> Đăng xuất
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <header class="top-header">
                <div class="header-left">
                    <button class="icon-btn" id="sidebar-toggle">
                        <i data-lucide="menu"></i>
                    </button>
                    <div class="search-box">
                        <i data-lucide="search" size="16"></i>
                        <input type="text" placeholder="Search...">
                    </div>
                </div>
                <div class="header-right">
                    <button class="icon-btn">
                        <i data-lucide="bell" size="20"></i>
                        <span class="badge">3</span>
                    </button>
                    <button class="icon-btn">
                        <i data-lucide="mail" size="20"></i>
                        <span class="badge">5</span>
                    </button>
                    <div class="user-profile" id="user-profile-trigger">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3e8ef7&color=fff" alt="Avatar" class="user-avatar">
                        <span>{{ Auth::user()->name }}</span>
                        <i data-lucide="chevron-down" size="16"></i>
                        
                        <div class="profile-dropdown" id="profile-dropdown">
                            <a href="{{ route('profile.index') }}"><i data-lucide="user" size="14" style="vertical-align: middle; margin-right: 5px;"></i> Profile</a>
                            <a href="{{ route('orders.index') }}"><i data-lucide="shopping-bag" size="14" style="vertical-align: middle; margin-right: 5px;"></i> Orders</a>
                            <hr style="border: none; border-top: 1px solid var(--border-color); margin: 5px 0;">
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="color: #fa5c7c;">
                                <i data-lucide="log-out" size="14" style="vertical-align: middle; margin-right: 5px;"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </header>

            <div class="content-body">
                @yield('content')
            </div>
        </main>
    </div>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3" style="z-index: 1100">
        @if(session('success'))
        <div id="successToast" class="toast align-items-center text-white bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i data-lucide="check-circle" size="18" class="me-2"></i> {{ session('success') }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif

        @if(session('error') || $errors->any())
        <div id="errorToast" class="toast align-items-center text-white bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i data-lucide="alert-circle" size="18" class="me-2"></i> {{ session('error') ?? $errors->first() }}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
        @endif
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Initialize Lucide icons
        lucide.createIcons();

        // Sidebar Toggle
        const toggleBtn = document.getElementById('sidebar-toggle');
        const body = document.body;

        if (toggleBtn) {
            toggleBtn.addEventListener('click', () => {
                body.classList.toggle('sidebar-open');
            });
        }

        // Profile Dropdown Toggle
        const profileTrigger = document.getElementById('user-profile-trigger');
        const profileDropdown = document.getElementById('profile-dropdown');

        if (profileTrigger && profileDropdown) {
            profileTrigger.addEventListener('click', (e) => {
                e.stopPropagation();
                profileDropdown.classList.toggle('show');
            });

            document.addEventListener('click', () => {
                profileDropdown.classList.remove('show');
            });
        }
    </script>
    @yield('scripts')
</body>
</html>
