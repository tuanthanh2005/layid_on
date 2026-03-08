@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.menus.index') }}" class="btn btn-link link-secondary p-0 mb-2 text-decoration-none">
        <i data-lucide="arrow-left" size="14"></i> Quay lại danh sách
    </a>
    <h1 class="page-title">Sửa Menu: {{ $menu->name }}</h1>
</div>

<div class="card border-0 shadow-sm p-4">
    <form action="{{ route('admin.menus.update', $menu) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label fw-bold">Tên Menu</label>
                <input type="text" name="name" class="form-control" value="{{ $menu->name }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label fw-bold">Đường dẫn (URL)</label>
                <input type="text" name="url" class="form-control" value="{{ $menu->url }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Menu cha</label>
                <select name="parent_id" class="form-select">
                    <option value="">-- Là menu chính --</option>
                    @foreach($parentMenus as $parent)
                        <option value="{{ $parent->id }}" {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label fw-bold">Icon</label>
                <input type="text" name="icon" class="form-control" value="{{ $menu->icon }}">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Thứ tự</label>
                <input type="number" name="order" class="form-control" value="{{ $menu->order }}">
            </div>
            <div class="col-md-2">
                <label class="form-label fw-bold">Trạng thái</label>
                <select name="status" class="form-select">
                    <option value="1" {{ $menu->status ? 'selected' : '' }}>Hiển thị</option>
                    <option value="0" {{ !$menu->status ? 'selected' : '' }}>Ẩn</option>
                </select>
            </div>
            <div class="col-12 mt-4">
                <button type="submit" class="btn btn-info text-white px-4">Cập nhật Menu</button>
            </div>
        </div>
    </form>
</div>
@endsection
