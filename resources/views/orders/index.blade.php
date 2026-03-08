@extends('layouts.admin')

@section('content')
<h1 class="page-title">Lịch sử đơn hàng</h1>

<div class="card">
    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
        <h4 class="card-title">Danh sách đơn hàng</h4>
        <div style="font-size: 13px; color: var(--text-secondary);">Tổng cộng: {{ $orders->total() }} đơn hàng</div>
    </div>
    
    <div style="overflow-x: auto;">
        <table style="width: 100%; border-collapse: collapse; margin-top: 10px;">
            <thead>
                <tr style="text-align: left; background: #f8f9fa; border-bottom: 1px solid #eef2f7;">
                    <th style="padding: 15px; font-size: 13px; font-weight: 700; color: #6c757d;">MÃ ĐƠN HÀNG</th>
                    <th style="padding: 15px; font-size: 13px; font-weight: 700; color: #6c757d;">NGÀY ĐẶT</th>
                    <th style="padding: 15px; font-size: 13px; font-weight: 700; color: #6c757d;">TỔNG TIỀN</th>
                    <th style="padding: 15px; font-size: 13px; font-weight: 700; color: #6c757d;">THANH TOÁN</th>
                    <th style="padding: 15px; font-size: 13px; font-weight: 700; color: #6c757d;">TRẠNG THÁI</th>
                    <th style="padding: 15px; font-size: 13px; font-weight: 700; color: #6c757d;">THAO TÁC</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                <tr style="border-bottom: 1px solid #eef2f7; transition: background 0.2s;" onmouseover="this.style.background='#fcfdfe'" onmouseout="this.style.background='transparent'">
                    <td style="padding: 15px; font-weight: 600;">#{{ $order->order_number }}</td>
                    <td style="padding: 15px; font-size: 14px; color: var(--text-secondary);">{{ $order->created_at->format('d/m/Y H:i') }}</td>
                    <td style="padding: 15px; font-weight: 700; color: var(--text-primary);">{{ number_format($order->total_amount) }}đ</td>
                    <td style="padding: 15px; font-size: 14px;">{{ $order->payment_method ?? 'N/A' }}</td>
                    <td style="padding: 15px;">
                        @php
                            $statusColor = match($order->status) {
                                'completed' => ['#0acf97', 'rgba(10, 207, 151, 0.1)'],
                                'pending' => ['#ffbc00', 'rgba(255, 188, 0, 0.1)'],
                                'processing' => ['#3e8ef7', 'rgba(62, 142, 247, 0.1)'],
                                'cancelled' => ['#fa5c7c', 'rgba(250, 92, 124, 0.1)'],
                                default => ['#6c757d', 'rgba(108, 117, 125, 0.1)']
                            };
                        @endphp
                        <span style="padding: 4px 10px; background: {{ $statusColor[1] }}; color: {{ $statusColor[0] }}; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase;">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td style="padding: 15px;">
                        <button style="background: none; border: none; color: var(--accent-color); cursor: pointer; font-size: 14px; font-weight: 600;">Chi tiết</button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="padding: 40px; text-align: center; color: var(--text-secondary);">
                        <i data-lucide="shopping-bag" size="40" style="margin-bottom: 10px; opacity: 0.3;"></i>
                        <p>Bạn chưa có đơn hàng nào.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div style="margin-top: 20px;">
        {{ $orders->links() }}
    </div>
</div>
@endsection
