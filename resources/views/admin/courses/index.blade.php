@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">Quản lý Khóa học</h1>
        <p class="text-muted small mb-0">Học Ngôn Ngữ Miễn Phí — tổng hợp các khóa học video và tài liệu kỹ thuật.</p>
    </div>
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm">
        <i data-lucide="plus-circle" size="20"></i> Thêm khóa học
    </a>
</div>

@if($courses->isEmpty())
<div class="card border-0 shadow-sm rounded-4 text-center py-5">
    <div class="card-body py-5">
        <i data-lucide="graduation-cap" size="64" class="text-secondary mb-3" style="opacity:.25"></i>
        <h4 class="fw-bold">Chưa có khóa học nào</h4>
        <p class="text-muted">Bắt đầu tạo khóa học đầu tiên để chia sẻ kiến thức IT miễn phí.</p>
        <a href="{{ route('admin.courses.create') }}" class="btn btn-primary rounded-pill px-5 mt-2 shadow-sm">Thêm ngay</a>
    </div>
</div>
@else
<div class="row g-4">
    @foreach($courses as $course)
    <div class="col-xl-4 col-md-6">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden course-admin-card">
            <!-- Thumbnail -->
            <div style="height: 180px; overflow: hidden; position: relative;">
                @if($course->thumbnail)
                    <img src="{{ $course->thumbnail }}" class="w-100 h-100 object-fit-cover transition-img" alt="{{ $course->title }}">
                @else
                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-primary-subtle">
                        <i data-lucide="book-open" size="48" class="text-primary mb-2"></i>
                        <span class="small text-primary fw-bold">CHƯA CÓ ẢNH</span>
                    </div>
                @endif
                <!-- Status badge -->
                <div style="position: absolute; top: 10px; right: 10px;">
                    @if($course->status)
                        <span class="badge bg-success shadow-sm">Công khai</span>
                    @else
                        <span class="badge bg-secondary shadow-sm">Ẩn</span>
                    @endif
                </div>
            </div>

            <div class="card-body px-4 py-3">
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2">{{ $course->level }}</span>
                    @if($course->duration)
                    <span class="text-muted small"><i data-lucide="clock" size="12" class="me-1"></i>{{ $course->duration }}</span>
                    @endif
                </div>
                <h5 class="fw-bold mb-2 text-dark">{{ $course->title }}</h5>
                <p class="text-muted small mb-0 text-truncate-2">{{ $course->description ?: 'Chưa có mô tả.' }}</p>
            </div>

            <div class="card-footer bg-white border-top px-4 py-3 d-flex justify-content-between align-items-center">
                <a href="{{ route('admin.lessons.index', ['course_id' => $course->id]) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3 d-flex align-items-center gap-1">
                    <i data-lucide="play-circle" size="14"></i>
                    {{ $course->lessons->count() }} bài học
                </a>
                <div class="d-flex gap-2">
                    <a href="{{ route('admin.courses.edit', $course->id) }}" class="btn btn-sm btn-light border icon-btn-sm" title="Chỉnh sửa">
                        <i data-lucide="edit-2" size="15"></i>
                    </a>
                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Xóa khóa học này và tất cả bài học bên trong?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-light border icon-btn-sm text-danger" title="Xóa">
                            <i data-lucide="trash-2" size="15"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endif

<style>
    .text-truncate-2 { display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; }
    .object-fit-cover { object-fit: cover; }
    .bg-primary-subtle { background-color: #eff6ff; }
    .course-admin-card { transition: transform 0.25s, box-shadow 0.25s; }
    .course-admin-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px -5px rgba(0,0,0,.12) !important; }
    .transition-img { transition: transform 0.5s ease; }
    .course-admin-card:hover .transition-img { transform: scale(1.06); }
    .icon-btn-sm { width: 32px; height: 32px; display:flex; align-items:center; justify-content:center; padding:0; }
</style>
@endsection
