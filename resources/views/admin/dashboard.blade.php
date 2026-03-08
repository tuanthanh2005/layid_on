@extends('layouts.admin')

@section('styles')
<style>
    /* Dashboard Grid */
    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 25px;
        margin-bottom: 30px;
    }

    .stat-card {
        background: #fff;
        padding: 25px;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        position: relative;
        overflow: hidden;
    }

    .stat-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .stat-title {
        color: var(--text-secondary);
        font-size: 13px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-value {
        font-size: 24px;
        font-weight: 700;
        color: var(--text-primary);
    }

    .stat-trend {
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 11px;
        font-weight: 700;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .trend-up { background: rgba(10, 207, 151, 0.1); color: #0acf97; }
    .trend-down { background: rgba(250, 92, 124, 0.1); color: #fa5c7c; }

    .stat-chart-placeholder {
        height: 40px;
        display: flex;
        align-items: flex-end;
        gap: 3px;
    }

    .bar {
        width: 4px;
        background: var(--accent-color);
        border-radius: 2px;
        opacity: 0.3;
        transition: height 0.3s;
    }

    /* Main Chart Section */
    .section-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 25px;
    }

    .card {
        background: #fff;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        padding: 25px;
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .card-title {
        font-size: 15px;
        font-weight: 700;
    }

    /* Visitor Stats Section */
    .visitor-map {
        width: 100%;
        height: 350px;
        background: #f8f9fa url('https://upload.wikimedia.org/wikipedia/commons/e/ec/World_map_blank_without_borders.svg') no-repeat center;
        background-size: contain;
        border-radius: 8px;
        position: relative;
        overflow: hidden;
    }

    .map-dot {
        position: absolute;
        width: 12px;
        height: 12px;
        background: var(--accent-color);
        border-radius: 50%;
        border: 2px solid #fff;
        box-shadow: 0 0 10px rgba(62, 142, 247, 0.5);
    }

    .dot-usa { top: 35%; left: 20%; }
    .dot-europe { top: 30%; left: 50%; }
    .dot-india { top: 50%; left: 70%; }
    .dot-australia { top: 75%; left: 85%; }

    /* Progress Items */
    .progress-list {
        list-style: none;
    }

    .progress-item {
        margin-bottom: 25px;
    }

    .progress-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
        font-size: 13px;
    }

    .progress-label {
        font-weight: 600;
        color: var(--text-secondary);
    }

    .progress-value {
        font-weight: 700;
    }

    .progress-bar-bg {
        height: 4px;
        background: #f1f3fa;
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: var(--accent-color);
        border-radius: 10px;
    }
</style>
@endsection

@section('content')
<h1 class="page-title">Tổng quan hệ thống</h1>

<div class="dashboard-grid">
    <!-- Đơn hàng -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Tổng đơn hàng</p>
                <h3 class="stat-value">{{ number_format($totalOrders) }}</h3>
            </div>
            <div class="stat-icon bg-primary-subtle p-2 rounded">
                <i data-lucide="shopping-bag" class="text-primary"></i>
            </div>
        </div>
        <div class="small text-muted mt-2">Đơn hàng đã đặt</div>
    </div>

    <!-- Đang chờ -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Đơn đang chờ</p>
                <h3 class="stat-value text-warning">{{ number_format($pendingOrders) }}</h3>
            </div>
            <div class="stat-icon bg-warning-subtle p-2 rounded">
                <i data-lucide="clock" class="text-warning"></i>
            </div>
        </div>
        <div class="small text-muted mt-2">Cần xác nhận thanh toán</div>
    </div>

    <!-- Doanh thu -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Doanh thu (Lãi)</p>
                <h3 class="stat-value text-success">{{ number_format($totalRevenue) }}đ</h3>
            </div>
            <div class="stat-icon bg-success-subtle p-2 rounded">
                <i data-lucide="dollar-sign" class="text-success"></i>
            </div>
        </div>
        <div class="small text-muted mt-2">Đơn hàng đã hoàn thành</div>
    </div>

    <!-- Thành viên -->
    <div class="stat-card">
        <div class="stat-header">
            <div>
                <p class="stat-title">Tổng thành viên</p>
                <h3 class="stat-value">{{ number_format($totalUsers) }}</h3>
            </div>
            <div class="stat-icon bg-info-subtle p-2 rounded">
                <i data-lucide="users" class="text-info"></i>
            </div>
        </div>
        <div class="small text-muted mt-2">Khách đăng ký tài khoản</div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Đơn hàng gần đây</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-primary btn-sm rounded-pill px-3">Xem tất cả</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-4 py-3">Mã đơn</th>
                                <th>Khách hàng</th>
                                <th>Sản phẩm & Ghi chú</th>
                                <th>Giá</th>
                                <th>Trạng thái</th>
                                <th class="pe-4 text-center">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentOrders as $order)
                            <tr>
                                <td class="ps-4 fw-bold">#{{ $order->order_number }}</td>
                                <td>
                                    {{ $order->user->name ?? 'Khách vãng lai' }}
                                    <div class="small text-muted">{{ $order->created_at->format('d/m H:i') }}</div>
                                </td>
                                <td>
                                    <div class="text-truncate" style="max-width: 200px;">{{ $order->notes }}</div>
                                </td>
                                <td class="fw-bold">{{ number_format($order->total_amount) }}đ</td>
                                <td>
                                    @php
                                        $badgeClass = match($order->status) {
                                            'completed' => 'bg-success',
                                            'pending' => 'bg-warning',
                                            'processing' => 'bg-info',
                                            'cancelled' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }} rounded-pill">{{ $order->status }}</span>
                                </td>
                                <td class="pe-4 text-center">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary rounded-pill px-3">Chi tiết</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">Chưa có đơn hàng nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
