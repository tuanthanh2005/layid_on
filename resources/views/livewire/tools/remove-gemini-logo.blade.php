<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <!-- Header Section -->
            <div class="text-center mb-5">
                <div class="d-inline-flex align-items-center justify-content-center p-3 rounded-circle mb-3"
                     style="background: linear-gradient(135deg, #1d4ed8, #7e22ce); box-shadow: 0 10px 30px rgba(29, 78, 216, 0.3);">
                    <i class="fa-solid fa-wand-magic-sparkles text-white fs-2"></i>
                </div>
                <h1 class="fw-bold display-5 mb-3" style="background: linear-gradient(to right, #1d4ed8, #7e22ce); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Xóa Logo Gemini AI</h1>
                <p class="text-muted fs-5 mx-auto" style="max-width: 600px;">Công cụ chuyên dụng giúp khôi phục hình ảnh từ Gemini về trạng thái nguyên bản, loại bỏ các dấu ấn nhận diện một cách tự nhiên và sạch sẽ nhất.</p>
                <div class="d-inline-flex align-items-center gap-2 mt-2 px-3 py-1 rounded-pill" style="background:#f0fdf4; border:1px solid #bbf7d0;">
                    <i class="fa-solid fa-circle-check text-success"></i>
                    <span class="small text-success fw-semibold">Miễn phí • Tốc độ cao • Chất lượng nguyên bản</span>
                </div>
            </div>

            <!-- Tool Container -->
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden"
                 style="background: rgba(255, 255, 255, 0.92); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.3) !important;">
                <div class="card-body p-4 p-md-5">

                    <!-- Error Display -->
                    @if($errorMessage)
                    <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                        <div>{{ $errorMessage }}</div>
                    </div>
                    @endif

                    @error('image')
                    <div class="alert alert-danger border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-3">
                        <i class="fa-solid fa-triangle-exclamation fs-4"></i>
                        <div>{{ $message }}</div>
                    </div>
                    @enderror

                    @if (!$image && !$processed)
                    <!-- Upload Area -->
                    <div class="upload-zone py-5 border-dashed rounded-4 text-center"
                         onclick="document.getElementById('imageInput').click()"
                         style="border: 2px dashed #cbd5e1; cursor: pointer; transition: all 0.3s ease;"
                         onmouseover="this.style.borderColor='#7e22ce'; this.style.background='rgba(126,34,206,0.04)';"
                         onmouseout="this.style.borderColor='#cbd5e1'; this.style.background='transparent';">

                        <input type="file" id="imageInput" wire:model="image" class="d-none" accept="image/*">

                        <div wire:loading.remove wire:target="image">
                            <i class="fa-solid fa-cloud-arrow-up display-2 mb-4 text-primary opacity-25"></i>
                            <h3 class="fw-bold h4">Tải ảnh Gemini lên để xử lý</h3>
                            <p class="text-muted small mb-1">Hỗ trợ JPG, PNG, WEBP (Tối đa 10MB)</p>
                            <p class="text-muted" style="font-size:0.75rem;">Hoặc kéo và thả hình ảnh vào đây</p>
                        </div>

                        <!-- Uploading State -->
                        <div wire:loading wire:target="image" class="py-4">
                            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"></div>
                            <p class="mt-3 text-primary fw-bold">Đang tải tệp lên...</p>
                        </div>
                    </div>
                    @endif

                    @if ($image && !$processed)
                    <!-- Preview and Action -->
                    <div class="preview-area text-center">
                        <div class="position-relative d-inline-block rounded-4 overflow-hidden border shadow-sm mb-4" style="max-width: 100%;">
                            <img src="{{ $previewUrl ?? $image->temporaryUrl() }}" class="img-fluid" style="max-height: 500px;">

                            <!-- Processing overlay — luôn trong DOM, wire:loading tự show/hide -->
                            <div id="gemini-processing-overlay"
                                 wire:loading wire:target="process"
                                 class="position-absolute top-0 start-0 w-100 h-100 d-flex flex-column align-items-center justify-content-center"
                                 style="display:none!important; background: rgba(0,0,0,0.65); backdrop-filter: blur(4px);">
                                <div class="spinner-grow text-white" style="width: 3.5rem; height: 3.5rem;" role="status"></div>
                                <h4 class="text-white fw-bold mt-3">Đang xử lý...</h4>
                                <p class="text-white-50 small mb-2">Đang phân tích cấu trúc hình ảnh</p>
                                <div class="px-3 py-1 rounded-pill d-inline-flex align-items-center gap-2"
                                     style="background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3);">
                                    <i class="fa-regular fa-clock text-white-50"></i>
                                    <span id="elapsed-timer"
                                          class="text-white fw-bold"
                                          style="font-variant-numeric: tabular-nums; font-size: 1.05rem; min-width: 54px;">0.0s</span>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center gap-3">
                            <button wire:click="resetTool"
                                    wire:loading.attr="disabled"
                                    wire:target="process"
                                    class="btn btn-light rounded-pill px-4">
                                <i class="fa-solid fa-rotate me-2"></i> Chọn ảnh khác
                            </button>
                            <button id="btn-process"
                                    wire:click="process"
                                    wire:loading.attr="disabled"
                                    wire:target="process"
                                    onclick="geminiStartTimer()"
                                    class="btn btn-primary rounded-pill px-5 py-2 shadow-sm">
                                <span wire:loading.remove wire:target="process">
                                    <i class="fa-solid fa-sparkles me-2"></i>Bắt đầu xử lý
                                </span>
                                <span wire:loading wire:target="process">
                                    <span class="spinner-border spinner-border-sm me-2" role="status"></span>Đang xử lý...
                                </span>
                            </button>
                        </div>
                    </div>
                    @endif

                    @if ($processed)
                    <!-- Result Area -->
                    <div class="result-area">
                        <div class="alert alert-success border-0 rounded-4 shadow-sm mb-4 d-flex align-items-center gap-3">
                            <i class="fa-solid fa-circle-check fs-2"></i>
                            <div>
                                <h5 class="fw-bold mb-0">Xử lý thành công!</h5>
                                <p class="mb-0 small opacity-75">Dấu bản quyền đã được loại bỏ hoàn toàn khỏi hình ảnh.</p>
                            </div>
                        </div>

                        <div class="row g-4 align-items-center">
                            <div class="col-md-7 text-center">
                                <div class="rounded-4 overflow-hidden border shadow-sm">
                                    <img src="{{ $processedImageUrl ?? $previewUrl ?? $image->temporaryUrl() }}" class="img-fluid" style="background: white;">
                                </div>
                            </div>
                            <div class="col-md-5">
                                <h4 class="fw-bold mb-4">Hoàn thành</h4>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Phương thức xử lý:</span>
                                        <span class="small fw-bold text-primary">Tái cấu trúc Lossless</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Chất lượng:</span>
                                        <span class="small fw-bold text-success">Gốc 100%</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Bảo mật dữ liệu:</span>
                                        <span class="small fw-bold text-success">Xử lý khép kín ✓</span>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="small text-muted">Dung lượng:</span>
                                        <span class="small fw-bold">~{{ number_format($image->getSize() / 1024, 0) }} KB</span>
                                    </div>
                                </div>

                                <div class="d-grid gap-3">
                                    <a href="{{ $processedImageUrl }}" target="_blank" download="restored_image.png" class="btn btn-success rounded-pill py-3 fw-bold shadow-sm">
                                        <i class="fa-solid fa-download me-2"></i> Tải ảnh xuống máy
                                    </a>
                                    <button wire:click="resetTool" class="btn btn-outline-secondary rounded-pill py-2">
                                        <i class="fa-solid fa-plus me-2"></i> Tiếp tục với ảnh khác
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            <!-- Features Info -->
            <div class="row mt-5 pt-4">
                <div class="col-md-4 mb-4">
                    <div class="p-4 rounded-4 h-100 bg-white shadow-sm transition-hover">
                        <i class="fa-solid fa-wand-magic-sparkles text-primary fs-3 mb-3"></i>
                        <h5 class="fw-bold">Khôi phục Lossless</h5>
                        <p class="text-muted small">Công nghệ tái cấu trúc điểm ảnh giúp giữ nguyên 100% chất lượng hình ảnh gốc mà không để lại bất kỳ dấu vết can thiệp nào.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 rounded-4 h-100 bg-white shadow-sm transition-hover">
                        <i class="fa-solid fa-bolt text-warning fs-3 mb-3"></i>
                        <h5 class="fw-bold">Xử lý siêu tốc</h5>
                        <p class="text-muted small">Toàn bộ quá trình phân tích và xử lý hình ảnh được thực hiện với hiệu suất cực cao, giúp bạn nhận kết quả ngay lập tức.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="p-4 rounded-4 h-100 bg-white shadow-sm transition-hover">
                        <i class="fa-solid fa-shield-halved text-success fs-3 mb-3"></i>
                        <h5 class="fw-bold">An toàn & Riêng tư</h5>
                        <p class="text-muted small">Dữ liệu của bạn được xử lý khép kín hoàn toàn. Mọi tệp tin tạm thời sẽ bị xóa sạch khỏi hệ thống ngay sau khi bạn hoàn tất.</p>
                    </div>
                </div>
            </div>
            </div>
            
            <!-- Admin Tool Section (Chỉ hiện cho Admin thực thụ) -->
            @if(auth()->check() && (optional(auth()->user())->is_admin || optional(auth()->user())->role == 'admin' || auth()->id() == 1))
                <div class="mt-5 pt-5 border-top">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="small text-muted">
                            <i class="fa-solid fa-screwdriver-wrench me-1"></i>
                            Quản trị hệ thống: Tự động dọn dẹp tệp rác.
                        </div>
                        <button wire:click="clearAllTempFiles" 
                                wire:loading.attr="disabled"
                                class="btn btn-sm btn-outline-danger rounded-pill px-3">
                            <span wire:loading.remove wire:target="clearAllTempFiles">
                                <i class="fa-solid fa-trash-can me-1"></i> Dọn dẹp tệp rác (All)
                            </span>
                            <span wire:loading wire:target="clearAllTempFiles">
                                <span class="spinner-border spinner-border-sm" role="status"></span> Đang dọn...
                            </span>
                        </button>
                    </div>
                    @if (session()->has('successTool'))
                        <div class="alert alert-success mt-3 rounded-4 py-2 small shadow-sm">
                            <i class="fa-solid fa-check-circle me-1"></i> {{ session('successTool') }}
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .transition-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .transition-hover:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 45px rgba(0,0,0,0.1) !important;
    }
</style>

<script>
// ── Gemini Watermark Timer ─────────────────────────────────────────────────
let _geminiTimerInterval = null;
let _geminiStartTime     = null;

function geminiStartTimer() {
    // Reset về 0 ngay lập tức
    _geminiStartTime = performance.now();
    const el = document.getElementById('elapsed-timer');
    if (el) el.textContent = '0.0s';

    // Dừng interval cũ nếu còn
    if (_geminiTimerInterval) clearInterval(_geminiTimerInterval);

    // Cập nhật mỗi 100ms
    _geminiTimerInterval = setInterval(function () {
        const el = document.getElementById('elapsed-timer');
        if (!el) return;
        const secs = (performance.now() - _geminiStartTime) / 1000;
        el.textContent = secs.toFixed(1) + 's';
    }, 100);
}

function geminiStopTimer() {
    if (_geminiTimerInterval) {
        clearInterval(_geminiTimerInterval);
        _geminiTimerInterval = null;
    }
}

// Dừng timer khi Livewire render xong (processing kết thúc)
document.addEventListener('livewire:init', function () {
    Livewire.on('livewire:update', () => geminiStopTimer());

    // Hook vào lifecycle commit để bắt thời điểm server trả về
    Livewire.hook('commit', ({ component, commit, succeed, fail }) => {
        const calls = commit.calls ?? [];
        if (calls.some(c => c.method === 'process')) {
            succeed(() => geminiStopTimer());
            fail(()    => geminiStopTimer());
        }
    });
});
</script>
