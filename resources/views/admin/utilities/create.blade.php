@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Thêm tiện ích mới</h2>
    <a href="{{ route('admin.utilities.index') }}" class="btn btn-light d-flex align-items-center gap-2 border">
        <i data-lucide="arrow-left" size="18"></i> Quay lại
    </a>
</div>

<form action="{{ route('admin.utilities.store') }}" method="POST">
    @csrf
    
    <div class="row">
        <!-- Cột Trái: Nội dung -->
        <div class="col-lg-8 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="info" class="me-2 text-primary" size="20"></i> Thông tin cơ bản</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tên tiện ích <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Ví dụ: Viết code PHP..." required>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Mô tả phụ (Dòng thứ 2)</label>
                        <input type="text" name="description" class="form-control" value="{{ old('description') }}" placeholder="Ví dụ: Công cụ mạnh mẽ hoặc ngày giờ hiện tại">
                    </div>

                    <div class="mb-0">
                        <label class="form-label fw-semibold text-primary"><i data-lucide="link" size="18" class="me-1"></i> Liên kết chuyển hướng (URL) <span class="text-danger">*</span></label>
                        <input type="url" name="url" class="form-control" value="{{ old('url') }}" placeholder="Ví dụ: /tools/php-editor hoặc https://..." required>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột Phải: Cài đặt Giao diện -->
        <div class="col-lg-4 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center"><i data-lucide="palette" class="me-2 text-primary" size="20"></i> Giao diện hiển thị</h5>
                    
                    <div class="mb-4">
                        <label class="form-label text-muted">Mã Icon (FontAwesome)</label>
                        <input type="text" name="icon" class="form-control text-monospace" value="{{ old('icon', 'fa-brands fa-php') }}" placeholder="fa-brands ...">
                        <small class="text-muted d-block mt-1">Sử dụng FontAwesome 6 style.</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label text-muted">Màu Nền (Mã màu HEX hoặc Gradient CSS)</label>
                        <input type="text" name="color" class="form-control" value="{{ old('color', 'linear-gradient(135deg, #4f46e5, #4338ca)') }}" placeholder="linear-gradient(...)">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Thứ tự hiển thị số mấy?</label>
                        <input type="number" name="order_index" class="form-control" value="{{ old('order_index', 0) }}" placeholder="0, 1, 2...">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input cursor-pointer" type="checkbox" role="switch" id="status" name="status" checked>
                        <label class="form-check-label pointer-label fw-medium ms-2" for="status">Đang mở hoạt động (Hiển thị trang chủ)</label>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold d-flex justify-content-center align-items-center gap-2">
                        <i data-lucide="save" size="18"></i> Lưu Tiện ích ngay
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.cursor-pointer, .pointer-label {
    cursor: pointer;
}
.text-monospace {
    font-family: monospace;
}
</style>
@endsection
