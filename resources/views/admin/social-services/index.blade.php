@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">Quản lý Dịch vụ Buff</h2>
    <a href="{{ route('admin.social-services.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus" size="18"></i> Thêm dịch vụ mới
    </a>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Icon</th>
                        <th class="py-3">Tên dịch vụ</th>
                        <th class="py-3">Slug (Đường dẫn)</th>
                        <th class="py-3">Thứ tự</th>
                        <th class="py-3">Trạng thái</th>
                        <th class="py-3">Trang chủ</th>
                        <th class="text-end pe-4 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($services as $service)
                    <tr>
                        <td class="ps-4">
                            <div class="bg-light rounded-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                <i class="{{ $service->icon }} text-primary fs-5"></i>
                            </div>
                        </td>
                        <td><span class="fw-bold">{{ $service->name }}</span></td>
                        <td><code>{{ $service->slug }}</code></td>
                        <td>{{ $service->order }}</td>
                        <td>
                            @if($service->status)
                                <span class="badge bg-success-subtle text-success border border-success">Đang bật</span>
                            @else
                                <span class="badge bg-danger-subtle text-danger border border-danger">Đang tắt</span>
                            @endif
                        </td>
                        <td>
                            @if($service->show_on_home)
                                <span class="badge bg-info-subtle text-info border border-info">Hiện Home</span>
                            @endif
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.social-services.edit', $service->id) }}" class="btn btn-sm btn-outline-primary">Sửa</a>
                                <form action="{{ route('admin.social-services.destroy', $service->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc chắn muốn xóa dịch vụ này?')">
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
