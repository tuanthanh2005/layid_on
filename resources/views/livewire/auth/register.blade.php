<div class="auth-card">
    <h2>Đăng Ký</h2>
    <form wire:submit="register">
        <div class="form-group">
            <label>Họ và tên</label>
            <input type="text" wire:model="name" required placeholder="Nhập tên...">
            @error('name') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" wire:model="email" required placeholder="Nhập email...">
            @error('email') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Mật khẩu</label>
            <input type="password" wire:model="password" required placeholder="Tạo mật khẩu...">
            @error('password') <span style="color:red; font-size:0.85rem;">{{ $message }}</span> @enderror
        </div>
        <div class="form-group">
            <label>Xác nhận mật khẩu</label>
            <input type="password" wire:model="password_confirmation" required placeholder="Nhập lại mật khẩu...">
        </div>
        <button type="submit" class="btn btn-primary btn-block">
            <span wire:loading.remove wire:target="register">Đăng Ký <i class="fa-solid fa-user-plus"></i></span>
            <span wire:loading wire:target="register">Đang tạo...</span>
        </button>
        <div class="auth-links">
            <a wire:navigate href="/login">Đã có tài khoản? Đăng nhập</a>
        </div>
    </form>
</div>
