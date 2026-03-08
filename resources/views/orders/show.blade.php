@extends('layouts.app')

@section('content')
<div class="order-detail-section pb-5" style="padding-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="fw-bold mb-0" style="font-size: 1.8rem; color: var(--text-primary);">
                    <i class="fa-solid fa-file-invoice me-2 text-primary"></i> Đơn hàng #{{ $order->order_number }}
                </h1>
                <a href="{{ route('orders.index') }}" class="btn btn-outline-secondary btn-sm rounded-pill px-3">
                    <i class="fa-solid fa-arrow-left me-1"></i> Quay lại
                </a>
            </div>

            <div class="card border-0 shadow-sm rounded-4 overflow-hidden mb-4">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="fw-bold mb-0">Trạng thái đơn hàng</h5>
                        @php
                            $statusLabel = match($order->status) {
                                'completed' => ['Thành công', 'bg-success'],
                                'pending' => ['Đang chờ', 'bg-warning'],
                                'processing' => ['Đang xử lý', 'bg-info'],
                                'cancelled' => ['Đã hủy', 'bg-danger'],
                                default => [$order->status, 'bg-secondary']
                            };
                        @endphp
                        <span class="badge {{ $statusLabel[1] }} rounded-pill px-4 py-2" style="font-size: 0.85rem;">
                            {{ $statusLabel[0] }}
                        </span>
                    </div>
                </div>
                <div class="card-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="text-muted small d-block mb-1">Mã đơn hàng</label>
                            <span class="fw-bold fs-5 text-primary">#{{ $order->order_number }}</span>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <label class="text-muted small d-block mb-1">Ngày đặt hàng</label>
                            <span class="fw-bold">{{ $order->created_at->format('d/m/Y H:i:s') }}</span>
                        </div>
                        
                        <div class="col-12">
                            <div class="p-3 bg-light rounded-3 border">
                                <label class="text-muted small d-block mb-2 fw-bold">Nội dung đơn hàng:</label>
                                <div style="white-space: pre-wrap; line-height: 1.6;">{{ $order->notes }}</div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="text-muted small d-block mb-1">Phương thức thanh toán</label>
                            <span class="fw-bold"><i class="fa-solid fa-qrcode text-success me-1"></i> {{ $order->payment_method }}</span>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <label class="text-muted small d-block mb-1">Tổng cộng</label>
                            <span class="fw-bold fs-4 text-danger">{{ number_format($order->total_amount) }}đ</span>
                        </div>
                    </div>
                </div>
            </div>

            @if($order->status == 'pending')
            <div class="alert alert-warning border-0 rounded-4 shadow-sm p-4">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-warning">
                        <i class="fa-solid fa-circle-exclamation"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Đơn hàng đang chờ xử lý</h5>
                        <p class="mb-0 text-muted">Nếu bạn đã chuyển khoản, vui lòng chờ 5-10 phút để hệ thống kiểm tra và xác nhận. Nếu quá thời gian trên chưa thấy thay đổi, vui lòng liên hệ Admin qua WhatsApp hoặc Fanpage.</p>
                    </div>
                </div>
            </div>
            @elseif($order->status == 'completed')
            <div class="alert alert-success border-0 rounded-4 shadow-sm p-4">
                <div class="d-flex gap-3">
                    <div class="fs-1 text-success">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold">Giao dịch thành công!</h5>
                        <p class="mb-0 text-muted">Cảm ơn bạn đã tin dùng dịch vụ của chúng tôi. Thông tin tài khoản đã được gửi vào Email của bạn. Chúc bạn có những trải nghiệm tuyệt vời!</p>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
