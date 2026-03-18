@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">Review Phim</h1>
        <p class="text-muted small mb-0">Quản lý các bài review, đánh giá phim chiếu rạp và phim mới.</p>
    </div>
    <a href="{{ route('admin.movies.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm">
        <i data-lucide="plus-circle" size="20"></i> Thêm review mới
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary small text-uppercase">
                    <tr>
                        <th class="ps-4 py-3" style="width: 45%">Phim</th>
                        <th class="py-3 text-center">Thể loại</th>
                        <th class="py-3 text-center">Đánh giá</th>
                        <th class="py-3 text-center">Vị trí hiển thị</th>
                        <th class="py-3 text-center">Trạng thái</th>
                        <th class="py-3 text-end pe-4">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($movies as $movie)
                    <tr>
                        <td class="ps-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 overflow-hidden shadow-sm flex-shrink-0" style="width: 75px; height: 100px;">
                                    @if($movie->thumbnail)
                                        <img src="{{ $movie->thumbnail }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $movie->title }}">
                                    @elseif($movie->icon && $movie->color)
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white small fw-bold text-center" style="background: {{ $movie->color }};">
                                            <i class="{{ $movie->icon }}" style="font-size: 1.5rem;"></i>
                                        </div>
                                    @else
                                        <div class="w-100 h-100 bg-dark d-flex align-items-center justify-content-center text-muted">
                                            <i data-lucide="film" size="24"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="fw-bold mb-1 text-dark text-truncate">{{ $movie->title }}</h6>
                                    @if($movie->original_title)
                                    <div class="text-muted small fst-italic mb-1 text-truncate">{{ $movie->original_title }}</div>
                                    @endif
                                    <div class="d-flex flex-wrap gap-1 small text-muted">
                                        @if($movie->director)<span><i data-lucide="user" size="11" class="me-1"></i>{{ $movie->director }}</span>@endif
                                        @if($movie->release_year)<span class="ms-2"><i data-lucide="calendar" size="11" class="me-1"></i>{{ $movie->release_year }}</span>@endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($movie->genre)
                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2">{{ $movie->genre }}</span>
                            @else<span class="text-muted">—</span>@endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex align-items-center justify-content-center gap-1">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($i <= floor($movie->rating))
                                        <i class="fa-solid fa-star" style="color: #f59e0b; font-size: 11px;"></i>
                                    @elseif($i == ceil($movie->rating) && $movie->rating != floor($movie->rating))
                                        <i class="fa-solid fa-star-half-stroke" style="color: #f59e0b; font-size: 11px;"></i>
                                    @else
                                        <i class="fa-regular fa-star" style="color: #cbd5e1; font-size: 11px;"></i>
                                    @endif
                                @endfor
                                <span class="ms-1 small fw-bold text-dark">{{ number_format($movie->rating, 1) }}</span>
                            </div>
                            @if($movie->rating_label)<div class="small text-muted">{{ $movie->rating_label }}</div>@endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-1 flex-wrap justify-content-center">
                                @if($movie->is_main_featured)<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2" title="Banner chính">Banner</span>@endif
                                @if($movie->is_featured)<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2" title="Phim Đề Xuất">Đề Xuất</span>@endif
                                @if($movie->is_interested)<span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2" title="Quan tâm">Quan Tâm</span>@endif
                                @if($movie->is_trending)<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2" title="Top Trending">Trending</span>@endif
                            </div>
                        </td>
                        <td class="text-center">
                            @if($movie->status)
                                <div class="d-inline-flex align-items-center bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">
                                    <span class="rounded-circle bg-success me-1" style="width:7px;height:7px;"></span> Công khai
                                </div>
                            @else
                                <div class="d-inline-flex align-items-center bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 small">
                                    <span class="rounded-circle bg-secondary me-1" style="width:7px;height:7px;"></span> Ẩn
                                </div>
                            @endif
                        </td>
                        <td class="pe-4 text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" size="16"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.movies.edit', $movie) }}"><i data-lucide="edit" size="14" class="me-2 text-primary"></i> Chỉnh sửa</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('movies.show', $movie->slug) }}" target="_blank"><i data-lucide="external-link" size="14" class="me-2 text-info"></i> Xem trước</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Xóa review phim \"{{ $movie->title }}\"?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="dropdown-item py-2 text-danger"><i data-lucide="trash-2" size="14" class="me-2"></i> Xóa vĩnh viễn</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5">
                            <div class="py-4">
                                <i data-lucide="film" size="64" class="text-secondary mb-3 opacity-25"></i>
                                <h5 class="fw-bold">Chưa có review phim nào</h5>
                                <p class="text-muted small">Bắt đầu viết review những bộ phim bạn đã xem.</p>
                                <a href="{{ route('admin.movies.create') }}" class="btn btn-primary rounded-pill px-5 mt-2 shadow-sm">Thêm ngay</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($movies->hasPages())
    <div class="card-footer bg-white py-3 border-top">
        {{ $movies->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<style>
    .bg-danger-subtle { background-color: #fff1f2 !important; }
    .bg-primary-subtle { background-color: #eff6ff !important; }
    .bg-success-subtle { background-color: #f0fdf4 !important; }
    .bg-warning-subtle { background-color: #fffbeb !important; }
    .bg-secondary-subtle { background-color: #f8fafc !important; }
</style>
@endsection
