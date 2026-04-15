@extends('layouts.admin')

@section('content')
    <div class="mb-4">
        <a href="{{ route('admin.posts.index') }}" class="text-decoration-none text-muted d-inline-flex align-items-center mb-2">
            <i data-lucide="arrow-left" size="16" class="me-1"></i> Quay lại
        </a>
        <h1 class="page-title">Thêm bài viết mới</h1>
    </div>

    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label fw-bold">Tiêu đề bài viết</label>
                            <input type="text" name="title" class="form-control form-control-lg @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="Nhập tiêu đề...">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Nội dung bài viết</label>
                            <textarea name="content" id="editor" class="form-control" rows="15">{{ old('content') }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0">Cấu hình SEO</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-3">
                            <label class="form-label">Meta Title</label>
                            <input type="text" name="meta_title" class="form-control" value="{{ old('meta_title') }}" placeholder="Tiêu đề hiển thị trên Google">
                        </div>
                        <div class="mb-0">
                            <label class="form-label">Meta Description</label>
                            <textarea name="meta_description" class="form-control" rows="3" placeholder="Mô tả ngắn cho Google">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-3 mb-4">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0">Thiết lập</h5>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Hình ảnh đại diện</label>
                            <input type="file" name="thumbnail_file" class="form-control mb-2" accept="image/*">
                            <div class="text-center text-muted small mb-2">--- HOẶC ---</div>
                            <input type="text" name="thumbnail" class="form-control" value="{{ old('thumbnail') }}" placeholder="Dán URL ảnh vào đây...">
                        </div>

                        <div class="mb-3 d-flex align-items-center justify-content-between p-3 border rounded">
                            <div class="fw-medium">Trạng thái công khai</div>
                            <div class="form-check form-switch p-0 m-0">
                                <input class="form-check-input ms-0" type="checkbox" name="status" value="1" checked>
                            </div>
                        </div>

                        <div class="list-group mb-4">
                            <label class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Bài viết nổi bật</span>
                                <input class="form-check-input me-1" type="checkbox" name="is_featured" value="1">
                            </label>
                            <label class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Hiện trên Grid chính</span>
                                <input class="form-check-input me-1" type="checkbox" name="is_grid" value="1">
                            </label>
                            <label class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Đang được quan tâm</span>
                                <input class="form-check-input me-1" type="checkbox" name="is_interested" value="1">
                            </label>
                            <label class="list-group-item d-flex justify-content-between align-items-center">
                                <span>Hiện ở Sidebar</span>
                                <input class="form-check-input me-1" type="checkbox" name="is_blog_sidebar" value="1">
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 py-3 fw-bold">
                            <i data-lucide="save" size="18" class="me-2"></i> Đăng bài viết
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'insertTable', 'undo', 'redo' ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
