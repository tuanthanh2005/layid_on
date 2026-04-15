@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="page-title mb-0">Quản lý Bài viết (Blog)</h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="plus-circle" size="18"></i> Thêm bài viết mới
        </a>
    </div>

    <div class="card border-0 shadow-sm rounded-3">
        <div class="card-header bg-white border-bottom py-3">
            <form action="{{ route('admin.posts.index') }}" method="GET" class="d-flex gap-2">
                <div class="flex-grow-1 position-relative">
                    <i data-lucide="search" size="16" style="position: absolute; left: 12px; top: 11px; color: #adb5bd;"></i>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control ps-5" placeholder="Tìm tên bài viết...">
                </div>
                <button type="submit" class="btn btn-light border">Lọc</button>
            </form>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4" style="width: 80px;">Thumbnail</th>
                            <th>Thông tin bài viết</th>
                            <th>Trạng thái</th>
                            <th>Lượt xem</th>
                            <th>Ngày đăng</th>
                            <th class="text-end pe-4">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($posts as $post)
                        <tr>
                            <td class="ps-4">
                                @if($post->thumbnail)
                                    <img src="{{ $post->thumbnail }}" class="rounded" width="50" height="50" style="object-fit: cover;">
                                @else
                                    <div class="rounded d-flex align-items-center justify-content-center bg-light" width="50" height="50" style="width: 50px; height: 50px;">
                                        <i data-lucide="{{ $post->icon ?? 'image' }}" size="20" class="text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div>
                                    <div class="fw-bold text-dark">{{ $post->title }}</div>
                                    <small class="text-muted">slug: {{ $post->slug }}</small>
                                </div>
                                <div class="mt-1 d-flex gap-1">
                                    @if($post->is_featured) <span class="badge bg-info" style="font-size: 10px;">Nổi bật</span> @endif
                                    @if($post->is_trending) <span class="badge bg-warning" style="font-size: 10px;">Xu hướng</span> @endif
                                </div>
                            </td>
                            <td>
                                @if($post->status)
                                    <span class="badge bg-success">Công khai</span>
                                @else
                                    <span class="badge bg-secondary">Bản nháp</span>
                                @endif
                            </td>
                            <td>
                                <span class="fw-medium">{{ number_format($post->views) }}</span>
                            </td>
                            <td>
                                <small class="text-muted">{{ $post->created_at->format('d/m/Y') }}</small>
                            </td>
                            <td class="text-end pe-4">
                                <div class="d-flex justify-content-end gap-2">
                                    <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-sm btn-light border" title="Xem trước">
                                        <i data-lucide="external-link" size="14"></i>
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-light border text-primary" title="Sửa">
                                        <i data-lucide="edit" size="14"></i>
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Xóa bài viết này?')" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light border text-danger" title="Xóa">
                                            <i data-lucide="trash-2" size="14"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Chưa có bài viết nào.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($posts->hasPages())
        <div class="card-footer bg-white border-top py-3">
            {{ $posts->links() }}
        </div>
        @endif
    </div>
@endsection
