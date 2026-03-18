@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="page-title mb-0">Quản lý Đơn hàng Buff (Social)</h2>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light text-secondary">
                    <tr>
                        <th class="ps-4 py-3">Mã đơn</th>
                        <th class="py-3">Khách hàng</th>
                        <th class="py-3">Dịch vụ / Server</th>
                        <th class="py-3">Link / Số lượng</th>
                        <th class="py-3">Tổng tiền</th>
                        <th class="py-3">Trạng thái</th>
                        <th class="text-end pe-4 py-3">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-4">
                            <span class="fw-bold">#SB{{ $order->id }}</span>
                            <div class="small text-muted">{{ $order->created_at->format('d/m/Y H:i') }}</div>
                        </td>
                        <td>
                            <div class="fw-bold">{{ $order->user->name ?? 'Khách vãng lai' }}</div>
                            <div class="small text-muted">{{ $order->user->email ?? '' }}</div>
                        </td>
                        <td>
                            <div class="mb-1">
                                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                                    <i class="{{ $order->server->service->icon }} me-1"></i> {{ $order->server->service->name }}
                                </span>
                            </div>
                            <div class="small fw-bold text-dark">{{ $order->server->name }}</div>
                        </td>
                        <td>
                            <div class="text-truncate small" style="max-width: 150px;">
                                <a href="{{ $order->link }}" target="_blank" class="text-decoration-none"><i class="fa-solid fa-link me-1"></i> {{ $order->link }}</a>
                            </div>
                            <div class="fw-bold text-primary">SL: {{ number_format($order->quantity) }}</div>
                        </td>
                        <td>
                            <span class="text-danger fw-bold">{{ number_format($order->total_price) }}đ</span>
                            <div class="small">
                                @if($order->payment_status == 'paid')
                                    <span class="text-success"><i class="fa-solid fa-circle-check"></i> Đã thanh toán</span>
                                @else
                                    <span class="text-warning"><i class="fa-solid fa-clock"></i> Chưa thanh toán</span>
                                @endif
                            </div>
                        </td>
                        <td>
                            <form action="{{ route('admin.social-orders.update', $order->id) }}" method="POST" class="d-flex gap-2 align-items-center">
                                @csrf
                                @method('PUT')
                                <select name="status" class="form-select form-select-sm" style="width: 130px;" onchange="this.form.submit()">
                                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ xử lý</option>
                                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang chạy</option>
                                    <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                </select>
                                <input type="hidden" name="payment_status" value="{{ $order->payment_status }}">
                            </form>
                        </td>
                        <td class="text-end pe-4">
                            <div class="d-flex justify-content-end gap-2">
                                <form action="{{ route('admin.social-orders.destroy', $order->id) }}" method="POST" onsubmit="return confirm('Xóa đơn hàng này?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger btn-icon">
                                        <i data-lucide="trash-2" size="14"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-muted">Chưa có đơn hàng nào.</div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4">
            {{ $orders->links() }}
        </div>
    </div>
</div>
@endsection
