<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <div class="tool-header text-center mb-5">
                    <div class="tool-icon-circle mx-auto mb-4">
                        <i class="fa-solid fa-shield-halved"></i>
                    </div>
                    <h1 class="fw-bold display-6 mb-2">Trình tạo mã <span class="highlight">2FA Code</span></h1>
                    <p class="text-muted">Nhận mã xác minh 2 bước (TOTP) từ Secret Key của bạn một cách nhanh chóng và an toàn.</p>
                </div>

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden card-2fa">
                    <div class="card-body p-4 p-md-5">
                        <!-- Frame 1: Input Secret -->
                        <div class="mb-4">
                            <label class="form-label fw-bold d-flex justify-content-between mb-2">
                                <span><i class="fa-solid fa-key me-2 text-primary"></i> * 2FA Secret (Mã bảo mật)</span>
                                <small class="text-muted-dark fw-normal">Lấy mã xác minh 2 bước nhanh nhất</small>
                            </label>
                            <textarea 
                                wire:model.defer="secret" 
                                class="form-control form-control-lg form-control-2fa @if($error) is-invalid @endif" 
                                rows="3" 
                                placeholder="Dán mã secret tại đây (hỗ trợ nhiều dòng)..."
                                style="font-family: 'Courier New', Courier, monospace; letter-spacing: 1px;"></textarea>
                            @if($error)
                                <div class="invalid-feedback fw-bold mt-2">
                                    <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ $error }}
                                </div>
                            @endif
                        </div>

                        <!-- Action Button 1 -->
                        <div class="mb-5">
                            <button 
                                wire:click="generateCode" 
                                wire:loading.attr="disabled"
                                class="btn btn-primary btn-lg px-5 py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <span wire:loading.remove>Tạo mã 2FA</span>
                                <span wire:loading class="spinner-border spinner-border-sm"></span>
                                <span wire:loading> Đang xử lý...</span>
                            </button>
                        </div>

                        <hr class="my-5 opacity-25">

                        <!-- Frame 2: Result Code (Hỗ trợ Bulk) -->
                        <div class="mb-4">
                            <label class="form-label fw-bold d-flex justify-content-between mb-2">
                                <span><i class="fa-solid fa-shield-check me-2 text-success"></i> * 2FA Code</span>
                                <small class="text-muted-dark fw-normal">Mã xác minh 2 bước của bạn</small>
                            </label>
                            
                            <div class="results-container form-control-2fa rounded-3 p-3" style="min-height: 120px; overflow-y: auto; max-height: 400px;">
                                @forelse($results as $res)
                                    <div class="d-flex align-items-center justify-content-between p-3 mb-2 rounded-3 bg-dark bg-opacity-25 border">
                                        <div class="text-truncate me-3" style="max-width: 60%; font-size: 0.85rem;">
                                            <span class="text-muted-dark">Đầu vào:</span> {{ $res['input'] }}
                                        </div>
                                        <div class="d-flex align-items-center gap-3">
                                            <span class="fs-4 fw-black text-primary letter-spacing-2">{{ $res['code'] }}</span>
                                            <button 
                                                onclick="copyToClipboard('{{ $res['code'] }}')" 
                                                @if($res['code'] == 'Invalid Secret') disabled @endif
                                                class="btn btn-sm btn-outline-light border-0 px-2 py-1">
                                                <i class="fa-regular fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                @empty
                                    <div class="h-100 d-flex align-items-center justify-content-center text-muted-dark fs-2 fw-black opacity-25">
                                        ------
                                    </div>
                                @endforelse
                            </div>
                        </div>

                        <!-- Action Button 2: Copy All (Hiện khi có nhiều kết quả) -->
                        @if(count($results) > 1)
                        <div>
                            <button 
                                onclick="copyAllCodes()" 
                                class="btn btn-light btn-lg px-5 py-3 fw-bold d-flex align-items-center justify-content-center gap-2 transition-all">
                                <i class="fa-solid fa-clone"></i> Sao chép tất cả mã
                            </button>
                        </div>
                        @else
                        <div>
                            @php $firstCode = $results[0]['code'] ?? ''; @endphp
                            <button 
                                onclick="copyToClipboard('{{ $firstCode }}')" 
                                @if(!$firstCode || $firstCode === 'Invalid Secret') disabled @endif
                                class="btn btn-light btn-lg px-5 py-3 fw-bold d-flex align-items-center justify-content-center gap-2 transition-all">
                                <i class="fa-regular fa-copy"></i> Sao chép mã
                            </button>
                        </div>
                        @endif
                    </div>

                        @if(count($results) == 0 && !$error)
                        <div class="text-center py-4 text-muted small border-top mt-4">
                            <i class="fa-solid fa-lock-open me-1"></i> Dữ liệu được xử lý cục bộ, chúng tôi không lưu trữ Secret Key của bạn.
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Tutorial Section -->
                <div class="mt-5 p-4 rounded-4 bg-white border shadow-sm">
                    <h3 class="fs-5 fw-bold mb-3"><i class="fa-solid fa-circle-question me-2 text-primary"></i> Tại sao bạn cần công cụ này?</h3>
                    <ul class="list-unstyled mb-0">
                        <li class="mb-3 d-flex gap-3">
                            <div class="mt-1 text-primary"><i class="fa-solid fa-circle-check"></i></div>
                            <div><b>Tiết kiệm thời gian:</b> Nhập hàng trăm nick cùng lúc để lấy mã 2FA siêu tốc.</div>
                        </li>
                        <li class="mb-3 d-flex gap-3">
                            <div class="mt-1 text-primary"><i class="fa-solid fa-circle-check"></i></div>
                            <div><b>Định dạng linh hoạt:</b> Hỗ trợ cả <code>Secret</code> lẻ hoặc chuỗi <code>user|pass|secret</code>.</div>
                        </li>
                        <li class="mb-0 d-flex gap-3">
                            <div class="mt-1 text-primary"><i class="fa-solid fa-circle-check"></i></div>
                            <div><b>An toàn Tuyệt đối:</b> Mọi xử lý diễn ra trên Server thông qua thư viện Google2FA chính thống.</div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .fw-black { font-weight: 900; }
    .letter-spacing-2 { letter-spacing: 2px; }
    .tool-header .highlight { color: var(--accent-primary); }
    .tool-icon-circle {
        width: 80px;
        height: 80px;
        background-color: var(--accent-primary);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        box-shadow: 0 10px 20px rgba(16, 185, 129, 0.2);
    }
    
    /* Dark Theme for the frames like the image */
    .card-2fa {
        background-color: #1a1d21;
        color: #ffffff;
    }
    .form-control-2fa {
        background-color: #2a2e34;
        border-color: #3f444d;
        color: #ffffff;
    }
    .form-control-2fa:focus {
        background-color: #2d3239;
        border-color: var(--accent-primary);
        color: #ffffff;
        box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.15);
    }
    .form-control-2fa::placeholder {
        color: #636b7a;
    }
    .text-muted-dark {
        color: #94a3b8 !important;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in {
        animation: fadeIn 0.4s ease-out forwards;
    }

    /* Mobile Fine-tuning */
    @media (max-width: 768px) {
        .py-5 { padding-top: 1rem !important; padding-bottom: 5rem !important; }
        .display-6 { font-size: 1.4rem; }
        .tool-header p { font-size: 0.85rem; }
        .card-body { padding: 1.25rem !important; }
        .tool-icon-circle { width: 50px; height: 50px; font-size: 1.2rem; margin-bottom: 1rem !important; }
        
        .form-label { flex-direction: column !important; align-items: flex-start !important; gap: 2px; }
        .form-label span { font-size: 0.85rem; }
        .form-label small { font-size: 0.75rem !important; margin-bottom: 5px; opacity: 0.7; }
        
        .form-control-2fa { font-size: 0.9rem !important; padding: 12px !important; }
        
        .btn-lg { 
            width: 100%; 
            padding: 12px !important; 
            font-size: 1rem !important;
            border-radius: 10px !important;
        }

        .results-container { 
            min-height: 80px !important; 
            padding: 8px !important;
        }
        
        .results-container .d-flex {
            padding: 10px !important;
            border-radius: 10px !important;
            flex-direction: column;
            align-items: flex-start !important;
            gap: 10px;
        }
        
        .results-container .d-flex .d-flex {
            width: 100%;
            justify-content: space-between !important;
            flex-direction: row !important;
            padding: 0 !important;
        }

        .results-container .fs-4 {
            font-size: 1.2rem !important;
        }
        
        .text-truncate {
            max-width: 100% !important;
            font-size: 0.75rem !important;
        }

        hr.my-5 { margin: 2rem 0 !important; }
    }
</style>

<script>
    function copyToClipboard(text) {
        if (!text || text === 'Invalid Secret') return;
        
        navigator.clipboard.writeText(text).then(() => {
            const btn = event.currentTarget;
            const originalContent = btn.innerHTML;
            
            btn.innerHTML = '<i class="fa-solid fa-check text-success"></i>';
            
            setTimeout(() => {
                btn.innerHTML = originalContent;
            }, 1500);
        });
    }

    function copyAllCodes() {
        // Lấy tất cả mã 2FA thành một chuỗi, mỗi mã 1 dòng
        const codes = Array.from(document.querySelectorAll('.results-container .fs-4'))
                           .map(el => el.innerText.trim())
                           .filter(code => code !== 'Invalid Secret')
                           .join('\n');
        
        if (!codes) return;

        navigator.clipboard.writeText(codes).then(() => {
            const btn = event.currentTarget;
            const originalContent = btn.innerHTML;
            
            btn.innerHTML = '<i class="fa-solid fa-check"></i> Copied All!';
            btn.classList.replace('btn-light', 'btn-success');
            
            setTimeout(() => {
                btn.innerHTML = originalContent;
                btn.classList.replace('btn-success', 'btn-light');
            }, 2000);
        });
    }
</script>
