@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h2 class="page-title mb-1">Blog & Mẹo Công Nghệ</h2>
        <p class="text-muted small mb-0">Quản lý bài viết hiển thị trên trang chủ và chuyên mục tin tức AI.</p>
    </div>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-4 shadow-sm">
        <i data-lucide="plus-circle" size="20"></i> Thêm bài viết mới
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary font-weight-bold">
                    <tr>
                        <th class="px-4 py-3" style="width: 45%">Tiêu đề bài viết</th>
                        <th class="px-4 py-3 text-center">Vị trí Trang chủ</th>
                        <th class="px-4 py-3 text-center">Trạng thái</th>
                        <th class="px-4 py-3 text-end" style="width: 15%">Hành động</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    @forelse($posts as $post)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="post-thumb rounded-3 overflow-hidden shadow-xs" style="width: 80px; height: 50px; flex-shrink: 0;">
                                    @if($post->thumbnail)
                                        <img src="{{ asset($post->thumbnail) }}" alt="" class="w-100 h-100 object-fit-cover">
                                    @elseif($post->icon && $post->color)
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center text-white" style="background: {{ $post->color }}">
                                            <i class="{{ $post->icon }}" style="font-size: 1.2rem;"></i>
                                        </div>
                                    @else
                                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center text-muted">
                                            <i data-lucide="image" size="20"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="overflow-hidden">
                                    <h6 class="mb-1 fw-bold text-dark text-truncate" title="{{ $post->title }}">{{ $post->title }}</h6>
                                    <div class="d-flex align-items-center gap-2 small text-muted">
                                        <span><i data-lucide="calendar" size="12" class="me-1"></i>{{ $post->updated_at->format('d/m/Y') }}</span>
                                        @if($post->is_trending)
                                            <span class="text-danger fw-bold"><i data-lucide="trending-up" size="12" class="me-1"></i>Trending</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="d-flex gap-1 flex-wrap justify-content-center">
                                @if($post->is_featured)<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2">Hero</span>@endif
                                @if($post->is_grid)<span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2">Discovery</span>@endif
                                @if($post->is_recommended)<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2">Đề cử</span>@endif
                                @if($post->is_interested)<span class="badge bg-warning-subtle text-warning border border-warning-subtle rounded-pill px-2">Quan tâm</span>@endif
                                @if($post->is_video)<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2">Video</span>@endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($post->status)
                                <div class="d-inline-flex align-items-center bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">
                                    <span class="pulse-indicator bg-success me-2"></span> Đã đăng
                                </div>
                            @else
                                <div class="d-inline-flex align-items-center bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2 py-1 small">
                                    <span class="bg-secondary rounded-circle me-2" style="width: 8px; height: 8px;"></span> Bản nháp
                                </div>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <div class="dropdown">
                                <button class="btn btn-sm btn-light border more-btn" type="button" data-bs-toggle="dropdown">
                                    <i data-lucide="more-vertical" size="16"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                    <li><a class="dropdown-item py-2" href="{{ route('admin.posts.edit', $post) }}"><i data-lucide="edit" size="14" class="me-2 text-primary"></i> Chỉnh sửa</a></li>
                                    <li><a class="dropdown-item py-2" href="{{ route('post.show', $post->slug) }}" target="_blank"><i data-lucide="external-link" size="14" class="me-2 text-info"></i> Xem nhanh</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa bài viết này?')">
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
                        <td colspan="4" class="text-center py-5 text-muted">
                            <div class="py-4">
                                <i data-lucide="inbox" size="64" class="mb-3 text-secondary opacity-25"></i>
                                <h5 class="fw-bold">Chưa có bài viết nào</h5>
                                <p class="small">Bắt đầu viết những bài chia sẻ công nghệ đầu tiên ngay hôm nay.</p>
                                <a href="{{ route('admin.posts.create') }}" class="btn btn-primary mt-2 px-4 rounded-pill shadow-sm">Thêm mới bài viết</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($posts->hasPages())
    <div class="card-footer bg-white py-3 border-top">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
    @endif
</div>

<style>
    .pulse-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        display: inline-block;
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(74, 222, 128, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 5px rgba(74, 222, 128, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(74, 222, 128, 0); }
    }
    .more-btn:hover { background: #f1f5f9; }
    .object-fit-cover { object-fit: cover; }
    .shadow-xs { box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
</style>
@endsection
