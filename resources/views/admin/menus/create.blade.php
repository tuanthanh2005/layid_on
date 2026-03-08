@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.menus.index') }}" class="btn btn-link link-secondary p-0 mb-2 text-decoration-none">
        <i data-lucide="arrow-left" size="14"></i> Quay lại danh sách
    </a>
    <h1 class="page-title">Thêm Menu mới</h1>
</div>

<div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.menus.store') }}" method="POST">
        @csrf
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Tên Menu</label>
                <input type="text" name="name" class="form-control" placeholder="Ví dụ: Trang chủ, Sản phẩm..." required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Đường dẫn (URL)</label>
                <input type="text" name="url" class="form-control" placeholder="/" required>
                <div class="form-text">Dùng <code>#</code> nếu là menu cha có dropdown.</div>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Menu cha (Nếu có)</label>
                <select name="parent_id" class="form-select">
                    <option value="">-- Là menu chính --</option>
                    @foreach($parentMenus as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Icon (FontAwesome / Lucide)</label>
                <input type="text" name="icon" class="form-control" placeholder="fa-solid fa-home">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Thứ tự</label>
                <input type="number" name="order" class="form-control" value="0">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1">Hiển thị</option>
                    <option value="0">Ẩn</option>
                </select>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-primary px-4">Lưu Menu</button>
            </div>
        </div>
    </form>
</div>
@endsection
