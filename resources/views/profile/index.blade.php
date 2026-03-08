@extends('layouts.admin')

@section('styles')
<style>
    .profile-card {
        max-width: 800px;
        margin: 0 auto;
    }
    .form-label {
        font-weight: 600;
        color: var(--text-secondary);
        font-size: 13px;
        margin-bottom: 8px;
    }
    .form-control {
        border: 1px solid #eef2f7;
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 14px;
        transition: all 0.2s;
    }
    .form-control:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(62, 142, 247, 0.1);
    }
    .btn-update {
        background: var(--accent-color);
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-update:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
    .btn-password {
        background: #fa5c7c;
        border: none;
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s;
    }
    .btn-password:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }
</style>
@endsection

@section('content')
<div class="profile-card">
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="page-title mb-0">Thiết lập tài khoản</h1>
        <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill" style="background: rgba(62, 142, 247, 0.1); color: var(--accent-color); border: 1px solid rgba(62, 142, 247, 0.2);">
            {{ ucfirst(Auth::user()->role) }} Account
        </span>
    </div>

    <div class="row g-4">
        <!-- User Information -->
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-primary bg-opacity-10 p-2 rounded-3 me-3">
                        <i data-lucide="user" class="text-primary"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Thông tin cá nhân</h5>
                </div>
                
                <form action="{{ route('profile.update') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Họ và tên</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email (Cố định)</label>
                            <input type="email" class="form-control bg-light" value="{{ $user->email }}" disabled>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="phone" class="form-control" value="{{ $user->phone }}" placeholder="Nhập số điện thoại...">
                        </div>
                        <div class="col-12">
                            <label class="form-label">Địa chỉ</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Địa chỉ nhận hàng của bạn...">{{ $user->address }}</textarea>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn-update d-flex align-items-center gap-2">
                                <i data-lucide="save" size="18"></i> Lưu thay đổi
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Change Password -->
        <div class="col-12">
            <div class="card border-0 shadow-sm p-4">
                <div class="d-flex align-items-center mb-4">
                    <div class="bg-danger bg-opacity-10 p-2 rounded-3 me-3">
                        <i data-lucide="lock" class="text-danger"></i>
                    </div>
                    <h5 class="mb-0 fw-bold">Đổi mật khẩu</h5>
                </div>
                
                <form action="{{ route('profile.password') }}" method="POST">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label">Mật khẩu hiện tại</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Mật khẩu mới</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>
                        <div class="col-12 mt-4">
                            <button type="submit" class="btn-password d-flex align-items-center gap-2">
                                <i data-lucide="shield-check" size="18"></i> Cập nhật mật khẩu
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
