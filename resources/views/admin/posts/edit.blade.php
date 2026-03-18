@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Chỉnh sửa bài viết</h1>
    <div class="d-flex gap-2">
        <a href="{{ route('admin.posts.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
            <i data-lucide="arrow-left" size="18"></i> Quay lại
        </a>
        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger d-flex justify-content-center align-items-center gap-2" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                <i data-lucide="trash-2" size="18"></i> Xóa
            </button>
        </form>
    </div>
</div>

<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <!-- Cột Nội dung chính -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4 border-top border-3 border-primary">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Nội dung bài viết</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tiêu đề bài viết</label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}" placeholder="Nhập tiêu đề bài viết..." required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        <div class="form-text text-muted mt-2"><i class="fa-solid fa-link"></i> <code class="bg-light p-1 rounded">{{ config('app.url') }}/{{ $post->slug }}</code></div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold"><i data-lucide="file-text" size="18" class="me-1"></i> Nội dung chi tiết <span class="text-danger">*</span></label>
                        <textarea name="content" id="content-editor" class="form-control" rows="18" placeholder="Nhập nội dung chi tiết bài viết...">{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3 d-flex align-items-center gap-2"><i data-lucide="search" size="20" class="text-secondary"></i> Tối ưu SEO</h5>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Thẻ Tiêu đề (Meta Title)</label>
                        <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title', $post->meta_title) }}" placeholder="Mặc định lấy tiêu đề bài viết nếu để trống">
                    </div>

                    <div class="mb-0">
                        <label class="form-label text-muted">Thẻ Mô tả (Meta Description)</label>
                        <textarea name="meta_description" class="form-control" rows="3" placeholder="Mô tả ngắn gọn nội dung bài viết để hiển thị trên Google">{{ old('meta_description', $post->meta_description) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột Thiết lập -->
        <div class="col-lg-4">
            <!-- Vị trí hiển thị trên trang chủ -->
            <div class="card border-0 shadow-sm mb-4 border-top border-3 border-warning">
                <div class="card-header bg-white py-3 border-bottom-0 pb-0">
                    <h5 class="card-title fw-bold mb-0 text-dark">Vị trí Trang Chủ</h5>
                    <small class="text-muted d-block mt-1">Bật toggle để chọn nơi hiển thị bài viết ngoài Homepage</small>
                </div>
                <div class="card-body px-4 py-4">
                    <div class="form-check form-switch form-switch-lg mb-3 pb-3 border-bottom d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-featured">
                            <span class="badge bg-primary text-white me-2" style="width: 50px;">Top</span> Màn hình chính (Feature)
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_featured" id="toggle-featured" value="1" {{ old('is_featured', $post->is_featured) ? 'checked' : '' }}>
                    </div>
                    
                    <div class="form-check form-switch form-switch-lg mb-3 pb-3 border-bottom d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-grid">
                            <span class="badge bg-info text-dark me-2" style="width: 50px;">Grid 4</span> Ô nổi bật vuông
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_grid" id="toggle-grid" value="1" {{ old('is_grid', $post->is_grid) ? 'checked' : '' }}>
                    </div>

                    <div class="form-check form-switch form-switch-lg mb-3 pb-3 border-bottom d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-trending">
                            <span class="badge bg-danger text-white me-2" style="width: 50px;">Hot</span> Trending (Thịnh hành)
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_trending" id="toggle-trending" value="1" {{ old('is_trending', $post->is_trending) ? 'checked' : '' }}>
                    </div>

                    <div class="form-check form-switch form-switch-lg mb-3 pb-3 border-bottom d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-recommended">
                            <span class="badge bg-success text-white me-2" style="width: 50px;">Phải 1</span> Được đề cử (Sidebar)
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_recommended" id="toggle-recommended" value="1" {{ old('is_recommended', $post->is_recommended) ? 'checked' : '' }}>
                    </div>

                    <div class="form-check form-switch form-switch-lg mb-3 pb-3 border-bottom d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-interested">
                            <span class="badge bg-warning text-dark me-2" style="width: 50px;">Phải 2</span> Có thể bạn quan tâm
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_interested" id="toggle-interested" value="1" {{ old('is_interested', $post->is_interested) ? 'checked' : '' }}>
                    </div>
                    
                    <div class="form-check form-switch form-switch-lg mb-0 d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-video">
                            <span class="badge bg-danger text-white me-2" style="width: 50px;">Bot</span> Khu vực Video (Cuối)
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_video" id="toggle-video" value="1" {{ old('is_video', $post->is_video) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>

            <!-- Blog Sidebar -->
            <div class="card border-0 shadow-sm mb-4 border-top border-3 border-primary">
                <div class="card-header bg-white py-3 d-flex align-items-center gap-2">
                    <i data-lucide="book-open" size="18" class="text-primary"></i>
                    <div>
                        <h5 class="fw-bold mb-0 text-primary">Trang Blog & Mẹo AI</h5>
                        <small class="text-muted">Vị trí hiển thị riêng trên trang Blog</small>
                    </div>
                </div>
                <div class="card-body px-4 py-3">
                    <div class="form-check form-switch form-switch-lg d-flex justify-content-between px-0 align-items-center">
                        <label class="form-check-label text-dark fw-medium pointer-label" for="toggle-blog-sidebar">
                            <span class="badge bg-primary me-2 px-2 py-1">Sidebar Blog</span>
                            Hiện trong "Có thể bạn quan tâm"
                        </label>
                        <input class="form-check-input ms-3 rounded-pill cursor-pointer" type="checkbox" name="is_blog_sidebar" id="toggle-blog-sidebar" value="1" {{ old('is_blog_sidebar', $post->is_blog_sidebar) ? 'checked' : '' }}>
                    </div>
                </div>
            </div>
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3 d-flex align-items-center gap-2"><i data-lucide="image" size="20" class="text-secondary"></i> Ảnh Đại Diện (Thumbnail)</h5>
                    <p class="text-muted small mb-3">Sử dụng Icon + Màu nền (giống bản thiết kế) hoặc URL Ảnh.</p>
                    
                    <!-- Preview -->
                    <div class="mb-4 text-center">
                        <div class="d-inline-flex flex-column align-items-center w-100">
                            <span class="d-block text-muted small mb-2 text-start w-100 fw-bold">Xem trước:</span>
                            @if($post->thumbnail)
                                <img src="{{ $post->thumbnail }}" alt="Thumbnail preview" style="width: 100%; height: 160px; object-fit: cover; border-radius: 8px; border: 1px solid #e2e8f0; display: block;">
                            @elseif($post->icon && $post->color)
                                <div style="width: 100%; height: 160px; background: {{ $post->color }}; border-radius: 8px; display:flex; align-items:center; justify-content:center; color:white; box-shadow: inset 0 0 0 1px rgba(0,0,0,0.05);">
                                    <i class="{{ $post->icon }} fa-4x opacity-75"></i>
                                </div>
                            @else
                                <div style="width: 100%; height: 160px; background: #f8fafc; border-radius: 8px; border: 1px dashed #cbd5e1; display:flex; flex-direction: column; align-items:center; justify-content:center; color:#94a3b8;">
                                    <i data-lucide="image-off" size="32" class="mb-2"></i>
                                    <span class="small">Chưa có Thumbnail</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">FontAwesome/Lucide Icon</label>
                        <input type="text" name="icon" class="form-control" value="{{ old('icon', $post->icon) }}" placeholder="VD: fa-solid fa-code hoặc file-text">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label text-muted">Tông Màu Nền (Gradient / Solid)</label>
                        <input type="text" name="color" class="form-control" value="{{ old('color', $post->color) }}" placeholder="VD: #1d4ed8 hoặc linear-gradient(...)">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Tải Ảnh Lên (Khuyên dùng)</label>
                        <input type="file" name="thumbnail_file" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Hoặc Link Ảnh (URL) - Tuỳ chọn</label>
                        <input type="text" name="thumbnail" class="form-control" value="{{ old('thumbnail', $post->thumbnail) }}" placeholder="https://domain.com/image.jpg">
                    </div>
                </div>
            </div>

            <!-- Xuất bản -->
            <div class="card border-0 shadow-sm bg-light">
                <div class="card-body p-4 text-center">
                    <div class="form-check form-switch form-switch-lg mb-4 d-inline-flex justify-content-center align-items-center">
                        <label class="form-check-label me-3 fw-bold text-dark pointer-label" for="post-status">Công khai Bài viết</label>
                        <input class="form-check-input rounded-pill shadow-sm cursor-pointer" type="checkbox" name="status" id="post-status" value="1" {{ old('status', $post->status) ? 'checked' : '' }} style="width: 50px; height: 26px;">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold d-flex justify-content-center align-items-center gap-2 shadow">
                        <i data-lucide="save" size="20"></i> Cập nhật Bài viết
                    </button>
                    <p class="text-muted small mt-3 mb-0"><i data-lucide="clock" size="12" class="me-1"></i> Sửa lần cuối: {{ $post->updated_at->diffForHumans() }}</p>
                </div>
            </div>
        </div>
    </div>
</form>

<style>
.form-switch-lg .form-check-input {
    width: 2.5em;
    height: 1.25em;
}
.form-check-input:checked {
    background-color: var(--bs-primary);
    border-color: var(--bs-primary);
}
.cursor-pointer, .pointer-label {
    cursor: pointer;
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
