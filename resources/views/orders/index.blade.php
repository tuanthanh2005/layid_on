@extends('layouts.app')

@section('content')
<div class="orders-section pb-5" style="padding-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="mb-4">
                <h1 class="fw-bold mb-0" style="font-size: 1.8rem; color: var(--text-primary);"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i> Lich su don hang</h1>
            </div>

            <div class="tab-content" id="orderTabsContent">
                <div class="tab-pane fade show active" id="ai-orders" role="tabpanel">
                    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-muted fw-bold small">MA DON HANG</th>
                                            <th class="py-3 text-muted fw-bold small">NGAY DAT</th>
                                            <th class="py-3 text-muted fw-bold small">TONG TIEN</th>
                                            <th class="py-3 text-muted fw-bold small">TRANG THAI</th>
                                            <th class="pe-4 py-3 text-center text-muted fw-bold small">THAO TAC</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($orders as $order)
                                        <tr>
                                            <td class="ps-4 fw-bold text-primary">#{{ $order->order_number }}</td>
                                            <td class="text-muted small">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                            <td class="fw-bold">{{ number_format($order->total_amount) }}d</td>
                                            <td>
                                                @php
                                                    $statusLabel = match($order->status) {
                                                        'completed' => ['Thanh cong', 'bg-success'],
                                                        'pending' => ['Dang cho', 'bg-warning'],
                                                        'processing' => ['Dang xu ly', 'bg-info'],
                                                        'cancelled' => ['Da huy', 'bg-danger'],
                                                        default => [$order->status, 'bg-secondary']
                                                    };
                                                @endphp
                                                <span class="badge {{ $statusLabel[1] }} rounded-pill px-3 py-1" style="font-size: 0.7rem;">
                                                    {{ $statusLabel[0] }}
                                                </span>
                                            </td>
                                            <td class="pe-4 text-center">
                                                <a href="{{ route('orders.show', $order->id) }}" class="btn btn-light btn-sm rounded-pill px-3 border shadow-sm">Chi tiet</a>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5">
                                                <div class="py-4 opacity-50">
                                                    <i class="fa-solid fa-box-open fa-3x mb-3 text-muted"></i>
                                                    <p>Chua co don hang tai khoan AI.</p>
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
                    <div class="mt-4 d-flex justify-content-center">
                        {{ $orders->links() }}
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
