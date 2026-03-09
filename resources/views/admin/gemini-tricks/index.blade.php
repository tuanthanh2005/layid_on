@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Quản lý Thủ thuật Gemini</h1>
    <a href="{{ route('admin.gemini-tricks.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus-circle" size="18"></i> Thêm thủ thuật mới
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3" style="width: 50%">Thủ thuật</th>
                        <th class="px-4 py-3 text-center">Thứ tự</th>
                        <th class="px-4 py-3 text-center">Trạng thái</th>
                        <th class="px-4 py-3 text-end" style="width: 15%">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tricks as $trick)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center gap-3">
                                @if($trick->image)
                                    <img src="{{ asset($trick->image) }}" alt="" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;">
                                @else
                                    <div style="width: 60px; height: 40px; background: #e2e8f0; border-radius: 4px; display:flex; align-items:center; justify-content:center; color:#94a3b8;">
                                        <i class="fa-solid fa-image"></i>
                                    </div>
                                @endif
                                <div>
                                    <h6 class="mb-1 fw-bold text-dark">{{ $trick->title }}</h6>
                                    <span class="text-muted small">Cập nhật: {{ $trick->updated_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="badge bg-light text-dark border">{{ $trick->order }}</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($trick->status)
                                <span class="badge bg-success-subtle text-success border border-success px-2 py-1">Công khai</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary px-2 py-1">Bản nháp</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <a href="{{ route('admin.gemini-tricks.edit', $trick) }}" class="btn btn-sm btn-light border" title="Chỉnh sửa"><i data-lucide="edit-2" size="16"></i></a>
                            <form action="{{ route('admin.gemini-tricks.destroy', $trick) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa thủ thuật này không?')" title="Xóa">
                                    <i data-lucide="trash-2" size="16"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <p>Chưa có thủ thuật nào.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3">
        {{ $tricks->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
