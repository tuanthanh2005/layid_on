@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.lessons.index', request('course_id') ? ['course_id' => request('course_id')] : []) }}"
        class="btn btn-sm btn-light border d-inline-flex align-items-center gap-1 mb-2">
        <i data-lucide="arrow-left" size="14"></i> Quay lại
    </a>
    <h1 class="page-title mb-0">{{ isset($lesson) ? 'Chỉnh sửa bài học' : 'Thêm bài học mới' }}</h1>
</div>

<form action="{{ isset($lesson) ? route('admin.lessons.update', $lesson->id) : route('admin.lessons.store') }}" method="POST">
    @csrf @if(isset($lesson)) @method('PUT') @endif

    <div class="row g-4">
        <!-- Cột nội dung chính -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Thông tin bài học</h5>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thuộc khóa học <span class="text-danger">*</span></label>
                            <select name="course_id" class="form-select" required>
                                <option value="">— Chọn khóa học —</option>
                                @foreach($courses as $course)
                                    <option value="{{ $course->id }}"
                                        {{ (isset($lesson) && $lesson->course_id == $course->id)
                                            || request('course_id') == $course->id
                                            ? 'selected' : '' }}>
                                        {{ $course->title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thứ tự bài học</label>
                            <input type="number" name="order" class="form-control"
                                value="{{ $lesson->order ?? old('order', 0) }}" min="0">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tiêu đề bài học <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
                            value="{{ $lesson->title ?? old('title') }}"
                            placeholder="Ví dụ: Bài 1 — Giới thiệu về Python" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>
            </div>

            <!-- Video Section -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Nguồn Video</h5>
                    <p class="text-muted small mb-4">Hỗ trợ YouTube, Google Drive và bất kỳ URL video nào.</p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Loại video</label>
                        <div class="d-flex gap-3 flex-wrap" id="video-type-selector">
                            @php
                                $videoTypes = [
                                    'youtube' => ['icon' => 'fa-brands fa-youtube', 'color' => 'danger', 'label' => 'YouTube'],
                                    'driver'  => ['icon' => 'fa-brands fa-google-drive', 'color' => 'primary', 'label' => 'Google Drive'],
                                    'url'     => ['icon' => 'fa-solid fa-link', 'color' => 'secondary', 'label' => 'Liên kết khác'],
                                ];
                            @endphp
                            @foreach($videoTypes as $key => $vt)
                            <label class="video-type-card d-flex align-items-center gap-2 px-4 py-2 rounded-3 border cursor-pointer"
                                style="cursor:pointer; transition: all .2s;">
                                <input type="radio" name="video_type" value="{{ $key }}" class="d-none"
                                    {{ (isset($lesson) && $lesson->video_type == $key) || (!isset($lesson) && $key == 'youtube') ? 'checked' : '' }}>
                                <i class="{{ $vt['icon'] }} text-{{ $vt['color'] }}"></i>
                                <span class="fw-semibold">{{ $vt['label'] }}</span>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">URL Video</label>
                        <input type="text" name="video_url" class="form-control"
                            value="{{ $lesson->video_url ?? old('video_url') }}"
                            placeholder="Dán link YouTube, Google Drive hoặc URL video...">
                        <div class="form-text text-muted">YouTube: https://youtu.be/... | Drive: Bất kỳ link chia sẻ nào</div>
                    </div>
                </div>
            </div>

            <!-- Ghi chú / Tài liệu -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Ghi chú & Tài liệu</h5>
                    <p class="text-muted small mb-3">Mô tả nội dung bài học, tài liệu tham khảo, code mẫu...</p>
                    <textarea name="content" class="form-control" rows="8"
                        placeholder="Viết ghi chú bài học, ví dụ code, tài liệu đính kèm...">{{ $lesson->content ?? old('content') }}</textarea>
                </div>
            </div>
        </div>

        <!-- Cột phụ -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Cài đặt</h5>

                    <div class="form-check form-switch d-flex justify-content-between align-items-center px-0 mb-0">
                        <label class="form-check-label fw-semibold" for="is_free">
                            Bài học miễn phí
                            <div class="small text-muted fw-normal">Tắt = Nội dung Premium</div>
                        </label>
                        <input class="form-check-input" type="checkbox" name="is_free" id="is_free"
                            style="width:3em; height:1.5em;"
                            {{ (isset($lesson) && $lesson->is_free) || !isset($lesson) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 py-3 rounded-3">
                        <i data-lucide="{{ isset($lesson) ? 'save' : 'plus-circle' }}" size="20"></i>
                        {{ isset($lesson) ? 'Cập nhật bài học' : 'Tạo bài học' }}
                    </button>
                    <a href="{{ route('admin.lessons.index') }}" class="btn btn-light w-100 mt-2">Hủy bỏ</a>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
    .video-type-card:has(input:checked) {
        border-color: #3b82f6 !important;
        background: #eff6ff;
    }
    .video-type-card:hover { background: #f8fafc; }
</style>
@endsection
