@extends('layouts.app')

@section('content')
<div class="orders-section pb-5" style="padding-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4">
                <h1 class="fw-bold mb-0" style="font-size: 1.8rem; color: var(--text-primary);"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i> Lịch sử đơn hàng</h1>
            </div>

            <!-- Tabs Navigation -->
            <ul class="nav nav-pills mb-4 bg-white p-2 rounded-4 shadow-sm d-inline-flex border" id="orderTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active px-4 py-2 rounded-3 fw-bold" id="ai-orders-tab" data-bs-toggle="pill" data-bs-target="#ai-orders" type="button" role="tab">
                        <i class="fa-solid fa-robot me-2"></i> Tài khoản AI
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link px-4 py-2 rounded-3 fw-bold" id="social-orders-tab" data-bs-toggle="pill" data-bs-target="#social-orders" type="button" role="tab">
                        <i class="fa-solid fa-fire me-2"></i> Dịch vụ Buff
                    </button>
                </li>
            </ul>

            <div class="tab-content" id="orderTabsContent">
                <!-- AI Account Orders Tab -->
                <div class="tab-pane fade show active" id="ai-orders" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-muted fw-bold small">MÃ ĐƠN HÀNG</th>
                                            <th class="py-3 text-muted fw-bold small">NGÀY ĐẶT</th>
                                            <th class="py-3 text-muted fw-bold small">TỔNG TIỀN</th>
                                            <th class="py-3 text-muted fw-bold small">TRẠNG THÁI</th>
                                            <th class="pe-4 py-3 text-center text-muted fw-bold small">THAO TÁC</th>
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
                                                <span class="badge {{ $statusLabel[1] }} rounded-pill px-3 py-1" style="font-size: 0.7rem;">
                                                    {{ $statusLabel[0] }}
                                                </span>
                                            </td>
                                            <td class="pe-4 text-center">
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-light btn-sm rounded-pill px-3 border shadow-sm">Chi tiết</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="py-4 opacity-50">
                                                    <i class="fa-solid fa-box-open fa-3x mb-3 text-muted"></i>
                                                    <p>Chưa có đơn hàng tài khoản AI.</p>
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
                        {{ $orders->appends(['social_page' => $socialOrders->currentPage()])->links() }}
                    </div>
                </div>

                <!-- Social Buff Orders Tab -->
                <div class="tab-pane fade" id="social-orders" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-muted fw-bold small">MÃ ĐƠN</th>
                                            <th class="py-3 text-muted fw-bold small">DỊCH VỤ / SERVER</th>
                                            <th class="py-3 text-muted fw-bold small">LINK / SỐ LƯỢNG</th>
                                            <th class="py-3 text-muted fw-bold small">TỔNG TIỀN</th>
                                            <th class="py-3 text-muted fw-bold small">TRẠNG THÁI</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($socialOrders as $sOrder)
                                        <tr>
                                            <td class="ps-4 fw-bold text-primary">#SB{{ $sOrder->id }}</td>
                                            <td>
                                                <div class="fw-bold small mb-1">{{ $sOrder->server->service->name }}</div>
                                                <div class="text-muted extra-small">{{ $sOrder->server->name }}</div>
                                            </td>
                                            <td>
                                                <div class="text-truncate extra-small mb-1" style="max-width: 150px;">
                                                    <a href="{{ $sOrder->link }}" target="_blank" class="text-decoration-none"><i class="fa-solid fa-link me-1"></i> Liên kết</a>
                                                </div>
                                                <div class="fw-bold text-primary small">SL: {{ number_format($sOrder->quantity) }}</div>
                                            </td>
                                            <td>
                                                <div class="fw-bold text-danger">{{ number_format($sOrder->total_price) }}đ</div>
                                                <div class="extra-small {{ $sOrder->payment_status == 'paid' ? 'text-success' : 'text-warning' }}">
                                                    {{ $sOrder->payment_status == 'paid' ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                                                </div>
                                            </td>
                                            <td>
                                                @php
                                                    $sStatusLabel = match($sOrder->status) {
                                                        'completed' => ['Hoàn thành', 'bg-success'],
                                                        'pending' => ['Đang chờ', 'bg-warning'],
                                                        'processing' => ['Đang chạy', 'bg-info'],
                                                        'cancelled' => ['Đã hủy', 'bg-danger'],
                                                        default => [$sOrder->status, 'bg-secondary']
                                                    };
                                                @endphp
                                                <span class="badge {{ $sStatusLabel[1] }} rounded-pill px-3 py-1" style="font-size: 0.7rem;">
                                                    {{ $sStatusLabel[0] }}
                                                </span>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="py-4 opacity-50">
                                                    <i class="fa-solid fa-fire fa-3x mb-3 text-muted"></i>
                                                    <p>Chưa có đơn hàng dịch vụ Buff.</p>
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
                        {{ $socialOrders->appends(['orders_page' => $orders->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .extra-small { font-size: 0.75rem; }
    .nav-pills .nav-link { color: var(--text-secondary); }
    .nav-pills .nav-link.active { background-color: var(--accent-primary); color: white; }
    .nav-pills .nav-link:not(.active):hover { background-color: #f8fafc; }
</style>
@endsection
