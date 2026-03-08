@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.users.index') }}" class="btn btn-link link-secondary p-0 mb-2 text-decoration-none">
        <i data-lucide="arrow-left" size="14"></i> Quay lại danh sách
    </a>
    <h1 class="page-title">Thêm thành viên mới</h1>
</div>

<div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf
        <div class="row g-4">
            <div class="col-md-6">
                <label class="form-label fw-bold">Họ và tên</label>
                <input type="text" name="name" class="form-control" placeholder="Nhập họ tên đầy đủ..." required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Mật khẩu ban đầu</label>
                <input type="password" name="password" class="form-control" placeholder="Tối thiểu 6 ký tự..." required>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Vai trò</label>
                <select name="role" class="form-select text-capitalize">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1">Hoạt động</option>
                    <option value="0">Khóa tài khoản</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Số điện thoại</label>
                <input type="text" name="phone" class="form-control" placeholder="09xxx...">
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Địa chỉ</label>
                <textarea name="address" class="form-control" rows="1" placeholder="Địa chỉ hiện tại..."></textarea>
            </div>
            <div class="col-12 mt-4 pt-3 border-top">
                <button type="submit" class="btn btn-primary px-4 py-2 fw-bold">
                    <i data-lucide="save" size="18" class="me-2 text-white"></i> Lưu thông tin
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
