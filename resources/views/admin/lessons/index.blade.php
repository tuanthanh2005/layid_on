@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">
            @if(request('course_id'))
                @php $filterCourse = $courses->firstWhere('id', request('course_id')); @endphp
                Bài học: <span class="text-primary">{{ $filterCourse->title ?? 'Tất cả' }}</span>
            @else
                Quản lý Bài học
            @endif
        </h1>
        <p class="text-muted small mb-0">Danh sách các bài học trong hệ thống Học Ngôn Ngữ Miễn Phí.</p>
    </div>
    <a href="{{ route('admin.lessons.create') }}{{ request('course_id') ? '?course_id='.request('course_id') : '' }}"
        class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm">
        <i data-lucide="plus-circle" size="20"></i> Thêm bài học
    </a>
</div>

<!-- Filter Bar -->
<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body py-3 px-4">
        <form action="{{ route('admin.lessons.index') }}" method="GET" class="d-flex align-items-center gap-3 flex-wrap">
            <div style="min-width: 280px;">
                <select name="course_id" class="form-select" onchange="this.form.submit()">
                    <option value="">📚 Tất cả khóa học</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                            {{ $course->title }}
                        </option>
                    @endforeach
                </select>
            </div>
            @if(request('course_id'))
            <a href="{{ route('admin.lessons.index') }}" class="btn btn-sm btn-light border d-flex align-items-center gap-1">
                <i data-lucide="x" size="14"></i> Bỏ lọc
            </a>
            @endif
            <span class="text-muted small ms-auto">Tổng: <strong>{{ $lessons->count() }}</strong> bài học</span>
        </form>
    </div>
</div>

<!-- Table -->
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="width: 50px;">#</th>
                        <th class="py-3" style="width: 40%;">Tiêu đề bài học</th>
                        <th class="py-3">Khóa học</th>
                        <th class="py-3 text-center">Nguồn video</th>
                        <th class="py-3 text-center">Trạng thái</th>
                        <th class="py-3 text-end pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lessons as $lesson)
                    <tr>
                        <td class="ps-4 text-muted fw-bold">{{ $lesson->order }}</td>
                        <td>
                            <div class="fw-bold text-dark">{{ $lesson->title }}</div>
                            @if($lesson->video_url)
                            <div class="small text-muted text-truncate" style="max-width: 300px;" title="{{ $lesson->video_url }}">
                                <i data-lucide="link" size="11" class="me-1"></i>{{ $lesson->video_url }}
                            </div>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.lessons.index', ['course_id' => $lesson->course_id]) }}"
                                class="badge bg-light text-dark border text-decoration-none hover-primary">
                                {{ $lesson->course->title ?? '—' }}
                            </a>
                        </td>
                        <td class="text-center">
                            @if($lesson->video_type == 'youtube')
                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle px-2">
                                    <i class="fa-brands fa-youtube me-1"></i> YouTube
                                </span>
                            @elseif($lesson->video_type == 'driver')
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-2">
                                    <i class="fa-brands fa-google-drive me-1"></i> Drive
                                </span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2">
                                    <i class="fa-solid fa-link me-1"></i> URL
                                </span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($lesson->is_free)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2">✅ Miễn phí</span>
                            @else
                                <span class="badge bg-warning-subtle text-warning border border-warning-subtle px-2">🔒 Premium</span>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" size="16"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li>
                                        <a class="dropdown-item py-2" href="{{ route('admin.lessons.edit', $lesson->id) }}">
                                            <i data-lucide="edit" size="14" class="me-2 text-primary"></i> Chỉnh sửa
                                        </a>
                                    </li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST"
                                            onsubmit="return confirm('Xóa bài học \"{{ $lesson->title }}\"?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item py-2 text-danger">
                                                <i data-lucide="trash-2" size="14" class="me-2"></i> Xóa bài học
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="py-4">
                                <i data-lucide="video-off" size="56" class="mb-3 opacity-25"></i>
                                <h5 class="fw-bold">Chưa có bài học nào</h5>
                                <p class="small">Thêm bài học mới để bắt đầu xây dựng nội dung khóa học.</p>
                                <a href="{{ route('admin.lessons.create') }}" class="btn btn-primary rounded-pill px-4 mt-2 shadow-sm">Thêm ngay</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .bg-danger-subtle { background-color: #fff1f2 !important; }
    .bg-primary-subtle { background-color: #eff6ff !important; }
    .bg-success-subtle { background-color: #f0fdf4 !important; }
    .bg-warning-subtle { background-color: #fffbeb !important; }
    .bg-secondary-subtle { background-color: #f8fafc !important; }
</style>
@endsection
