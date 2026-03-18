@extends('layouts.admin')

@section('content')
<div class="mb-4 d-flex align-items-center justify-content-between">
    <div>
        <a href="{{ route('admin.courses.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center gap-1 mb-2">
            <i data-lucide="arrow-left" size="14"></i> Quay lại
        </a>
        <h1 class="page-title mb-0">{{ isset($course) ? 'Chỉnh sửa khóa học' : 'Thêm khóa học mới' }}</h1>
    </div>
    @if(isset($course))
    <a href="{{ route('admin.lessons.index', ['course_id' => $course->id]) }}" class="btn btn-outline-primary d-flex align-items-center gap-2">
        <i data-lucide="list" size="18"></i> Xem danh sách bài học ({{ $course->lessons->count() }})
    </a>
    @endif
</div>

<form action="{{ isset($course) ? route('admin.courses.update', $course->id) : route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf @if(isset($course)) @method('PUT') @endif

    <div class="row g-4">
        <!-- Cột Nội dung chính -->
        <div class="col-lg-8">
            <!-- Thông tin cơ bản -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Thông tin khóa học</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tiêu đề khóa học <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
                            value="{{ $course->title ?? old('title') }}"
                            placeholder="Ví dụ: Lập trình Python cho người mới bắt đầu" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mô tả ngắn</label>
                        <textarea name="description" class="form-control" rows="4"
                            placeholder="Giới thiệu nội dung, mục tiêu của khóa học...">{{ $course->description ?? old('description') }}</textarea>
                    </div>
                </div>
            </div>

            <!-- SEO / Thumbnail -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Hình ảnh Thumbnail</h5>
                    <p class="text-muted small mb-4">Upload từ máy tính hoặc dán URL ảnh trực tiếp.</p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload ảnh từ máy tính</label>
                        <input type="file" name="thumbnail_file" class="form-control" accept="image/*" id="thumbnail-upload">
                    </div>

                    <div class="text-center text-muted fw-bold small my-3">── HOẶC ──</div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">URL ảnh trực tuyến</label>
                        <input type="text" name="thumbnail" id="thumbnail-url" class="form-control"
                            value="{{ $course->thumbnail ?? old('thumbnail') }}"
                            placeholder="https://example.com/image.jpg">
                    </div>

                    <!-- Preview -->
                    <div id="thumbnail-preview-wrap" class="{{ (isset($course) && $course->thumbnail) ? '' : 'd-none' }}">
                        <label class="form-label text-muted small">Xem trước:</label>
                        <div class="rounded-3 overflow-hidden border shadow-sm" style="max-width: 300px; height: 160px;">
                            <img id="thumbnail-preview" src="{{ isset($course) ? $course->thumbnail : '' }}"
                                class="w-100 h-100" style="object-fit: cover;" alt="preview">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột Thiết lập -->
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Cài đặt</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Cấp độ</label>
                        <select name="level" class="form-select">
                            <option value="Cơ bản" {{ (isset($course) && $course->level == 'Cơ bản') ? 'selected' : '' }}>🟢 Cơ bản</option>
                            <option value="Trung bình" {{ (isset($course) && $course->level == 'Trung bình') ? 'selected' : '' }}>🟡 Trung bình</option>
                            <option value="Nâng cao" {{ (isset($course) && $course->level == 'Nâng cao') ? 'selected' : '' }}>🔴 Nâng cao</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Thời lượng ước tính</label>
                        <input type="text" name="duration" class="form-control"
                            value="{{ $course->duration ?? old('duration') }}"
                            placeholder="Ví dụ: 5 giờ 20 phút">
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Thứ tự hiển thị (nhỏ = trước)</label>
                        <input type="number" name="order" class="form-control"
                            value="{{ $course->order ?? old('order', 0) }}" min="0">
                    </div>

                    <div class="form-check form-switch d-flex justify-content-between align-items-center px-0">
                        <label class="form-check-label fw-semibold" for="status">Công khai khóa học</label>
                        <input class="form-check-input" type="checkbox" name="status" id="status"
                            style="width:3em; height:1.5em;"
                            {{ (isset($course) && $course->status) || !isset($course) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 text-center">
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 py-3 rounded-3">
                        <i data-lucide="{{ isset($course) ? 'save' : 'plus-circle' }}" size="20"></i>
                        {{ isset($course) ? 'Cập nhật khóa học' : 'Tạo khóa học' }}
                    </button>
                    @if(isset($course))
                    <a href="{{ route('admin.lessons.create') }}?course_id={{ $course->id }}" class="btn btn-outline-primary w-100 mt-3 rounded-3 d-flex align-items-center justify-content-center gap-2">
                        <i data-lucide="plus" size="18"></i> Thêm bài học mới
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // Live preview khi nhập URL
    const urlInput = document.getElementById('thumbnail-url');
    const fileInput = document.getElementById('thumbnail-upload');
    const preview = document.getElementById('thumbnail-preview');
    const previewWrap = document.getElementById('thumbnail-preview-wrap');

    if (urlInput) {
        urlInput.addEventListener('input', function() {
            if (this.value.startsWith('http')) {
                preview.src = this.value;
                previewWrap.classList.remove('d-none');
            }
        });
    }
    if (fileInput) {
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = e => { preview.src = e.target.result; previewWrap.classList.remove('d-none'); };
                reader.readAsDataURL(file);
            }
        });
    }
</script>
@endsection
