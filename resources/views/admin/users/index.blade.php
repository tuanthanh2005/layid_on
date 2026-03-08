@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="page-title mb-0">Quản lý khách hàng</h1>
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
        <i data-lucide="user-plus" size="18"></i> Thêm thành viên
    </a>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white border-bottom py-3">
        <form action="{{ route('admin.users.index') }}" method="GET" class="row g-3">
            <div class="col-md-4">
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i data-lucide="search" size="16"></i></span>
                    <input type="text" name="search" class="form-control bg-light border-start-0" placeholder="Tìm tên, email, số điện thoại..." value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-light border w-100">Tìm kiếm</button>
            </div>
        </form>
    </div>
    
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-4">Thành viên</th>
                    <th>Số điện thoại</th>
                    <th>Vai trò</th>
                    <th>Trạng thái</th>
                    <th>Ngày tham gia</th>
                    <th class="text-end pe-4">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                <tr>
                    <td class="ps-4">
                        <div class="d-flex align-items-center">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random" class="rounded-circle me-3" width="40" height="40">
                            <div>
                                <div class="fw-bold">{{ $user->name }}</div>
                                <div class="text-muted small">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>{{ $user->phone ?? '---' }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-info' }} bg-opacity-10 {{ $user->role === 'admin' ? 'text-danger' : 'text-info' }} px-3">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $user->status ? 'bg-success' : 'bg-secondary' }} rounded-pill">
                            {{ $user->status ? 'Hoạt động' : 'Khóa' }}
                        </span>
                    </td>
                    <td class="text-muted small">{{ $user->created_at->format('d/m/Y') }}</td>
                    <td class="text-end pe-4">
                        <div class="dropdown">
                            <button class="btn btn-light btn-sm border" type="button" data-bs-toggle="dropdown">
                                <i data-lucide="more-horizontal" size="16"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0">
                                <li><a class="dropdown-item" href="{{ route('admin.users.show', $user) }}"><i data-lucide="eye" size="14" class="me-2 text-primary"></i> Chi tiết</a></li>
                                <li><a class="dropdown-item" href="{{ route('admin.users.edit', $user) }}"><i data-lucide="edit" size="14" class="me-2 text-info"></i> Chỉnh sửa</a></li>
                                <li>
                                    <form action="{{ route('admin.users.reset_password', $user) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item" onclick="return confirm('Bạn có chắc muốn đặt lại mật khẩu của người này về 123456?')">
                                            <i data-lucide="key" size="14" class="me-2 text-warning"></i> Reset Pass
                                        </button>
                                    </form>
                                </li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item text-danger" onclick="return confirm('Xóa thành viên này sẽ không thể khôi phục. Bạn chắc chắn chứ?')">
                                            <i data-lucide="trash-2" size="14" class="me-2"></i> Xóa
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-5 text-muted">Không tìm thấy khách hàng nào.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="card-footer bg-white border-top py-3">
        {{ $users->links() }}
    </div>
</div>
@endsection
