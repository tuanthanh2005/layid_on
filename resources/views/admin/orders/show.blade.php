@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Chi tiết đơn hàng #{{ $order->order_number }}</h1>
    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary btn-sm">Quay lại danh sách</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Thông tin đơn hàng</h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="text-muted small">Mã đơn hàng</label>
                        <div class="fw-bold fs-5 text-primary">#{{ $order->order_number }}</div>
                    </div>
                    <div class="col-md-6 text-end">
                        <label class="text-muted small">Ngày đặt hàng</label>
                        <div class="fw-bold">{{ $order->created_at->format('d/m/Y H:i:s') }}</div>
                    </div>
                    <div class="col-md-12 border-top pt-3">
                        <label class="text-muted small">Sản phẩm & Ghi chú</label>
                        <div class="p-3 bg-light rounded border mt-1" style="white-space: pre-wrap;">{{ $order->notes }}</div>
                    </div>
                    <div class="col-md-6 border-top pt-3">
                        <label class="text-muted small">Phương thức thanh toán</label>
                        <div class="fw-bold"><i class="fa-solid fa-qrcode text-success"></i> {{ $order->payment_method }}</div>
                    </div>
                    <div class="col-md-6 border-top pt-3 text-end">
                        <label class="text-muted small">Trạng thái hiện tại</label>
                        <div>
                            @php
                                $statusBadge = match($order->status) {
                                    'completed' => 'bg-success',
                                    'pending' => 'bg-warning',
                                    'processing' => 'bg-info',
                                    'cancelled' => 'bg-danger',
                                    default => 'bg-secondary'
                                };
                            @endphp
                            <span class="badge {{ $statusBadge }} rounded-pill px-3 py-2 text-uppercase">{{ $order->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Khách hàng</h5>
            </div>
            <div class="card-body">
                @if($order->user)
                    <div class="d-flex align-items-center mb-3">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 50px; height: 50px; font-size: 1.2rem;">
                            {{ substr($order->user->name, 0, 1) }}
                        </div>
                        <div>
                            <div class="fw-bold">{{ $order->user->name }}</div>
                            <div class="text-muted small">{{ $order->user->email }}</div>
                        </div>
                    </div>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary btn-sm w-100">Xem hồ sơ khách</a>
                @else
                    <div class="alert alert-light border border-dashed mb-0">
                        <i class="fa-solid fa-user-ghost me-2"></i> Khách vãng lai (Giao dịch không đăng nhập)
                    </div>
                @endif
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-header bg-white">
                <h5 class="card-title mb-0">Thanh toán</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Tổng cộng:</span>
                    <span class="fw-bold fs-4 text-danger">{{ number_format($order->total_amount) }}đ</span>
                </div>
                <hr>
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="form-label small">Cập nhật trạng thái:</label>
                    <select name="status" class="form-select mb-3">
                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Chờ thanh toán</option>
                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Đang xử lý</option>
                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                    </select>
                    <button type="submit" class="btn btn-primary w-100 py-2">Lưu thay đổi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
