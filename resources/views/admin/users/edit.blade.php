@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-link link-secondary p-0 mb-2 text-decoration-none">
        <i data-lucide="arrow-left" size="14"></i> Quay lại danh sách
    </a>
    <h1 class="page-title">Chỉnh sửa thành viên</h1>
</div>

<div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold" style="color:var(--text-secondary); font-size:13px;">Họ và tên</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold" style="color:var(--text-secondary); font-size:13px;">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>
            
            <div class="col-md-3">
                <label class="form-label fw-bold" style="color:var(--text-secondary); font-size:13px;">Vai trò</label>
                <select name="role" class="form-select text-capitalize">
                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold" style="color:var(--text-secondary); font-size:13px;">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1" {{ $user->status ? 'selected' : '' }}>Hoạt động</option>
                    <option value="0" {{ !$user->status ? 'selected' : '' }}>Khóa tài khoản</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold" style="color:var(--text-secondary); font-size:13px;">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" value="{{ $user->phone }}">
            </div>
            <div class="col-12">
                <label class="form-label fw-bold" style="color:var(--text-secondary); font-size:13px;">Địa chỉ</label>
                <textarea name="address" class="form-control" rows="2">{{ $user->address }}</textarea>
            </div>
            <div class="col-12 mt-4 pt-3 border-top d-flex gap-2">
                <button type="submit" class="btn btn-info text-white px-4 py-2 fw-bold">
                    <i data-lucide="save" size="18" class="me-2 text-white"></i> Cập nhật ngay
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
