class AppController {
    constructor() {
        this.root = document.getElementById('app.root');

        // Models
        this.authModel = new AuthModel();

        // Views
        this.homeView = new HomeView(this.root);
        this.authView = new AuthView(this.root, this);
        this.toolView = new ToolView(this.root);

        this.updateAuthNav();
        this.route(window.location.hash.substring(1) || '/');

        // Mobile Menu Toggle
        document.getElementById('mobile-menu-toggle').addEventListener('click', () => {
            const nav = document.getElementById('nav-links');
            nav.style.display = nav.style.display === 'flex' ? 'none' : 'flex';
            nav.style.flexDirection = 'column';
            nav.style.position = 'absolute';
            nav.style.top = '100%';
            nav.style.left = '0';
            nav.style.width = '100%';
            nav.style.background = 'var(--bg-primary)';
            nav.style.padding = '20px';
            nav.style.zIndex = '999';
        });
    }

    // --- Routing System (MVC Controller part) ---
    navigate(path) {
        window.history.pushState({}, path, window.location.pathname + '#' + path);
        this.route(path);

        // update nav active state
        document.querySelectorAll('.nav-links a').forEach(a => {
            a.classList.remove('active');
            if (a.getAttribute('onclick').includes(path === '/' ? "('/');" : `('${path}')`)) {
                a.classList.add('active');
            }
        });
    }

    route(path) {
        if (path === '/') {
            this.homeView.render();
        } else if (path === '/login') {
            this.authView.renderLogin();
        } else if (path === '/register') {
            this.authView.renderRegister();
        } else if (path === '/forgot') {
            this.authView.renderForgot();
        } else if (path === '/tools/2fa') {
            this.toolView.render2FA();
        } else if (path === '/tools/gemini') {
            this.toolView.renderPlaceholder('Khóa Tool AI & Gemini', 'Nhận tài khoản miễn phí và bộ công cụ loại bỏ Watermark ảnh của Google Gemini.');
        } else if (path === '/blog') {
            this.toolView.renderPlaceholder('Blog & Mẹo Sử dụng AI', 'Danh sách thư viện prompts, mẹo công nghệ tối ưu được cập nhật liên tục.');
        } else if (path === '/services/buff') {
            this.toolView.renderPlaceholder('Buff Tương Tác Mạng Xã Hội', 'Tăng Like, Share, Comment, Follow cho TikTok, Facebook, Instagram tự động hóa hoàn toàn.');
        } else if (path === '/services/proxy') {
            this.toolView.renderPlaceholder('Hệ Thống Proxy Nuôi Acc', 'Dịch vụ Residential IPv4/IPv6 private giá siêu rẻ, thay đổi IP liên tục.');
        } else {
            this.homeView.render();
        }
    }

    // --- Authentication Flow ---
    updateAuthNav() {
        const authContainer = document.getElementById('auth-container');
        if (this.authModel.isAuthenticated) {
            authContainer.innerHTML = `
                <span style="color: var(--accent-primary); margin-right: 15px; font-weight: bold; align-self: center;">
                    <i class="fa-solid fa-user"></i> ${this.authModel.user.name}
                </span>
                <button class="btn btn-outline" onclick="app.logout()">Đăng xuất</button>
            `;
        } else {
            authContainer.innerHTML = `
                <button class="btn btn-outline" onclick="app.navigate('/login')">Đăng nhập</button>
                <button class="btn btn-primary" onclick="app.navigate('/register')">Đăng ký</button>
            `;
        }
    }

    handleLogin(email, password) {
        this.authModel.login(email, password)
            .then(user => {
                alert('Đăng nhập thành công, kính chào ' + user.name);
                this.updateAuthNav();
                this.navigate('/');
            })
            .catch(err => alert(err));
    }

    handleRegister(email, password, confirmPassword) {
        this.authModel.register(email, password, confirmPassword)
            .then(res => {
                alert(res.msg);
                this.navigate('/login');
            })
            .catch(err => alert(err));
    }

    logout() {
        if (confirm('Bạn có chắc chắn muốn đăng xuất?')) {
            this.authModel.logout();
            this.updateAuthNav();
            this.navigate('/');
        }
    }
}
