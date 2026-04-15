<div class="checkout-container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-header bg-white border-bottom-0 pt-4 px-4">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <h2 class="fw-bold mb-0">Thanh toán</h2>
                        <span class="badge bg-primary rounded-pill px-3 py-2">Bước {{ $step }}/3</span>
                    </div>
                    <div class="progress" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: {{ ($step / 3) * 100 }}%">
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    @if($step == 1)
                        <!-- Bước 1: Thông tin khách hàng -->
                        <div class="product-summary mb-4 p-3 bg-light rounded-3 d-flex align-items-center gap-3">
                            <div
                                style="width: 60px; height: 60px; background: #fff; border-radius: 10px; display: flex; align-items: center; justify-content: center; border: 1px solid #eee;">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="" style="max-width: 40px; max-height: 40px;">
                                @else
                                    <i class="fa-solid fa-robot text-primary fa-2x"></i>
                                @endif
                            </div>
                            <div>
                                <h5 class="fw-bold mb-0">{{ $product->name }}</h5>
                                <span class="text-primary fw-bold fs-5">{{ number_format($product->price) }}đ</span>
                            </div>
                        </div>

                        <form wire:submit.prevent="nextStep">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Họ và tên</label>
                                <input type="text" wire:model="name" class="form-control form-control-lg rounded-3"
                                    placeholder="Nguyễn Văn A" required>
                                @error('name') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Địa chỉ Email - Để kích hoạt tài khoản</label>
                                <input type="email" wire:model="email" class="form-control form-control-lg rounded-3"
                                    placeholder="example@gmail.com" required>
                                @error('email') <span class="text-danger small">{{ $message }}</span> @enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-bold">Số điện thoại</label>
                                <input type="text" wire:model="whatsapp" class="form-control form-control-lg rounded-3"
                                    placeholder="0123456789">
                            </div>
                            <button type="submit" class="btn btn-primary btn-lg w-100 py-3 rounded-3 fw-bold shadow-sm">Tiếp
                                tục thanh toán <i class="fa-solid fa-arrow-right ms-2"></i></button>
                        </form>

                    @elseif($step == 2)
                        <!-- Bước 2: Quét mã QR & Thanh toán -->
                        <div class="text-center mb-4">
                            <h4 class="fw-bold mb-1">Chuyển khoản VietQR</h4>
                            <p class="text-muted small">Vui lòng quét mã QR hoặc chuyển khoản thủ công bên dưới</p>
                            <div class="badge bg-light text-primary border px-3 py-2 fs-6">
                                Mã đơn hàng: <strong class="text-danger">{{ $order_code }}</strong>
                            </div>
                        </div>

                        <div class="row align-items-center g-4">
                            <div class="col-md-5 text-center">
                                @php
                                    $qr_url = "https://img.vietqr.io/image/mbbank-0783704196-compact2.png?amount={$product->price}&addInfo=" . urlencode($order_code . " " . Str::slug($name));
                                @endphp
                                <div class="p-2 bg-white rounded-3 shadow-sm border border-2 border-primary d-inline-block">
                                    <img src="{{ $qr_url }}" alt="VietQR" class="img-fluid"
                                        style="max-width: 220px; border-radius: 8px;">
                                </div>
                                <div class="mt-2 small text-primary fw-bold"><i class="fa-solid fa-camera"></i> Mở App Ngân
                                    hàng quét QR</div>
                            </div>

                            <div class="col-md-7">
                                <div class="bg-light p-3 rounded-3 mb-3 border border-dashed">
                                    <div class="mb-2">
                                        <label class="text-muted small mb-0 d-block">Ngân hàng</label>
                                        <span class="fw-bold">MB Bank (Ngân hàng Quân đội)</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="text-muted small mb-0 d-block">Số tài khoản</label>
                                        <span class="fw-bold fs-5 text-primary">0783704196</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="text-muted small mb-0 d-block">Chủ tài khoản</label>
                                        <span class="fw-bold">TRAN THANH TUAN</span>
                                    </div>
                                    <div class="mb-2">
                                        <label class="text-muted small mb-0 d-block">Số tiền</label>
                                        <span class="fw-bold text-danger fs-5">{{ number_format($product->price) }}đ</span>
                                    </div>
                                    <div class="mb-0">
                                        <label class="text-muted small mb-0 d-block">Nội dung chuyển khoản</label>
                                        <span
                                            class="fw-bold text-uppercase p-1 bg-warning-subtle border border-warning rounded px-2">{{ $order_code }}
                                            {{ Str::slug($name) }}</span>
                                    </div>
                                </div>

                                <div class="form-check p-3 bg-light rounded-3 border mb-4">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" wire:model="is_paid"
                                        id="is_paid">
                                    <label class="form-check-label fw-bold cursor-pointer" for="is_paid">
                                        Tôi đã chuyển khoản đúng số tiền và nội dung.
                                    </label>
                                    @error('is_paid') <div class="text-danger small mt-2">{{ $message }}</div> @enderror
                                </div>

                                <button wire:click="confirmPayment"
                                    class="btn btn-primary btn-lg w-100 py-3 rounded-3 fw-bold shadow-sm">Xác nhận Đã thanh
                                    toán <i class="fa-solid fa-check-circle ms-2"></i></button>
                            </div>
                        </div>

                    @elseif($step == 3)
                        <!-- Bước 3: Thành công -->
                        <div class="text-center py-5">
                            <div class="mb-4">
                                <div class="success-icon animate__animated animate__zoomIn"
                                    style="width: 100px; height: 100px; background: #dcfce7; color: #16a34a; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; font-size: 3rem;">
                                    <i class="fa-solid fa-check"></i>
                                </div>
                            </div>
                            <h3 class="fw-bold mb-2">Thanh toán thành công!</h3>
                            <div class="mb-3">
                                <span class="text-muted">Mã đơn hàng:</span> <strong
                                    class="text-primary">{{ $order_code }}</strong>
                            </div>
                            <p class="text-muted">Đơn hàng của bạn đang được hệ thống xử lý.<br>Thông tin tài khoản sẽ được
                                gửi vào Email: <strong>{{ $email }}</strong> sau 5-10 phút.</p>

                            <div class="mt-5" x-init="
                                        let seconds = 5;
                                        const timer = setInterval(() => {
                                            seconds--;
                                            if(document.getElementById('countdown')) {
                                                document.getElementById('countdown').innerText = seconds;
                                            }
                                            if(seconds <= 0) {
                                                window.location.href = '/';
                                                clearInterval(timer);
                                            }
                                        }, 1000);
                                    ">
                                <p class="small text-muted mb-2">Đang chuyển về trang chủ sau <span id="countdown"
                                        class="fw-bold text-primary">5</span> giây...</p>
                                <a href="/" class="btn btn-outline-primary px-4 rounded-pill">Về trang chủ ngay</a>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="card-footer bg-white border-top-0 pb-4 text-center px-4">
                    <p class="small text-muted mb-0"><i class="fa-solid fa-shield-halved text-success"></i> Mọi thông
                        tin thanh toán đều được bảo mật tuyệt đối.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .bg-light {
            background-color: #f8fafc !important;
        }

        .form-control:focus {
            box-shadow: 0 0 0 4px rgba(62, 142, 247, 0.1);
            border-color: #3e8ef7;
        }

        .progress-bar {
            transition: width 0.4s ease;
        }

        .success-icon {
            box-shadow: 0 0 0 10px rgba(22, 163, 74, 0.1);
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale3d(0.3, 0.3, 0.3);
            }

            50% {
                opacity: 1;
            }
        }

        .animate__zoomIn {
            animation: zoomIn 0.5s;
        }
    </style>
</div>