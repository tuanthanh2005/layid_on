<div class="social-buff-container py-5">
    <div class="container">
        <div class="row g-4">
            <!-- Left Side: Form -->
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="service-icon-lg bg-primary-subtle text-primary rounded-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="{{ $service->icon }} fs-4"></i>
                            </div>
                            <div>
                                <h3 class="fw-bold mb-0">{{ $service->name }}</h3>
                                <p class="text-muted small mb-0">Hệ thống buff tương tác tự động, an toàn và bảo mật</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-body p-4">
                        <form wire:submit.prevent="createOrder">
                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-server me-2"></i> 1️⃣ Chọn Server</label>
                                <div class="row g-3">
                                    @foreach($servers as $server)
                                        <div class="col-md-6">
                                            <div class="server-option p-3 border rounded-3 position-relative cursor-pointer transition-all {{ $serverId == $server->id ? 'border-primary bg-primary-subtle' : 'hover-bg-light' }}" 
                                                 wire:click="$set('serverId', {{ $server->id }})">
                                                <div class="d-flex justify-content-between align-items-start mb-2">
                                                    <span class="fw-bold fs-6">{{ $server->name }}</span>
                                                    @if($serverId == $server->id)
                                                        <i class="fa-solid fa-circle-check text-primary"></i>
                                                    @endif
                                                </div>
                                                <div class="text-danger fw-bold mb-1">{{ number_format($server->price_per_unit) }}đ / đơn vị</div>
                                                <div class="text-muted" style="font-size: 0.75rem;">
                                                    <i class="fa-solid fa-circle-info me-1"></i> {{ $server->description }}
                                                </div>
                                                <div class="mt-2 small">
                                                    <span class="badge bg-light text-dark border">Min: {{ number_format($server->min_quantity) }}</span>
                                                    <span class="badge bg-light text-dark border">Max: {{ number_format($server->max_quantity) }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-link me-2"></i> 2️⃣ Nhập Link (Video/Profile/Post)</label>
                                <input type="text" wire:model="link" class="form-control form-control-lg rounded-3" placeholder="https://www.tiktok.com/@user/video/..." required>
                                @error('link') <span class="text-danger small">{{ $message }}</span> @enderror
                                <div class="form-text small">Vui lòng nhập chính xác link cần buff để tránh lỗi hệ thống.</div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold"><i class="fa-solid fa-arrow-up-9-1 me-2"></i> 3️⃣ Số Lượng</label>
                                <div class="input-group input-group-lg">
                                    <input type="number" wire:model.live="quantity" class="form-control rounded-start-3" placeholder="Ví dụ: 1000" required>
                                    <span class="input-group-text bg-light border-start-0 rounded-end-3">Đơn vị</span>
                                </div>
                                @error('quantity') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold text-muted small">📝 Ghi Chú (Tùy Chọn)</label>
                                <textarea wire:model="note" class="form-control rounded-3" rows="2" placeholder="Yêu cầu riêng nếu có..."></textarea>
                            </div>

                            <div class="order-summary p-4 bg-light rounded-4 border">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Giá cơ bản:</span>
                                    <span class="fw-bold">
                                        {{ $serverId ? number_format($servers->find($serverId)->price_per_unit) : 0 }}đ
                                    </span>
                                </div>
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="text-muted">Số lượng:</span>
                                    <span class="fw-bold">{{ number_format($quantity) }}</span>
                                </div>
                                <hr class="my-3 opacity-10">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fs-5 fw-bold">Tổng cộng:</span>
                                    <span class="fs-3 fw-bold text-primary">{{ number_format($totalPrice) }} ₫</span>
                                </div>
                                
                                <button type="submit" class="btn btn-primary btn-lg w-100 py-3 mt-4 rounded-3 fw-bold shadow-sm transition-all hover-scale">
                                    Tạo Đơn Hàng →
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Side: Sidebar Info -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3"><i class="fa-solid fa-shield-check text-success me-2"></i> Cam kết dịch vụ</h5>
                        <ul class="list-unstyled mb-0">
                            <li class="mb-3 d-flex gap-2 small">
                                <i class="fa-solid fa-bolt text-warning mt-1"></i>
                                <span><strong>Tốc độ cực nhanh:</strong> Hệ thống bắt đầu đẩy ngay sau khi thanh toán thành công.</span>
                            </li>
                            <li class="mb-3 d-flex gap-2 small">
                                <i class="fa-solid fa-lock text-primary mt-1"></i>
                                <span><strong>An toàn tuyệt đối:</strong> Không yêu cầu mật khẩu, không vi phạm chính sách MXH.</span>
                            </li>
                            <li class="mb-0 d-flex gap-2 small">
                                <i class="fa-solid fa-headset text-danger mt-1"></i>
                                <span><strong>Hỗ trợ 24/7:</strong> Đội ngũ kỹ thuật luôn sẵn sàng xử lý mọi yêu cầu.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-4 bg-dark text-white overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3 text-warning">Lưu ý quan trọng</h5>
                        <p class="small opacity-75">1. Hãy đảm bảo tài khoản/bài viết ở chế độ <strong>Công khai</strong>.</p>
                        <p class="small opacity-75">2. Tuyệt đối không đổi link bài viết trong quá trình chạy.</p>
                        <p class="small opacity-75 mb-0">3. Liên hệ Admin nếu đơn hàng chưa bắt đầu sau 2h.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Modal -->
    @if($showPaymentModal)
    <div class="modal fade show d-block" style="background: rgba(0,0,0,0.5); backdrop-filter: blur(5px);">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 rounded-4 shadow-lg">
                <div class="modal-body p-0">
                    @if(!$isPaid)
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="fw-bold mb-0">Thanh toán đơn hàng #SB{{ $currentOrder->id }}</h4>
                                <button type="button" class="btn-close" wire:click="$set('showPaymentModal', false)"></button>
                            </div>

                            <div class="row g-4 align-items-center">
                                <div class="col-md-5 text-center">
                                    @php
                                        $order_code = "SB" . $currentOrder->id;
                                        $qr_url = "https://img.vietqr.io/image/mbbank-0783704196-compact2.png?amount={$totalPrice}&addInfo=" . urlencode($order_code);
                                    @endphp
                                    <div class="p-2 bg-white rounded-3 shadow-sm border border-2 border-primary d-inline-block">
                                        <img src="{{ $qr_url }}" alt="VietQR" class="img-fluid" style="max-width: 250px; border-radius: 8px;">
                                    </div>
                                    <div class="mt-3 small text-primary fw-bold animate__animated animate__pulse animate__infinite">
                                        <i class="fa-solid fa-camera"></i> Mở App Ngân hàng quét QR
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="bg-light p-3 rounded-4 mb-4 border border-dashed">
                                        <div class="mb-3">
                                            <label class="text-muted small mb-0 d-block">Ngân hàng</label>
                                            <span class="fw-bold">MB Bank (Ngân hàng Quân đội)</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small mb-0 d-block">Số tài khoản</label>
                                            <span class="fw-bold fs-5 text-primary">0783704196</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small mb-0 d-block">Chủ tài khoản</label>
                                            <span class="fw-bold">TRAN THANH TUAN</span>
                                        </div>
                                        <div class="mb-3">
                                            <label class="text-muted small mb-0 d-block">Số tiền thanh toán</label>
                                            <span class="fw-bold text-danger fs-3">{{ number_format($totalPrice) }}đ</span>
                                        </div>
                                        <div class="mb-0">
                                            <label class="text-muted small mb-0 d-block">Nội dung chuyển khoản</label>
                                            <span class="fw-bold text-uppercase p-2 bg-warning-subtle border border-warning rounded d-inline-block">{{ $order_code }}</span>
                                        </div>
                                    </div>

                                    <button wire:click="confirmPayment" class="btn btn-primary btn-lg w-100 py-3 rounded-3 fw-bold shadow-sm transition-all hover-scale">
                                        Tôi đã thanh toán xong <i class="fa-solid fa-check-double ms-2"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- Success View with Countdown -->
                        <div class="text-center py-5 px-4">
                            <div class="mb-4">
                                <div class="success-icon animate__animated animate__zoomIn bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center mx-auto" style="width: 100px; height: 100px;">
                                    <i class="fa-solid fa-check fs-1"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-2">Thanh toán hoàn tất!</h3>
                            <p class="text-muted">Cảm ơn bạn! Đơn hàng đang được đưa vào hàng đợi xử lý.<br>Vui lòng không tắt trình duyệt.</p>
                            
                            <div class="mt-5" x-init="
                                let count = 5;
                                const timer = setInterval(() => {
                                    count--;
                                    if(document.getElementById('modal-countdown')) {
                                        document.getElementById('modal-countdown').innerText = count;
                                    }
                                    if(count <= 0) {
                                        window.location.reload();
                                        clearInterval(timer);
                                    }
                                }, 1000);
                            ">
                                <p class="small text-muted mb-0">Đang quay lại trang dịch vụ sau <span id="modal-countdown" class="fw-bold text-primary">5</span> giây...</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif

    <style>
        .social-buff-container { background: #f1f5f9; min-height: 100vh; }
        .cursor-pointer { cursor: pointer; }
        .transition-all { transition: all 0.25s ease-in-out; }
        .hover-bg-light:hover { background-color: #f8fafc; border-color: #cbd5e1; }
        .hover-scale:hover { transform: scale(1.02); }
        .server-option { border: 2px solid #e2e8f0; }
        .bg-primary-subtle { background-color: #e0f2fe !important; }
        .form-control-lg { padding: 0.8rem 1.2rem; font-size: 1rem; }
        .form-control:focus { box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1); border-color: #10b981; }
        .btn-primary { background-color: #10b981; border: none; }
        .btn-primary:hover { background-color: #059669; }
        .text-primary { color: #10b981 !important; }
        .border-primary { border-color: #10b981 !important; }
    </style>
</div>
