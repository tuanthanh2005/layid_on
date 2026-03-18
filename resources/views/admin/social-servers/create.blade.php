@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.social-servers.index') }}" class="text-decoration-none small d-flex align-items-center gap-1 mb-2">
        <i data-lucide="chevron-left" size="14"></i> Quay lại danh sách
    </a>
    <h2 class="page-title">{{ isset($socialServer) ? 'Chỉnh sửa Server' : 'Thêm Server mới' }}</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ isset($socialServer) ? route('admin.social-servers.update', $socialServer->id) : route('admin.social-servers.store') }}" method="POST">
                    @csrf
                    @if(isset($socialServer)) @method('PUT') @endif

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Thuộc dịch vụ</label>
                            <select name="social_service_id" class="form-select" required>
                                <option value="">Chọn dịch vụ...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ (isset($socialServer) && $socialServer->social_service_id == $service->id) ? 'selected' : '' }}>{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Tên Server</label>
                            <input type="text" name="name" class="form-control" value="{{ $socialServer->name ?? old('name') }}" placeholder="Server 1 - Giá rẻ..." required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Giá mỗi đơn vị (đ)</label>
                            <input type="number" name="price_per_unit" class="form-control" value="{{ $socialServer->price_per_unit ?? old('price_per_unit', 0) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Số lượng tối thiểu</label>
                            <input type="number" name="min_quantity" class="form-control" value="{{ $socialServer->min_quantity ?? old('min_quantity', 1) }}" required>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Số lượng tối đa</label>
                            <input type="number" name="max_quantity" class="form-control" value="{{ $socialServer->max_quantity ?? old('max_quantity', 1000000) }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Mô tả chi tiết</label>
                        <textarea name="description" class="form-control" rows="3" placeholder="Tốc độ đẩy, chính sách bảo hành, loại acc buff...">{{ $socialServer->description ?? old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" {{ (isset($socialServer) && $socialServer->status) || !isset($socialServer) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="status">Bật Server này</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Lưu thông tin Server</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
