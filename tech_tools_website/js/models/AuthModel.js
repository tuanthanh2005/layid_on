class AuthModel {
    constructor() {
        this.isAuthenticated = localStorage.getItem('isAuth') === 'true';
        this.user = JSON.parse(localStorage.getItem('user')) || null;
    }

    login(email, password) {
        // Mock API Call
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (email && password) {
                    this.isAuthenticated = true;
                    this.user = { email, name: 'Người dùng TechTools' };
                    localStorage.setItem('isAuth', 'true');
                    localStorage.setItem('user', JSON.stringify(this.user));
                    resolve(this.user);
                } else {
                    reject('Thiếu thông tin đăng nhập');
                }
            }, 600);
        });
    }

    register(email, password, confirmPassword) {
        return new Promise((resolve, reject) => {
            setTimeout(() => {
                if (password !== confirmPassword) {
                    reject('Mật khẩu không khớp!');
                } else if (!email) {
                    reject('Email không hợp lệ');
                } else {
                    resolve({ msg: 'Đăng ký thành công' });
                }
            }, 600);
        });
    }

    logout() {
        this.isAuthenticated = false;
        this.user = null;
        localStorage.removeItem('isAuth');
        localStorage.removeItem('user');
    }
}
