@extends('layouts.app')

@section('content')
<div class="orders-section pb-5" style="padding-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0" style="font-size: 1.8rem; color: var(--text-primary);"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i> Lịch sử đơn hàng</h1>
                <div class="text-muted small">Tổng cộng: <strong>{{ $orders->total() }}</strong> đơn hàng</div>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="ps-4 py-3 text-muted fw-bold" style="font-size: 0.85rem; width: 140px;">MÃ ĐƠN HÀNG</th>
                                    <th class="py-3 text-muted fw-bold" style="font-size: 0.85rem;">NGÀY ĐẶT</th>
                                    <th class="py-3 text-muted fw-bold" style="font-size: 0.85rem;">TỔNG TIỀN</th>
                                    <th class="py-3 text-muted fw-bold" style="font-size: 0.85rem;">TRẠNG THÁI</th>
                                    <th class="py-3 text-muted fw-bold" style="font-size: 0.85rem;">CHI TIẾT</th>
                                    <th class="pe-4 py-3 text-center text-muted fw-bold" style="font-size: 0.85rem;">THAO TÁC</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($orders as $order)
                                <tr>
                                    <td class="ps-4 fw-bold text-primary">#{{ $order->order_number }}</td>
                                    <td class="text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                    <td class="fw-bold">{{ number_format($order->total_amount) }}đ</td>
                                    <td>
                                        @php
                                            $statusLabel = match($order->status) {
                                                'completed' => ['Thành công', 'bg-success'],
                                                'pending' => ['Đang chờ', 'bg-warning'],
                                                'processing' => ['Đang xử lý', 'bg-info'],
                                                'cancelled' => ['Đã hủy', 'bg-danger'],
                                                default => [$order->status, 'bg-secondary']
                                            };
                                        @endphp
                                        <span class="badge {{ $statusLabel[1] }} rounded-pill px-3 py-2" style="font-size: 0.75rem;">
                                            {{ $statusLabel[0] }}
                                        </span>
                                    </td>
                                    <td class="small text-muted" style="max-width: 250px;">
                                        <div class="text-truncate">{{ $order->notes }}</div>
                                    </td>
                                    <td class="pe-4 text-center">
                                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-light btn-sm rounded-pill px-3 border" style="font-size: 0.8rem;">Xem chi tiết</a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-5">
                                        <div class="py-4">
                                            <i class="fa-solid fa-box-open fa-3x text-muted opacity-25 mb-3"></i>
                                            <p class="text-muted">Bạn chưa có đơn hàng nào.</p>
                                            <a href="/" class="btn btn-primary rounded-pill px-4">Mua sắm ngay</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="mt-4 d-flex justify-content-center">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
