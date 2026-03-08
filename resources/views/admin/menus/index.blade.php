@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Quản lý Menu</h1>
    <a href="{{ route('admin.menus.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="plus-circle" size="18"></i> Thêm Menu
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Tên Menu</th>
                    <th>Đường dẫn (URL)</th>
                    <th>Thứ tự</th>
                    <th>Trạng thái</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($menus as $menu)
                <tr class="table-primary bg-opacity-10">
                    <td class="ps-4 fw-bold">
                        <i data-lucide="{{ $menu->icon ?? 'link' }}" size="16" class="me-2"></i>
                        {{ $menu->name }}
                    </td>
                    <td><code>{{ $menu->url }}</code></td>
                    <td>{{ $menu->order }}</td>
                    <td>
                        <span class="badge {{ $menu->status ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                            {{ $menu->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-light border"><i data-lucide="edit-2" size="14"></i></a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" onsubmit="return confirm('Xóa menu này sẽ xóa cả các menu con. Chắc chắn chứ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @foreach($menu->children as $child)
                <tr>
                    <td class="ps-5 text-muted">
                        <span class="me-2">└─</span>
                        <i data-lucide="{{ $child->icon ?? 'link-2' }}" size="14" class="me-2"></i>
                        {{ $child->name }}
                    </td>
                    <td><code>{{ $child->url }}</code></td>
                    <td>{{ $child->order }}</td>
                    <td>
                         <span class="badge {{ $child->status ? 'bg-success' : 'bg-secondary' }} rounded-pill" style="font-size: 0.7rem;">
                            {{ $child->status ? 'Hiển thị' : 'Ẩn' }}
                        </span>
                    </td>
                    <td class="text-end pe-4">
                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-light border"><i data-lucide="edit-2" size="14"></i></a>
                            <form action="{{ route('admin.menus.destroy', $child) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border text-danger"><i data-lucide="trash-2" size="14"></i></button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
                @empty
                <tr>
                    <td colspan="5" class="text-center py-5 text-muted">Chưa có menu nào được tạo.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
