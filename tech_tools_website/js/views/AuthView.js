class AuthView {
    constructor(rootElement, controller) {
        this.root = rootElement;
        this.controller = controller;
    }

    renderLogin() {
        this.root.innerHTML = `
            <div class="auth-card">
                <h2>Đăng Nhập</h2>
                <form id="login-form">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" required placeholder="Nhập email...">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" id="password" required placeholder="Nhập mật khẩu...">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Đăng Nhập <i class="fa-solid fa-arrow-right"></i></button>
                    <div class="auth-links">
                        <a href="#" onclick="app.navigate('/forgot'); return false;">Quên mật khẩu?</a> | 
                        <a href="#" onclick="app.navigate('/register'); return false;">Tạo tài khoản mới</a>
                    </div>
                </form>
            </div>
        `;

        document.getElementById('login-form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.controller.handleLogin(
                document.getElementById('email').value,
                document.getElementById('password').value
            );
        });
    }

    renderRegister() {
        this.root.innerHTML = `
            <div class="auth-card">
                <h2>Đăng Ký</h2>
                <form id="register-form">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="reg-email" required placeholder="Nhập email...">
                    </div>
                    <div class="form-group">
                        <label>Mật khẩu</label>
                        <input type="password" id="reg-password" required placeholder="Tạo mật khẩu...">
                    </div>
                    <div class="form-group">
                        <label>Xác nhận mật khẩu</label>
                        <input type="password" id="reg-confirm" required placeholder="Nhập lại mật khẩu...">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Đăng Ký <i class="fa-solid fa-user-plus"></i></button>
                    <div class="auth-links">
                        <a href="#" onclick="app.navigate('/login'); return false;">Đã có tài khoản? Đăng nhập</a>
                    </div>
                </form>
            </div>
        `;
        document.getElementById('register-form').addEventListener('submit', (e) => {
            e.preventDefault();
            this.controller.handleRegister(
                document.getElementById('reg-email').value,
                document.getElementById('reg-password').value,
                document.getElementById('reg-confirm').value
            );
        });
    }

    renderForgot() {
        this.root.innerHTML = `
            <div class="auth-card">
                <h2>Khôi Phục Mật Khẩu</h2>
                <p style="text-align: center; color: var(--text-secondary); margin-bottom: 20px;">Nhập email để nhận link đặt lại mật khẩu</p>
                <form id="forgot-form">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="forgot-email" required placeholder="Nhập email...">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Khôi Phục <i class="fa-solid fa-envelope"></i></button>
                    <div class="auth-links">
                        <a href="#" onclick="app.navigate('/login'); return false;">Quay lại Đăng nhập</a>
                    </div>
                </form>
            </div>
        `;
        // Handle logic inside controller if needed
    }
}
