@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Thêm bài viết mới</h1>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i data-lucide="arrow-left" size="18"></i> Quay lại
    </a>
</div>

<form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <!-- Cột Nội dung chính -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Nội dung bài viết</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Nhập tiêu đề bài viết..." required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold"><i data-lucide="file-text" size="18" class="me-1"></i> Nội dung chi tiết <span class="text-danger">*</span></label>
                        <textarea name="content" id="content-editor" class="form-control" rows="18" placeholder="Nhập nội dung chi tiết bài viết...">{{ old('content') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">Tối ưu SEO</h5>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Thẻ Tiêu đề (Meta Title)</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Mặc định lấy tiêu đề bài viết nếu để trống">
                    </div>

                    <div class="mb-0">
                        <label class="form-label text-muted">Thẻ Mô tả (Meta Description)</label>
                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Mô tả ngắn gọn nội dung bài viết để hiển thị trên Google">{{ old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột Thiết lập -->
        <div class="col-lg-4">
            <!-- Vị trí hiển thị trên trang chủ -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white py-3">
                    <h5 class="card-title fw-bold mb-0 text-primary">Vị trí Trang Chủ</h5>
                    <small class="text-muted">Bật toggle để chọn nơi hiển thị bài viết ngoài Homepage</small>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="form-check form-switch form-switch-lg mb-3 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium" for="toggle-featured">
                            <span class="badge bg-primary me-2 px-2 py-1">Feature</span>
                            Bài viết TO chính giữa
                        </label>
                        <input class="form-check-input ms-3 rounded-pill" type="checkbox" name="is_featured" id="toggle-featured" value="1" {{ old('is_featured') ? 'checked' : '' }}>
                    </div>
                    
                    <div class="form-check form-switch form-switch-lg mb-3 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium" for="toggle-grid">
                            <span class="badge bg-info text-white me-2 px-2 py-1">Grid</span>
                            4 ô nổi bật vuông
                        </label>
                        <input class="form-check-input ms-3 rounded-pill" type="checkbox" name="is_grid" id="toggle-grid" value="1" {{ old('is_grid') ? 'checked' : '' }}>
                    </div>

                    <div class="form-check form-switch form-switch-lg mb-3 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium" for="toggle-recommended">
                            <span class="badge bg-success me-2 px-2 py-1">Sidebar</span>
                            Được đề cử
                        </label>
                        <input class="form-check-input ms-3 rounded-pill" type="checkbox" name="is_recommended" id="toggle-recommended" value="1" {{ old('is_recommended') ? 'checked' : '' }}>
                    </div>

                    <div class="form-check form-switch form-switch-lg mb-3 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium" for="toggle-trending">
                            <span class="badge bg-danger text-white me-2 px-2 py-1">Hot</span>
                            Khu vực Trending (Thịnh hành)
                        </label>
                        <input class="form-check-input ms-3 rounded-pill" type="checkbox" name="is_trending" id="toggle-trending" value="1" {{ old('is_trending') ? 'checked' : '' }}>
                    </div>

                    <div class="form-check form-switch form-switch-lg mb-3 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium" for="toggle-interested">
                            <span class="badge bg-warning text-dark me-2 px-2 py-1">Sidebar 2</span>
                            Có thể bạn quan tâm
                        </label>
                        <input class="form-check-input ms-3 rounded-pill" type="checkbox" name="is_interested" id="toggle-interested" value="1" {{ old('is_interested') ? 'checked' : '' }}>
                    </div>
                    
                    <div class="form-check form-switch form-switch-lg mb-0 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium" for="toggle-video">
                            <span class="badge bg-danger text-white me-2 px-2 py-1">Media</span>
                            Khu vực Video
                        </label>
                        <input class="form-check-input ms-3 rounded-pill" type="checkbox" name="is_video" id="toggle-video" value="1" {{ old('is_video') ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            <!-- Giao diện Thumbnail -->
            <div class="card border-0 shadow-sm mb-4 border-top border-3 border-info">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">Hình ảnh hiển thị (Thumbnail)</h5>
                    <p class="text-muted small mb-3">Ưu tiên thiết kế Icon/Gradient như trang chủ, hoặc truyền URL hình ảnh trực tiếp.</p>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">FontAwesome/Lucide Icon</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon') }}" placeholder="VD: fa-solid fa-code hoặc file-text">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Tông Màu Nền (Gradient / Solid)</label>
                        <input type="text" name="color" class="form-control" value="{{ old('color', 'linear-gradient(135deg, #38bdf8, #0ea5e9)') }}" placeholder="VD: #1d4ed8">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Tải Ảnh Lên (Khuyên dùng)</label>
                        <input type="file" name="thumbnail_file" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Hoặc Link Ảnh (URL) - Tuỳ chọn</label>
                        <input type="text" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" placeholder="https://domain.com/image.jpg">
                    </div>
                </div>
            </div>

            <!-- Xuất bản -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="form-check form-switch form-switch-lg mb-4 d-inline-flex justify-content-center align-items-center">
                        <label class="form-check-label me-3 fw-bold text-dark" for="post-status">Công khai Bài viết</label>
                        <input class="form-check-input rounded-pill shadow-sm" type="checkbox" name="status" id="post-status" value="1" checked style="width: 50px; height: 26px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold d-flex justify-content-center align-items-center gap-2">
                        <i data-lucide="send" size="20"></i> Tạo mới và Đăng
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
/* CSS Tweak for Switch Toggles to look better */
.form-switch-lg .form-check-input {
    width: 2.5em;
    height: 1.25em;
    cursor: pointer;
}
.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}
</style>
.cursor-pointer, .pointer-label {
    cursor: pointer;
}
</style>

<!-- jQuery & Summernote (100% Free Full Features) -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content-editor').summernote({
            placeholder: 'Nhập nội dung bài viết...',
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fontname', ['fontname']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection
