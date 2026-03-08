@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Quản lý bài viết trang chủ</h1>
    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus-circle" size="18"></i> Thêm bài viết mới
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3" style="width: 40%">Bài viết</th>
                        <th class="px-4 py-3 text-center">Vị trí hiển thị (Trang chủ)</th>
                        <th class="px-4 py-3 text-center">Trạng thái</th>
                        <th class="px-4 py-3 text-end" style="width: 15%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                @if($post->thumbnail)
                                    <img src="{{ $post->thumbnail }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                @elseif($post->icon && $post->color)
                                    <div style="width: 60px; height: 40px; background: {{ $post->color }}; border-radius: 4px; display:flex; align-items:center; justify-content:center; color:white;">
                                        <i class="{{ $post->icon }}" style="font-size: 1.2rem;"></i>
                                    </div>
                                @else
                                    <div style="width: 60px; height: 40px; background: #e2e8f0; border-radius: 4px; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">{{ $post->title }}</h6>
                                    <span class="text-muted small">Cập nhật: {{ $post->updated_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="d-flex gap-1 flex-wrap justify-content-center">
                                @if($post->is_featured)<span class="badge bg-primary">Feature (To)</span>@endif
                                @if($post->is_grid)<span class="badge bg-info">Grid (4 ô)</span>@endif
                                @if($post->is_recommended)<span class="badge bg-success">Đề cử (Sidebar 1)</span>@endif
                                @if($post->is_interested)<span class="badge bg-warning text-dark">Quan tâm (Sidebar 2)</span>@endif
                                @if($post->is_video)<span class="badge bg-danger">Video (Bottom)</span>@endif
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($post->status)
                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1"><i class="fa-solid fa-circle text-success" style="font-size: 8px; margin-right: 5px;"></i> Công khai</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary px-2 py-1"><i class="fa-solid fa-circle text-secondary" style="font-size: 8px; margin-right: 5px;"></i> Bản nháp</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <a href="{{ route('admin.posts.edit', $post) }}" class="btn btn-sm btn-light border" title="Chỉnh sửa"><i data-lucide="edit-2" size="16"></i></a>
                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này không?')" title="Xóa">
                                    <i data-lucide="trash-2" size="16"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i data-lucide="file-x" size="48" class="mb-3 text-secondary" style="opacity: 0.5;"></i>
                            <p>Chưa có bài viết nào.</p>
                            <a href="{{ route('admin.posts.create') }}" class="btn btn-sm btn-primary mt-2">Tạo ngay</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $posts->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
