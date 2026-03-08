<div class="auth-card">
    <h2>Đăng Nhập</h2>
    <form wire:submit="login">
        <div class="form-group">
            <label>Email</label>
            <input type="email" wire:model="email" required placeholder="Nhập email...">
            @error('email') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" wire:model="password" required placeholder="Nhập mật khẩu...">
            @error('password') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            <span wire:loading.remove wire:target="login">Đăng Nhập <i class="fa-solid fa-arrow-right"></i></span>
            <span wire:loading wire:target="login">Đang xử lý...</span>
        </button>
        <div class="auth-links">
            <a href="#" onclick="alert('Mock quên mật khẩu'); return false;">Quên mật khẩu?</a> | 
            <a wire:navigate href="/register">Tạo tài khoản mới</a>
        </div>
    </form>
</div>
