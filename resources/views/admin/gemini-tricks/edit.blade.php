@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Chỉnh sửa Thủ thuật Gemini</h1>
    <a href="{{ route('admin.gemini-tricks.index') }}" class="btn btn-outline-secondary d-flex align-items-center gap-2">
        <i data-lucide="arrow-left" size="18"></i> Quay lại
    </a>
</div>

<form action="{{ route('admin.gemini-tricks.update', $geminiTrick) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-4">Nội dung thủ thuật</h5>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Tiêu đề</label>
                        <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title', $geminiTrick->title) }}" placeholder="Nhập tiêu đề..." required>
                        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Nội dung chi tiết <span class="text-danger">*</span></label>
                        <textarea name="content" id="content-editor" class="form-control">{{ old('content', $geminiTrick->content) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-4">
                    <h5 class="card-title fw-bold mb-3">Hình ảnh & Trạng thái</h5>
                    
                    @if($geminiTrick->image)
                        <div class="mb-3">
                            <img src="{{ asset($geminiTrick->image) }}" class="img-fluid rounded border mb-2">
                        </div>
                    @endif

                    <div class="mb-3">
                        <label class="form-label text-muted">Ảnh minh họa (Tải mới để thay đổi)</label>
                        <input type="file" name="image_file" class="form-control" accept="image/*">
                    </div>

                    <div class="mb-3">
                        <label class="form-label text-muted">Thứ tự hiển thị</label>
                        <input type="number" name="order" class="form-control" value="{{ old('order', $geminiTrick->order) }}">
                    </div>

                    <div class="form-check form-switch mb-4">
                        <input class="form-check-input" type="checkbox" name="status" id="trick-status" value="1" {{ $geminiTrick->status ? 'checked' : '' }}>
                        <label class="form-check-label fw-bold" for="trick-status">Công khai</label>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold">
                        <i data-lucide="save" size="20" class="me-2"></i> Lưu thay đổi
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
        $('#content-editor').summernote({
            placeholder: 'Nhập nội dung hướng dẫn tại đây...',
            height: 400,
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview']]
            ]
        });
    });
</script>
@endsection
