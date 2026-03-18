@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.social-services.index') }}" class="text-decoration-none small d-flex align-items-center gap-1 mb-2">
        <i data-lucide="chevron-left" size="14"></i> Quay lại danh sách
    </a>
    <h2 class="page-title">{{ isset($socialService) ? 'Chỉnh sửa dịch vụ' : 'Thêm dịch vụ mới' }}</h2>
</div>

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <form action="{{ isset($socialService) ? route('admin.social-services.update', $socialService->id) : route('admin.social-services.store') }}" method="POST">
                    @csrf
                    @if(isset($socialService)) @method('PUT') @endif

                    <div class="mb-3">
                        <label class="form-label fw-bold">Tên dịch vụ</label>
                        <input type="text" name="name" class="form-control" value="{{ $socialService->name ?? old('name') }}" placeholder="Buff TikTok, Buff Facebook..." required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">FontAwesome Icon Class</label>
                        <input type="text" name="icon" class="form-control" value="{{ $socialService->icon ?? old('icon') }}" placeholder="fa-brands fa-tiktok" required>
                        <div class="small text-muted mt-1">Ví dụ: <code>fa-brands fa-tiktok</code></div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Thứ tự hiển thị</label>
                        <input type="number" name="order" class="form-control" value="{{ $socialService->order ?? old('order', 0) }}">
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="status" id="status" {{ (isset($socialService) && $socialService->status) || !isset($socialService) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="status">Kích hoạt dịch vụ</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="show_on_home" id="show_on_home" {{ (isset($socialService) && $socialService->show_on_home) ? 'checked' : '' }}>
                            <label class="form-check-label fw-bold" for="show_on_home">Hiện ở phần "Có thể bạn quan tâm" (Trang chủ)</label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold">Lưu thông tin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
