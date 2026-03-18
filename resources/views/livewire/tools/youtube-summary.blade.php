<div class="container py-5">
    <!-- Thêm thư viện Marked cho tóm tắt -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="tool-header text-center mb-5 animate-slide-up">
                <div class="icon-wrap bg-danger-subtle text-danger rounded-circle d-inline-flex mb-3 shadow-sm" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                    <i class="fa-brands fa-youtube fa-3x"></i>
                </div>
                <h1 class="fw-bold mb-2">Tóm tắt YouTube bằng AI</h1>
                <p class="text-muted fs-5">Tiết kiệm thời gian bằng cách tóm tắt nội dung video cực nhanh.</p>
            </div>

            <!-- Input Card -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden mb-5">
                <div class="card-body p-4 p-md-5">
                    @if(!$showManualInput)
                    <div class="row g-3 align-items-end">
                        <div class="col-md-9">
                            <label class="form-label fw-bold small text-uppercase text-muted mb-2 tracking-wider">Dán đường dẫn Video Youtube</label>
                            <div class="input-group input-group-lg shadow-sm">
                                <span class="input-group-text bg-white border-end-0 text-danger"><i class="fa-brands fa-youtube"></i></span>
                                <input type="text" wire:model="url" class="form-control border-start-0 shadow-none" placeholder="https://www.youtube.com/watch?v=...">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button wire:click="summarize" class="btn btn-danger btn-lg w-100 fw-bold py-3 shadow-sm hover-up d-flex align-items-center justify-content-center gap-2" wire:loading.attr="disabled">
                                <span wire:loading wire:target="summarize" class="spinner-border spinner-border-sm"></span>
                                <i wire:loading.remove wire:target="summarize" class="fa-solid fa-wand-magic-sparkles"></i> 
                                <span wire:loading.remove wire:target="summarize">Tóm tắt ngay</span>
                                <span wire:loading wire:target="summarize">Đang xử lý...</span>
                            </button>
                        </div>
                    </div>
                    @else
                    <div class="manual-input-area border-start border-4 border-warning bg-light p-4 rounded-3 shadow-sm">
                        <div class="d-flex align-items-center gap-2 mb-3 text-warning">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                            <h6 class="mb-0 fw-bold">Tính năng lấy phụ đề tự động bị giới hạn</h6>
                        </div>
                        <p class="small text-muted mb-4">Vui lòng dán văn bản (Transcript) video vào ô dưới để AI tóm tắt chính xác nhé!</p>
                        
                        <div class="mb-3">
                            <textarea wire:model="manualTranscript" rows="8" class="form-control border-0 shadow-sm" placeholder="Dán nội dung bản ghi tại đây..."></textarea>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button wire:click="summarize" class="btn btn-success btn-lg flex-grow-1 fw-bold shadow-sm" wire:loading.attr="disabled">
                                <i class="fa-solid fa-robot me-2"></i> AI Tóm tắt nội dung
                            </button>
                            <button wire:click="$set('showManualInput', false)" class="btn btn-light btn-lg px-4 border">Trở lại</button>
                        </div>
                    </div>
                    @endif

                    @if($error && !$showManualInput)
                        <div class="alert alert-danger border-0 rounded-3 mt-4 d-flex align-items-center gap-2 shadow-sm">
                            <i class="fa-solid fa-circle-exclamation text-danger"></i>
                            <div>{{ $error }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Result Section -->
            @if($summary || $loading)
            <div class="result-section">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-header bg-white py-3 px-4 border-bottom-0 d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 fw-bold d-flex align-items-center gap-2 text-dark">
                            <i class="fa-solid fa-file-lines text-danger"></i> Kết quả phân tích
                        </h5>
                        @if($summary)
                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" onclick="copyResult()">
                            <i class="fa-solid fa-copy me-1"></i> Sao chép
                        </button>
                        @endif
                    </div>
                    <div class="card-body p-4 p-md-5 pt-0">
                        <div wire:loading wire:target="summarize" class="text-center py-5">
                             <div class="spinner-grow text-danger mb-3" style="width: 3rem; height: 3rem;"></div>
                             <p class="text-muted">Đang tóm tắt, vui lòng đợi trong giây lát...</p>
                        </div>
                        
                        @if($summary)
                        <div wire:loading.remove wire:target="summarize" id="summary-render" class="summary-body p-4 rounded-4">
                            <!-- Javascript rendered content -->
                            {!! nl2br(e($summary)) !!}
                        </div>
                        <div id="summary-raw" class="d-none">{{ $summary }}</div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
    
    <style>
        .hover-up:hover { transform: translateY(-3px); box-shadow: 0 10px 20px rgba(0,0,0,0.1) !important; transition: all 0.3s; }
        .bg-primary-thin { background-color: rgba(13, 110, 253, 0.05); }
        
        .summary-body {
            background-color: #f8fafc;
            line-height: 1.8;
            font-size: 1.05rem;
            color: #1e293b;
        }

        .summary-body h1, .summary-body h2, .summary-body h3 { color: #0f172a; margin-top: 1.5rem; font-weight: 700; margin-bottom: 1rem; }
        .summary-body ul { margin-bottom: 1rem; padding-left: 1.2rem; }
        .summary-body strong { color: #dc2626; }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('resultUpdated', () => {
                renderSummary();
            });
        });

        function renderSummary() {
            const raw = document.getElementById('summary-raw');
            const target = document.getElementById('summary-render');
            if (raw && target) {
                target.innerHTML = marked.parse(raw.textContent);
            }
        }

        function copyResult() {
            const raw = document.getElementById('summary-raw');
            if (raw) {
                navigator.clipboard.writeText(raw.textContent).then(() => alert('Đã sao chép!'));
            }
        }

        window.addEventListener('load', () => renderSummary());
    </script>
</div>
