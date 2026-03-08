@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800">Quản lý Kho Tiện ích (Home Tools)</h2>
    <a href="{{ route('admin.utilities.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus" size="18"></i> Thêm tiện ích
    </a>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="card shadow-sm border-0 rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 py-3 text-muted" style="width: 50px;">#</th>
                        <th class="px-4 py-3 text-muted">Hiển thị (Khối)</th>
                        <th class="px-4 py-3 text-muted">Tiêu đề tiện ích</th>
                        <th class="px-4 py-3 text-muted">Liên kết (URL)</th>
                        <th class="px-4 py-3 text-muted text-center" style="width: 100px;">Trạng thái</th>
                        <th class="px-4 py-3 text-muted text-end" style="width: 150px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($utilities as $utility)
                    <tr>
                        <td class="px-4 py-3 fw-bold text-muted">{{ $utility->order_index }}</td>
                        <td class="px-4 py-3">
                            <div class="d-flex align-items-center justify-content-center rounded-3 shadow-sm" style="width: 60px; height: 60px; background: {{ $utility->color }}; color: white;">
                                <i class="{{ $utility->icon }} fa-2x"></i>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <h6 class="mb-1 fw-bold">{{ $utility->title }}</h6>
                            <div class="text-muted small">{{ $utility->description }}</div>
                        </td>
                        <td class="px-4 py-3">
                            <a href="{{ $utility->url }}" target="_blank" class="text-primary text-decoration-none" style="font-size: 0.9rem;">{{ Str::limit($utility->url, 30) }}</a>
                        </td>
                        <td class="px-4 py-3 text-center">
                            @if($utility->status)
                                <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1 rounded-pill">Đang bật</span>
                            @else
                                <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1 rounded-pill">Đã tắt</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-end">
                            <a href="{{ route('admin.utilities.edit', $utility) }}" class="btn btn-sm btn-light text-primary me-2 flex-center" title="Sửa" style="width: 32px; height: 32px; padding: 0;">
                                <i data-lucide="edit" size="16"></i>
                            </a>
                            <form action="{{ route('admin.utilities.destroy', $utility) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger flex-center" onclick="return confirm('Bạn có chắc chắn muốn xoá tiện ích này?')" title="Xoá" style="width: 32px; height: 32px; padding: 0;">
                                    <i data-lucide="trash-2" size="16"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">
                            <div class="mb-3">
                                <i data-lucide="package-open" size="48" class="opacity-50"></i>
                            </div>
                            Chưa có tiện ích nào.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.flex-center {
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style>
@endsection
