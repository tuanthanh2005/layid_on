<div class="container py-5">
    <!-- Thêm thư viện Marked để render Markdown cho Blog -->
    <script src="https://cdn.jsdelivr.net/npm/marked/marked.min.js"></script>

    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="tool-header text-center mb-5">
                <div class="icon-wrap bg-primary-subtle text-primary rounded-circle d-inline-flex mb-3 shadow-sm" style="width: 80px; height: 80px; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-pen-nib fa-3x"></i>
                </div>
                <h1 class="fw-bold mb-2">AI Content Creator</h1>
                <p class="text-muted fs-5">Viết bài Facebook, TikTok hoặc Blog chuẩn SEO chỉ với vài từ khóa.</p>
            </div>

            <div class="row g-4">
                <!-- Cấu hình bên trái -->
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-body p-4">
                            <h5 class="fw-bold mb-4 d-flex align-items-center gap-2">
                                <i class="fa-solid fa-sliders text-primary"></i> Thiết lập content
                            </h5>
                            
                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted text-uppercase mb-2">Chủ đề cần viết</label>
                                <textarea wire:model="topic" class="form-control rounded-3 border-light-subtle shadow-none" rows="4" placeholder="Ví dụ: Lợi ích của học lập trình sớm..."></textarea>
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-bold small text-muted text-uppercase mb-2">Phong cách & Nền tảng</label>
                                <div class="d-flex flex-column gap-2">
                                    <label class="style-option p-3 border rounded-3 cursor-pointer {{ $style == 'fb' ? 'border-primary bg-primary-thin shadow-sm' : 'border-light-subtle' }}">
                                        <input type="radio" wire:model="style" value="fb" class="d-none">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="radio-btn rounded-circle {{ $style == 'fb' ? 'bg-primary' : 'bg-light' }}"></div>
                                            <div>
                                                <div class="fw-bold">Facebook Post</div>
                                                <div class="small text-muted mt-1">Nhiều emoji, lời kêu gọi hành động.</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="style-option p-3 border rounded-3 cursor-pointer {{ $style == 'tiktok' ? 'border-primary bg-primary-thin shadow-sm' : 'border-light-subtle' }}">
                                        <input type="radio" wire:model="style" value="tiktok" class="d-none">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="radio-btn rounded-circle {{ $style == 'tiktok' ? 'bg-primary' : 'bg-light' }}"></div>
                                            <div>
                                                <div class="fw-bold">TikTok Script</div>
                                                <div class="small text-muted mt-1">Cấu trúc Hook, Content sống động.</div>
                                            </div>
                                        </div>
                                    </label>

                                    <label class="style-option p-3 border rounded-3 cursor-pointer {{ $style == 'blog' ? 'border-primary bg-primary-thin shadow-sm' : 'border-light-subtle' }}">
                                        <input type="radio" wire:model="style" value="blog" class="d-none">
                                        <div class="d-flex align-items-center gap-3">
                                            <div class="radio-btn rounded-circle {{ $style == 'blog' ? 'bg-primary' : 'bg-light' }}"></div>
                                            <div>
                                                <div class="fw-bold">Blog SEO</div>
                                                <div class="small text-muted mt-1">Chuẩn cấu trúc bài viết dài.</div>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <button wire:click="generate" class="btn btn-primary btn-lg w-100 fw-bold py-3 rounded-3 mt-2 d-flex align-items-center justify-content-center gap-2" wire:loading.attr="disabled">
                                <span wire:loading wire:target="generate" class="spinner-border spinner-border-sm"></span>
                                <i wire:loading.remove wire:target="generate" class="fa-solid fa-bolt"></i>
                                Tạo nội dung ngay
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Kết quả bên phải -->
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm rounded-4 h-100">
                        <div class="card-header bg-white border-0 py-3 px-4 d-flex justify-content-between align-items-center mt-2">
                            <h5 class="mb-0 fw-bold d-flex align-items-center gap-2">
                                <i class="fa-solid fa-wand-magic-sparkles text-primary"></i> Kết quả từ AI
                            </h5>
                            @if($result)
                            <button class="btn btn-sm btn-link text-decoration-none fw-bold" onclick="copyContent()">
                                <i class="fa-solid fa-copy me-1"></i> Sao chép tất cả
                            </button>
                            @endif
                        </div>
                        <div class="card-body p-4 pt-0">
                            @if($loading)
                            <div class="text-center py-5">
                                <div class="spinner-grow text-primary mb-3" style="width: 3rem; height: 3rem;"></div>
                                <p class="text-muted italic">Đang viết bài cho bạn, vui lòng đợi trong giây lát...</p>
                            </div>
                            @elseif($result)
                                <div class="result-container p-4 rounded-4 border-start border-4 border-primary position-relative" id="ai-result">
                                    <!-- Hiển thị Markdown nếu là Blog, và text thường cho những cái khác -->
                                    <div id="rendered-content" class="content-body" data-style="{{ $style }}">
                                        {!! $style == 'blog' ? '' : nl2br(e($result)) !!}
                                    </div>
                                    <!-- Dữ liệu thô để xử lý Javascript -->
                                    <div id="raw-result" class="d-none">{{ $result }}</div>
                                </div>
                            @elseif($error)
                                <div class="alert alert-danger rounded-4 mt-3">{{ $error }}</div>
                            @else
                                <div class="empty-state text-center py-5">
                                    <img src="https://illustrations.popsy.co/blue/creative-process.svg" alt="Creative" style="max-width: 200px;" class="mb-3 opacity-50">
                                    <p class="text-muted">Nhập chủ đề và chọn nền tảng để bắt đầu tạo nội dung.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cursor-pointer { cursor: pointer; }
        .bg-primary-thin { background-color: rgba(13, 110, 253, 0.05); }
        .style-option { transition: all 0.2s; }
        .style-option:hover { background-color: rgba(13, 110, 253, 0.03); }
        .radio-btn { width: 14px; height: 14px; border: 3px solid #eee; transition: all 0.2s; }
        .style-option input:checked + .d-flex .radio-btn { border-color: #0d6efd; background-color: #fff; }
        
        .result-container {
            background-color: #fcfcfd;
            line-height: 1.8;
            font-size: 1.05rem;
            color: #1a202c;
            min-height: 300px;
        }

        .content-body[data-style="fb"] { font-family: 'Segoe UI', system-ui, -apple-system, sans-serif; }
        .content-body[data-style="blog"] h1, 
        .content-body[data-style="blog"] h2, 
        .content-body[data-style="blog"] h3 { 
            color: #1a365d; 
            margin-top: 1.5rem; 
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .content-body[data-style="blog"] ul { margin-bottom: 1rem; padding-left: 1.5rem; }
        
        .tiktok-block {
            background: #fff;
            padding: 1rem;
            border-radius: 10px;
            border: 1px dashed #dee2e6;
            margin-bottom: 1rem;
        }
    </style>

    <script>
        document.addEventListener('livewire:initialized', () => {
            @this.on('resultUpdated', () => {
                const raw = document.getElementById('raw-result').textContent;
                const style = document.getElementById('rendered-content').dataset.style;
                const target = document.getElementById('rendered-content');

                if (style === 'blog') {
                    target.innerHTML = marked.parse(raw);
                }
            });
        });

        function copyContent() {
            const el = document.getElementById('raw-result');
            navigator.clipboard.writeText(el.textContent).then(() => {
                alert('Đã sao chép nội dung!');
            });
        }

        // Tự động render Markdown lần đầu nếu có kết quả
        window.addEventListener('load', () => {
            const raw = document.getElementById('raw-result');
            if (raw) {
                const style = document.getElementById('rendered-content').dataset.style;
                if (style === 'blog') {
                    document.getElementById('rendered-content').innerHTML = marked.parse(raw.textContent);
                }
            }
        });
    </script>
</div>
