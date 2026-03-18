@extends('layouts.admin')

@section('content')
<div class="mb-4">
    <a href="{{ route('admin.movies.index') }}" class="btn btn-sm btn-light border d-inline-flex align-items-center gap-1 mb-2">
        <i data-lucide="arrow-left" size="14"></i> Quay lại danh sách
    </a>
    <h1 class="page-title mb-0">{{ $movie->exists ? 'Chỉnh sửa Review Phim' : 'Thêm Review Phim Mới' }}</h1>
</div>

<form action="{{ $movie->exists ? route('admin.movies.update', $movie) : route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
    @csrf @if($movie->exists) @method('PUT') @endif

    <div class="row g-4">
        <!-- Nội dung chính -->
        <div class="col-lg-8">
            <!-- Thông tin cơ bản -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Thông tin bộ phim</h5>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tiêu đề bài review <span class="text-danger">*</span></label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror"
                            value="{{ $movie->title ?? old('title') }}"
                            placeholder="VD: Avatar: Dòng Chảy Của Nước - Siêu phẩm hình ảnh không thể bỏ lỡ" required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên gốc (Tiếng Anh)</label>
                        <input type="text" name="original_title" class="form-control"
                            value="{{ $movie->original_title ?? old('original_title') }}"
                            placeholder="VD: Avatar: The Way of Water">
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Thể loại</label>
                            <input type="text" name="genre" class="form-control"
                                value="{{ $movie->genre ?? old('genre') }}"
                                placeholder="Hành động, Sci-Fi, Hài...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Quốc gia</label>
                            <input type="text" name="country" class="form-control"
                                value="{{ $movie->country ?? old('country') }}"
                                placeholder="Mỹ, Việt Nam...">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Năm phát hành</label>
                            <input type="number" name="release_year" class="form-control"
                                value="{{ $movie->release_year ?? old('release_year') }}"
                                placeholder="{{ date('Y') }}" min="1900" max="{{ date('Y') + 5 }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Đạo diễn</label>
                            <input type="text" name="director" class="form-control"
                                value="{{ $movie->director ?? old('director') }}"
                                placeholder="James Cameron">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Thời lượng</label>
                            <input type="text" name="duration_text" class="form-control"
                                value="{{ $movie->duration_text ?? old('duration_text') }}"
                                placeholder="2h 30p">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tags (phân cách bằng dấu phẩy)</label>
                        <input type="text" name="tags" class="form-control"
                            value="{{ $movie->tags ?? old('tags') }}"
                            placeholder="ReviewPhim, Sci-Fi, JamesCameron">
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Link Trailer (YouTube)</label>
                        <input type="text" name="trailer_url" class="form-control"
                            value="{{ $movie->trailer_url ?? old('trailer_url') }}"
                            placeholder="https://youtu.be/...">
                    </div>
                </div>
            </div>

            <!-- Đánh giá -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Điểm đánh giá</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Điểm / 5</label>
                            <input type="number" name="rating" class="form-control" step="0.5" min="0" max="5"
                                value="{{ $movie->rating ?? old('rating', 4) }}">
                            <div class="form-text">0-5 sao, bước 0.5 (VD: 4.5)</div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nhãn đánh giá</label>
                            <select name="rating_label" class="form-select">
                                <option value="">— Chọn nhãn —</option>
                                @foreach(['Tuyệt đỉnh', 'Rất hay!', 'Hay!', 'Xem được', 'Bình thường', 'Không hay', 'Đừng xem'] as $label)
                                    <option value="{{ $label }}" {{ $movie->rating_label == $label ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Nội dung review -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Tóm tắt (Sapô)</h5>
                    <p class="text-muted small mb-3">Đoạn mở đầu ngắn gọn, thu hút người đọc.</p>
                    <textarea name="summary" class="form-control" rows="3"
                        placeholder="Tóm tắt bộ phim trong 2-3 câu ấn tượng...">{{ $movie->summary ?? old('summary') }}</textarea>
                </div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Nội dung Review chi tiết</h5>
                    <p class="text-muted small mb-3">Viết bài review đầy đủ, có thể nhúng ảnh và video.</p>
                    <textarea name="content" id="content-editor" class="form-control" rows="16"
                        placeholder="Nội dung chi tiết...">{{ $movie->content ?? old('content') }}</textarea>
                </div>
            </div>

            <!-- SEO -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 border-bottom pb-3">Tối ưu SEO</h5>
                    <div class="mb-3">
                        <label class="form-label text-muted">Meta Title</label>
                        <input type="text" name="meta_title" class="form-control"
                            value="{{ $movie->meta_title ?? old('meta_title') }}" placeholder="Mặc định dùng tiêu đề bài viết">
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted">Meta Description</label>
                        <textarea name="meta_description" class="form-control" rows="3"
                            placeholder="Mô tả ngắn để Google hiển thị trên kết quả tìm kiếm">{{ $movie->meta_description ?? old('meta_description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột phụ -->
        <div class="col-lg-4">
            <!-- Poster/Thumbnail -->
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-1">Poster / Thumbnail</h5>
                    <p class="text-muted small mb-3">Tải ảnh poster phim lên hoặc dán URL.</p>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">Upload ảnh poster</label>
                        <input type="file" name="thumbnail_file" class="form-control" accept="image/*" id="thumb-file">
                    </div>

                    <div class="text-center text-muted small my-2">── HOẶC ──</div>

                    <div class="mb-3">
                        <label class="form-label fw-semibold">URL ảnh</label>
                        <input type="text" name="thumbnail" id="thumb-url" class="form-control"
                            value="{{ $movie->thumbnail ?? old('thumbnail') }}"
                            placeholder="https://...">
                    </div>

                    <div id="thumb-preview-wrap" class="{{ $movie->thumbnail ? '' : 'd-none' }} mb-3">
                        <label class="form-label text-muted small">Preview poster:</label>
                        <div class="rounded-3 overflow-hidden border shadow-sm" style="height: 200px;">
                            <img id="thumb-preview" src="{{ $movie->thumbnail }}" class="w-100 h-100" style="object-fit: cover;">
                        </div>
                    </div>

                    <div class="text-center text-muted small my-2">── Fallback Icon/Màu ──</div>
                    <div class="mb-2">
                        <label class="form-label text-muted small">FontAwesome Icon</label>
                        <input type="text" name="icon" class="form-control form-control-sm"
                            value="{{ $movie->icon ?? old('icon') }}"
                            placeholder="fa-solid fa-film">
                    </div>
                    <div class="mb-0">
                        <label class="form-label text-muted small">Màu nền (tự tạo poster)</label>
                        <input type="text" name="color" class="form-control form-control-sm"
                            value="{{ $movie->color ?? old('color', 'linear-gradient(135deg, #1e293b, #0f172a)') }}"
                            placeholder="linear-gradient(...)">
                    </div>
                </div>
            </div>

            <!-- Vị trí hiển thị -->
            <div class="card border-0 shadow-sm rounded-4 mb-4 border-top border-3 border-warning">
                <div class="card-header bg-white py-3">
                    <h5 class="fw-bold mb-0">Vị trí hiển thị</h5>
                    <small class="text-muted">Bật để hiện ở các khu vực trên trang Review Phim</small>
                </div>
                <div class="card-body p-4">
                    @php
                    $positions = [
                        'is_main_featured' => ['label' => 'Banner chính (trang danh sách)', 'badge' => 'danger', 'icon' => 'star'],
                        'is_featured'      => ['label' => 'Phim Đề Xuất (Sidebar)', 'badge' => 'primary', 'icon' => 'award'],
                        'is_interested'    => ['label' => 'Có thể bạn quan tâm (Sidebar detail)', 'badge' => 'warning', 'icon' => 'heart'],
                        'is_trending'      => ['label' => 'Top Trending (Sidebar detail)', 'badge' => 'success', 'icon' => 'trending-up'],
                    ];
                    @endphp
                    @foreach($positions as $field => $pos)
                    <div class="form-check form-switch d-flex justify-content-between align-items-start px-0 mb-3 pb-3 {{ !$loop->last ? 'border-bottom' : '' }}">
                        <label class="form-check-label fw-medium small" for="toggle-{{ $field }}" style="cursor:pointer; max-width: 80%;">
                            <i data-lucide="{{ $pos['icon'] }}" size="14" class="me-1 text-{{ $pos['badge'] }}"></i>
                            {{ $pos['label'] }}
                        </label>
                        <input class="form-check-input ms-2 flex-shrink-0" type="checkbox"
                            name="{{ $field }}" id="toggle-{{ $field }}"
                            style="width: 2.5em; height: 1.25em; cursor:pointer;"
                            {{ $movie->$field ? 'checked' : '' }}>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Thứ tự & Xuất bản -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4">
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Thứ tự hiển thị</label>
                        <input type="number" name="order" class="form-control"
                            value="{{ $movie->order ?? old('order', 0) }}" min="0">
                    </div>
                    <div class="form-check form-switch d-flex justify-content-between align-items-center px-0 mb-4">
                        <label class="form-check-label fw-semibold" for="status">Công khai bài viết</label>
                        <input class="form-check-input" type="checkbox" name="status" id="status"
                            style="width: 3em; height: 1.5em;"
                            {{ $movie->status || !$movie->exists ? 'checked' : '' }}>
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 py-3 rounded-3">
                        <i data-lucide="{{ $movie->exists ? 'save' : 'plus-circle' }}" size="20"></i>
                        {{ $movie->exists ? 'Cập nhật' : 'Tạo Review' }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // Live preview thumbnail
    const thumbFile = document.getElementById('thumb-file');
    const thumbUrl = document.getElementById('thumb-url');
    const thumbPreview = document.getElementById('thumb-preview');
    const thumbWrap = document.getElementById('thumb-preview-wrap');

    if (thumbUrl) thumbUrl.addEventListener('input', () => {
        if (thumbUrl.value.startsWith('http')) { thumbPreview.src = thumbUrl.value; thumbWrap.classList.remove('d-none'); }
    });
    if (thumbFile) thumbFile.addEventListener('change', () => {
        const file = thumbFile.files[0];
        if (file) { const r = new FileReader(); r.onload = e => { thumbPreview.src = e.target.result; thumbWrap.classList.remove('d-none'); }; r.readAsDataURL(file); }
    });
</script>

<!-- Summernote Editor -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content-editor').summernote({
            placeholder: 'Viết nội dung review phim chi tiết...',
            height: 500,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video', 'hr']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
</script>
@endsection
