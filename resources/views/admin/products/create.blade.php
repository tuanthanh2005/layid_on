@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Thêm sản phẩm mới (Tài khoản AI)</h1>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">Quay lại</a>
</div>

<div class="row">
    <div class="col-lg-12">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card shadow-sm border-0 mb-4">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-bold">Tên sản phẩm</label>
                        <input type="text" name="name" class="form-control" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}" required>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label class="form-label fw-bold font-weight-bold">Giá bán (VNĐ)</label>
                            <input type="number" name="price" class="form-control" placeholder="Ví dụ: 99000" value="{{ old('price') }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold text-muted font-weight-bold">Giá cũ (nếu có)</label>
                            <input type="number" name="discount_price" class="form-control" placeholder="Ví dụ: 199000" value="{{ old('discount_price') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Mô tả ngắn</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Ví dụ: Tài khoản ChatGPT Plus dùng chung siêu rẻ">{{ old('description') }}</textarea>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Badge Text (Nhãn)</label>
                            <input type="text" name="badge_text" class="form-control" placeholder="Hot / Sale / Mới" value="{{ old('badge_text') }}">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Thứ tự hiển thị (STT)</label>
                            <input type="number" name="order_index" class="form-control" value="0">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <div class="form-check form-switch mb-2 ms-4">
                                <input class="form-check-input" type="checkbox" name="status" id="status" value="1" checked>
                                <label class="form-check-label fw-bold" for="status">Đang bán</label>
                            </div>
                        </div>
                    </div>

                     <div class="mb-4">
                        <label class="form-label fw-bold">Hình ảnh sản phẩm (Khuyên dùng 1:1 hoặc 4:3)</label>
                        <input type="file" name="image_file" class="form-control">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary px-5 py-2 font-weight-bold shadow">
                            <i class="fa-solid fa-plus me-2"></i> Lưu sản phẩm
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
