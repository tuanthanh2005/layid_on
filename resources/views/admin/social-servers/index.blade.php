@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">Quản lý Server & Giá</h2>
    <a href="{{ route('admin.social-servers.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus" size="18"></i> Thêm Server mới
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Server</th>
                        <th class="py-3">Dịch vụ</th>
                        <th class="py-3">Giá / Đơn vị</th>
                        <th class="py-3">Giới hạn</th>
                        <th class="py-3">Trạng thái</th>
                        <th class="text-end pe-4 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($servers as $server)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold">{{ $server->name }}</span>
                            <div class="small text-muted text-truncate" style="max-width: 200px;">{{ $server->description }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-primary border border-primary-subtle">
                                <i class="{{ $server->service->icon }} me-1"></i> {{ $server->service->name }}
                            </span>
                        </td>
                        <td><span class="text-danger fw-bold">{{ number_format($server->price_per_unit) }}đ</span></td>
                        <td>
                            <div class="small">Min: {{ number_format($server->min_quantity) }}</div>
                            <div class="small">Max: {{ number_format($server->max_quantity) }}</div>
                        </td>
                        <td>
                            @if($server->status)
                                <span class="badge bg-success-subtle text-success border border-success">Đang bật</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger">Đang tắt</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.social-servers.edit', $server->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                <form action="{{ route('admin.social-servers.destroy', $server->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa server này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Xóa</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
