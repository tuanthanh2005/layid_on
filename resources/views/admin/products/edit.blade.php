@extends('layouts.admin')

@section('content')

{{-- Quill CSS --}}
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="h3 mb-0 fw-bold">Sửa sản phẩm: <span class="text-primary">{{ $product->name }}</span></h1>
        <p class="text-muted small mb-0">Cập nhật thông tin và nội dung chi tiết sản phẩm</p>
    </div>
    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
        <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
    </a>
</div>

<form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" id="product-form">
    @csrf
    @method('PUT')
    <div class="row g-4">

        {{-- ===== CỘT TRÁI ===== --}}
        <div class="col-lg-8">

            {{-- Thông tin cơ bản --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-box me-2 text-primary"></i>Thông tin cơ bản</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tên sản phẩm <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3" value="{{ $product->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Mô tả ngắn <span class="text-muted small">(hiển thị trên card sản phẩm)</span></label>
                        <textarea name="description" class="form-control rounded-3" rows="3">{{ $product->description }}</textarea>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold">Link sản phẩm gốc (URL)</label>
                        <input type="url" name="url" class="form-control rounded-3" placeholder="https://openai.com/chatgpt" value="{{ $product->url }}">
                        <div class="form-text">Nút "Tìm hiểu thêm" sẽ dẫn đến URL này</div>
                    </div>
                </div>
            </div>

            {{-- Chi tiết sản phẩm — Quill Editor --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0">
                        <i class="fa-solid fa-align-left me-2 text-success"></i>Chi tiết sản phẩm
                        <span class="badge bg-success-subtle text-success ms-2 small">Tăng uy tín</span>
                    </h5>
                    <p class="text-muted small mt-1 mb-0">Soạn nội dung đầy đủ hiển thị trên trang chi tiết sản phẩm</p>
                </div>
                <div class="card-body p-4">
                    {{-- Hidden input gửi nội dung lên server --}}
                    <input type="hidden" name="details" id="details-input" value="{{ $product->details }}">
                    <div id="quill-editor" style="min-height: 300px; font-size: 0.95rem;"></div>
                </div>
            </div>

            {{-- Tính năng nổi bật --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-list-check me-2 text-warning"></i>Tính năng nổi bật</h5>
                    <p class="text-muted small mt-1 mb-0">Mỗi dòng = 1 tính năng. Sẽ hiển thị dạng ✅ trên trang chi tiết</p>
                </div>
                <div class="card-body p-4">
                    <textarea name="features" class="form-control rounded-3 font-monospace" rows="6"
                        placeholder="Mỗi dòng một tính năng...">{{ $product->features ? implode("\n", $product->features) : '' }}</textarea>
                </div>
            </div>

            {{-- Video YouTube --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fa-brands fa-youtube me-2 text-danger"></i>Video giới thiệu <span class="text-muted small fw-normal">(tuỳ chọn)</span></h5>
                </div>
                <div class="card-body p-4">
                    <input type="url" name="video_url" class="form-control rounded-3" placeholder="https://www.youtube.com/embed/xxxx" value="{{ $product->video_url }}">
                    <div class="form-text">Dùng link embed: <code>https://www.youtube.com/embed/VIDEO_ID</code></div>
                    @if($product->video_url)
                    <div class="mt-3 ratio ratio-16x9 rounded-3 overflow-hidden border">
                        <iframe src="{{ $product->video_url }}" allowfullscreen></iframe>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- ===== CỘT PHẢI ===== --}}
        <div class="col-lg-4">

            {{-- Giá bán --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-tag me-2 text-danger"></i>Giá bán</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Giá bán (VNĐ) <span class="text-danger">*</span></label>
                        <input type="number" name="price" class="form-control form-control-lg rounded-3 fw-bold text-danger" value="{{ $product->price }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label fw-semibold text-muted">Giá gốc / Giá cũ</label>
                        <input type="number" name="discount_price" class="form-control rounded-3" value="{{ $product->discount_price }}">
                    </div>
                </div>
            </div>

            {{-- Hình ảnh --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-image me-2 text-info"></i>Hình ảnh</h5>
                </div>
                <div class="card-body p-4">
                    @if($product->image)
                    <div class="mb-3 text-center">
                        <img src="{{ $product->image }}" alt="" class="img-fluid rounded-3 border" style="max-height:140px;">
                        <div class="small text-muted mt-1">Ảnh hiện tại</div>
                    </div>
                    @endif
                    <input type="file" name="image_file" class="form-control rounded-3" accept="image/*" onchange="previewImage(this)">
                    <div class="form-text mb-2">Khuyên dùng <strong>500×334px</strong> (tỷ lệ 3:2)</div>
                    <div id="img-preview" class="mt-2" style="display:none;">
                        <img id="preview-img" class="img-fluid rounded-3 border" style="max-height:140px;">
                        <div class="small text-muted mt-1">Ảnh mới (chưa lưu)</div>
                    </div>
                </div>
            </div>

            {{-- Cài đặt --}}
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                    <h5 class="fw-bold mb-0"><i class="fa-solid fa-gear me-2 text-secondary"></i>Cài đặt</h5>
                </div>
                <div class="card-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nhãn Badge</label>
                        <input type="text" name="badge_text" class="form-control rounded-3" placeholder="Hot / Sale / Mới" value="{{ $product->badge_text }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nhãn danh mục</label>
                        <input type="text" name="category_label" class="form-control rounded-3" placeholder="ChatGPT / Gemini / Claude..." value="{{ $product->category_label }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Thứ tự hiển thị</label>
                        <input type="number" name="order_index" class="form-control rounded-3" value="{{ $product->order_index }}">
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="status" id="status" value="1" {{ $product->status ? 'checked' : '' }}>
                        <label class="form-check-label fw-semibold" for="status">Đang bán (hiển thị)</label>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn btn-primary w-100 py-3 rounded-3 fw-bold fs-5 shadow">
                <i class="fa-solid fa-save me-2"></i> Lưu thay đổi
            </button>
        </div>
    </div>
</form>

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('img-preview').style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}

const quill = new Quill('#quill-editor', {
    theme: 'snow',
    placeholder: 'Soạn nội dung chi tiết sản phẩm tại đây...',
    modules: {
        toolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['blockquote', 'link'],
            ['clean']
        ]
    }
});

// Load nội dung hiện tại vào Quill
const existingContent = document.getElementById('details-input').value;
if (existingContent) {
    quill.root.innerHTML = existingContent;
}

// Submit: đồng bộ nội dung Quill vào hidden input
document.getElementById('product-form').addEventListener('submit', function() {
    document.getElementById('details-input').value = quill.root.innerHTML;
});
</script>
@endsection
