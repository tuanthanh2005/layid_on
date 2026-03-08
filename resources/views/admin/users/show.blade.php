@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-link link-secondary p-0 mb-2 text-decoration-none">
        <i data-lucide="arrow-left" size="14"></i> Quay lại danh sách
    </a>
    <h1 class="page-title">Chi tiết khách hàng</h1>
</div>

<div class="row g-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm text-center p-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&size=128&background=random" class="rounded-circle mx-auto mb-3" width="128" height="128">
            <h4 class="mb-1">{{ $user->name }}</h4>
            <p class="text-muted small mb-3">{{ $user->email }}</p>
            <div class="d-flex justify-content-center gap-2 mb-2">
                <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-3 border" style="background:rgba(62,142,247,0.1); border-color: rgba(62,142,247,0.2) !important;">
                    ID: #{{ $user->id }}
                </span>
                <span class="badge {{ $user->status ? 'bg-success' : 'bg-danger' }} px-3 py-2 rounded-3 border border-opacity-10">
                    {{ $user->status ? 'Hoạt động' : 'Đang khóa' }}
                </span>
            </div>
        </div>
    </div>
    
    <div class="col-md-8">
        <div class="card border-0 shadow-sm p-4">
            <h5 class="mb-4 fw-bold">Thông tin tài khoản</h5>
            <div class="row g-3">
                <div class="col-sm-6">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Họ tên</label>
                    <p class="mb-0 fw-semibold">{{ $user->name }}</p>
                </div>
                <div class="col-sm-6">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Email</label>
                    <p class="mb-0 fw-semibold">{{ $user->email }}</p>
                </div>
                <div class="col-sm-6">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Số điện thoại</label>
                    <p class="mb-0 fw-semibold">{{ $user->phone ?? 'Chưa cập nhật' }}</p>
                </div>
                <div class="col-sm-6">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Vai trò</label>
                    <p class="mb-0 text-capitalize fw-semibold">{{ $user->role }}</p>
                </div>
                <div class="col-12">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Địa chỉ</label>
                    <p class="mb-0 fw-semibold">{{ $user->address ?? 'Chưa cập nhật' }}</p>
                </div>
                <div class="col-sm-6">
                    <label class="text-muted small fw-bold text-uppercase d-block mb-1">Ngày tham gia</label>
                    <p class="mb-0 fw-semibold">{{ $user->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
            
            <div class="mt-5 pt-3 border-top d-flex gap-2">
                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-info text-white px-4 fw-bold">Chỉnh sửa</a>
                <form action="{{ route('admin.users.reset_password', $user) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-warning fw-bold px-4" onclick="return confirm('Reset mật khẩu về 123456?')">Reset Mật khẩu</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
