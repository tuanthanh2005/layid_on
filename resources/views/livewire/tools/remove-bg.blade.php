<div class="rmbg-wrapper">

    {{-- === HEADER === --}}
    <div class="rmbg-header">
        <div class="rmbg-header__badge">
            <span class="badge-dot"></span>
            <span>AI Miễn phí · Không giới hạn lượt dùng</span>
        </div>
        <h1 class="rmbg-header__title">
            <span class="rmbg-header__icon">
                <i class="fa-solid fa-wand-magic-sparkles"></i>
            </span>
            Xóa Nền Ảnh Bằng AI
        </h1>
        <p class="rmbg-header__sub">Tách nền tự động cực chuẩn — chạy trực tiếp trên máy chủ, không cần API bên ngoài.</p>
    </div>

    {{-- === MAIN CONTENT === --}}
    <div class="rmbg-layout">

        {{-- === LEFT: UPLOAD === --}}
        <div class="rmbg-panel rmbg-upload-panel">
            <div class="rmbg-panel__header">
                <i class="fa-solid fa-cloud-arrow-up"></i>
                <span>Tải Ảnh Lên</span>
            </div>

            {{-- Upload Zone --}}
            <label class="rmbg-dropzone @if($image) has-image @endif" wire:ignore.self id="dropzone-label" for="rmbg-file-input">
                <input
                    type="file"
                    id="rmbg-file-input"
                    wire:model="image"
                    accept="image/*"
                    class="rmbg-dropzone__input"
                >

                {{-- Preview image if selected --}}
                @if($previewUrl)
                    <div class="rmbg-dropzone__preview">
                        <img src="{{ $previewUrl }}" alt="Preview" class="rmbg-dropzone__img" id="upload-preview">
                        <div class="rmbg-dropzone__overlay">
                            <i class="fa-solid fa-image"></i>
                            <span>Đổi ảnh</span>
                        </div>
                    </div>
                @else
                    <div class="rmbg-dropzone__placeholder" id="rmbg-placeholder">
                        <div class="rmbg-dropzone__icon-wrap">
                            <i class="fa-solid fa-image"></i>
                        </div>
                        <p class="rmbg-dropzone__main-text">Kéo thả hoặc nhấp để chọn ảnh</p>
                        <p class="rmbg-dropzone__sub-text">JPG, PNG, WEBP — Tối đa 10MB</p>
                    </div>
                @endif

                {{-- Uploading Livewire spinner - only for file upload --}}
                <div wire:loading wire:target="image" class="rmbg-dropzone__spinner">
                    <div class="spinner-ring"></div>
                    <span>Đang tải lên...</span>
                </div>
            </label>

            {{-- Info chips --}}
            <div class="rmbg-chips">
                <div class="rmbg-chip"><i class="fa-solid fa-shield-halved"></i> Bảo mật</div>
                <div class="rmbg-chip"><i class="fa-solid fa-bolt"></i> Nhanh chóng</div>
                <div class="rmbg-chip"><i class="fa-solid fa-infinity"></i> Không giới hạn</div>
            </div>

            {{-- Process Button --}}
            <button
                id="rmbg-process-btn"
                wire:click="process"
                class="rmbg-btn-process @if(!$inputFile || $loading) disabled @endif"
                @if(!$inputFile || $loading) disabled @endif
            >
                @if($loading)
                    <div class="btn-spinner"></div>
                    <span>Đang xử lý AI...</span>
                @else
                    <i class="fa-solid fa-scissors"></i>
                    <span>Xóa Nền Ngay</span>
                @endif
            </button>

            {{-- Error Alert --}}
            @if($error)
                <div class="rmbg-alert rmbg-alert--error">
                    <i class="fa-solid fa-circle-exclamation"></i>
                    <span>{{ $error }}</span>
                </div>
            @endif
        </div>

        {{-- === ARROW === --}}
        <div class="rmbg-arrow">
            <i class="fa-solid fa-arrow-right-long"></i>
        </div>

        {{-- === RIGHT: RESULT === --}}
        <div class="rmbg-panel rmbg-result-panel">
            <div class="rmbg-panel__header">
                <i class="fa-solid fa-sparkles" style="color: #a78bfa;"></i>
                <span>Kết Quả</span>
                @if($resultUrl)
                    <a href="{{ $resultUrl }}" download="layid-removebg.png" class="rmbg-download-btn">
                        <i class="fa-solid fa-download"></i> Tải xuống
                    </a>
                @endif
            </div>

            <div class="rmbg-result-body">
                @if($loading)
                    <div class="rmbg-loading-state">
                        <div class="rmbg-ai-loader">
                            <div class="ai-loader-ring"></div>
                            <div class="ai-loader-ring ai-loader-ring--2"></div>
                            <div class="ai-loader-ring ai-loader-ring--3"></div>
                            <i class="fa-solid fa-microchip ai-loader-icon"></i>
                        </div>
                        <p class="rmbg-loading-title">AI đang phân tích ảnh...</p>
                        <p class="rmbg-loading-sub">Lần đầu chạy có thể mất vài giây để khởi động mô hình</p>
                        <div class="rmbg-progress-bar">
                            <div class="rmbg-progress-fill"></div>
                        </div>
                    </div>
                @elseif($resultUrl)
                    <div class="rmbg-result-display">
                        <div class="rmbg-result-img-wrap">
                            <img src="{{ $resultUrl }}" alt="Result" class="rmbg-result-img">
                        </div>
                        <div class="rmbg-success-badge">
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Tách nền hoàn tất!</span>
                        </div>
                    </div>
                @else
                    <div class="rmbg-empty-state">
                        <div class="rmbg-empty-icon-wrap">
                            <i class="fa-solid fa-scissors"></i>
                        </div>
                        <p class="rmbg-empty-title">Chưa có ảnh kết quả</p>
                        <p class="rmbg-empty-sub">Tải ảnh lên và nhấn "Xóa Nền Ngay" để bắt đầu</p>
                        <div class="rmbg-steps">
                            <div class="rmbg-step">
                                <span class="rmbg-step__num">1</span>
                                <span>Chọn ảnh cần xóa nền</span>
                            </div>
                            <div class="rmbg-step">
                                <span class="rmbg-step__num">2</span>
                                <span>Nhấn nút Xóa Nền</span>
                            </div>
                            <div class="rmbg-step">
                                <span class="rmbg-step__num">3</span>
                                <span>Tải ảnh kết quả về</span>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- === FEATURES === --}}
    <div class="rmbg-features">
        <div class="rmbg-feature">
            <i class="fa-solid fa-robot"></i>
            <div>
                <strong>AI Thông Minh</strong>
                <p>Mô hình U2-Net nhận diện chủ thể cực chính xác</p>
            </div>
        </div>
        <div class="rmbg-feature">
            <i class="fa-solid fa-lock"></i>
            <div>
                <strong>Hoàn Toàn Riêng Tư</strong>
                <p>Ảnh xử lý trên máy chủ của bạn, không lưu lại</p>
            </div>
        </div>
        <div class="rmbg-feature">
            <i class="fa-brands fa-python"></i>
            <div>
                <strong>Công Nghệ Rembg</strong>
                <p>Thư viện Python tiên tiến, miễn phí và mã nguồn mở</p>
            </div>
        </div>
    </div>

</div>

<style>
    /* ===== ROOT VARS ===== */
    :root {
        --rmbg-bg: #0f0f1a;
        --rmbg-surface: #1a1a2e;
        --rmbg-surface2: #16213e;
        --rmbg-border: rgba(255,255,255,0.08);
        --rmbg-border-hover: rgba(139, 92, 246, 0.5);
        --rmbg-primary: #8b5cf6;
        --rmbg-primary-2: #a78bfa;
        --rmbg-green: #10b981;
        --rmbg-text: #e2e8f0;
        --rmbg-muted: #94a3b8;
        --rmbg-radius: 20px;
        --rmbg-shadow: 0 20px 60px rgba(0,0,0,0.4);
    }

    /* ===== WRAPPER ===== */
    .rmbg-wrapper {
        max-width: 1100px;
        margin: 0 auto;
        padding: 40px 20px 60px;
        font-family: 'Inter', sans-serif;
    }

    /* ===== HEADER ===== */
    .rmbg-header {
        text-align: center;
        margin-bottom: 48px;
        animation: rmbg-fadeUp 0.6s ease-out;
    }
    .rmbg-header__badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(139, 92, 246, 0.15);
        border: 1px solid rgba(139, 92, 246, 0.3);
        color: var(--rmbg-primary-2);
        font-size: 13px;
        font-weight: 600;
        padding: 6px 16px;
        border-radius: 100px;
        margin-bottom: 20px;
        letter-spacing: 0.02em;
    }
    .badge-dot {
        width: 8px; height: 8px;
        background: var(--rmbg-green);
        border-radius: 50%;
        box-shadow: 0 0 8px var(--rmbg-green);
        animation: badge-pulse 2s infinite;
    }
    @keyframes badge-pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.6; transform: scale(0.85); }
    }
    .rmbg-header__title {
        font-size: clamp(26px, 4vw, 42px);
        font-weight: 800;
        color: #fff;
        margin: 0 0 12px;
        background: linear-gradient(135deg, #ffffff 0%, #a78bfa 60%, #60a5fa 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.15;
    }
    .rmbg-header__icon {
        display: inline-flex;
        width: 52px; height: 52px;
        background: linear-gradient(135deg, var(--rmbg-primary), #60a5fa);
        border-radius: 14px;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 22px;
        margin-right: 10px;
        vertical-align: middle;
        box-shadow: 0 8px 24px rgba(139, 92, 246, 0.4);
    }
    .rmbg-header__sub {
        color: var(--rmbg-muted);
        font-size: 16px;
        margin: 0;
    }

    /* ===== LAYOUT ===== */
    .rmbg-layout {
        display: grid;
        grid-template-columns: 1fr auto 1fr;
        gap: 24px;
        align-items: start;
        margin-bottom: 40px;
    }
    @media (max-width: 768px) {
        .rmbg-layout { grid-template-columns: 1fr; }
        .rmbg-arrow { transform: rotate(90deg); }
    }

    /* ===== PANELS ===== */
    .rmbg-panel {
        background: var(--rmbg-surface);
        border: 1px solid var(--rmbg-border);
        border-radius: var(--rmbg-radius);
        overflow: hidden;
        box-shadow: var(--rmbg-shadow);
        animation: rmbg-fadeUp 0.7s ease-out;
    }
    .rmbg-result-panel { animation-delay: 0.1s; }

    .rmbg-panel__header {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 16px 22px;
        border-bottom: 1px solid var(--rmbg-border);
        font-weight: 700;
        font-size: 15px;
        color: var(--rmbg-text);
        background: rgba(255,255,255,0.02);
    }
    .rmbg-panel__header > i { font-size: 17px; color: var(--rmbg-primary-2); }

    /* ===== DROPZONE ===== */
    .rmbg-upload-panel { padding: 20px; display: flex; flex-direction: column; gap: 14px; }
    .rmbg-upload-panel .rmbg-panel__header { margin: -20px -20px 0; border-radius: 0; }

    .rmbg-dropzone {
        display: block;
        position: relative;
        min-height: 240px;
        border: 2px dashed rgba(139, 92, 246, 0.3);
        border-radius: 14px;
        background: rgba(139, 92, 246, 0.04);
        cursor: pointer;
        overflow: hidden;
        transition: all 0.3s ease;
        margin-top: 16px;
    }
    .rmbg-dropzone:hover {
        border-color: var(--rmbg-primary);
        background: rgba(139, 92, 246, 0.08);
    }
    .rmbg-dropzone.has-image {
        border-style: solid;
        border-color: rgba(139, 92, 246, 0.4);
        min-height: 0;
    }
    .rmbg-dropzone__input {
        position: absolute;
        inset: 0;
        opacity: 0;
        cursor: pointer;
        width: 100%;
        height: 100%;
        z-index: 5;
    }
    .rmbg-dropzone__placeholder {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
        text-align: center;
        min-height: 240px;
    }
    .rmbg-dropzone__icon-wrap {
        width: 72px; height: 72px;
        border-radius: 18px;
        background: rgba(139, 92, 246, 0.12);
        border: 1.5px solid rgba(139, 92, 246, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: var(--rmbg-primary-2);
        margin-bottom: 16px;
        transition: all 0.3s;
    }
    .rmbg-dropzone:hover .rmbg-dropzone__icon-wrap {
        background: rgba(139, 92, 246, 0.2);
        transform: translateY(-3px);
        box-shadow: 0 8px 24px rgba(139, 92, 246, 0.2);
    }
    .rmbg-dropzone__main-text {
        color: var(--rmbg-text);
        font-weight: 600;
        font-size: 15px;
        margin: 0 0 6px;
    }
    .rmbg-dropzone__sub-text {
        color: var(--rmbg-muted);
        font-size: 12px;
        margin: 0;
    }
    .rmbg-dropzone__preview {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .rmbg-dropzone__img {
        width: 100%;
        max-height: 260px;
        object-fit: contain;
        display: block;
    }
    .rmbg-dropzone__overlay {
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,0.6);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        opacity: 0;
        transition: opacity 0.25s;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }
    .rmbg-dropzone:hover .rmbg-dropzone__overlay { opacity: 1; }
    .rmbg-dropzone__overlay i { font-size: 24px; }

    /* Spinner ONLY for upload event */
    .rmbg-dropzone__spinner {
        position: absolute;
        inset: 0;
        z-index: 20;
        background: rgba(15, 15, 26, 0.85);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 12px;
        color: var(--rmbg-primary-2);
        font-weight: 600;
        font-size: 14px;
        border-radius: 12px;
    }
    .spinner-ring {
        width: 42px; height: 42px;
        border: 3px solid rgba(139, 92, 246, 0.2);
        border-top-color: var(--rmbg-primary);
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }

    /* ===== CHIPS ===== */
    .rmbg-chips {
        display: flex;
        gap: 8px;
        flex-wrap: wrap;
    }
    .rmbg-chip {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: 12px;
        font-weight: 600;
        color: var(--rmbg-muted);
        background: rgba(255,255,255,0.04);
        border: 1px solid var(--rmbg-border);
        padding: 5px 12px;
        border-radius: 100px;
    }
    .rmbg-chip i { font-size: 11px; color: var(--rmbg-primary-2); }

    /* ===== BUTTON ===== */
    .rmbg-btn-process {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        width: 100%;
        padding: 15px;
        font-size: 16px;
        font-weight: 700;
        color: white;
        background: linear-gradient(135deg, #7c3aed, #8b5cf6, #a78bfa);
        background-size: 200% 200%;
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 20px rgba(139, 92, 246, 0.35);
        letter-spacing: 0.02em;
    }
    .rmbg-btn-process:hover:not(.disabled) {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(139, 92, 246, 0.5);
        background-position: right center;
    }
    .rmbg-btn-process.disabled {
        opacity: 0.45;
        cursor: not-allowed;
        transform: none;
    }
    .btn-spinner {
        width: 18px; height: 18px;
        border: 2.5px solid rgba(255,255,255,0.3);
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.75s linear infinite;
    }

    /* ===== ALERT ===== */
    .rmbg-alert {
        display: flex;
        align-items: flex-start;
        gap: 10px;
        padding: 14px 16px;
        border-radius: 10px;
        font-size: 14px;
        font-weight: 500;
    }
    .rmbg-alert--error {
        background: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.25);
        color: #fca5a5;
    }

    /* ===== ARROW ===== */
    .rmbg-arrow {
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(139, 92, 246, 0.4);
        font-size: 24px;
        padding-top: 60px;
    }

    /* ===== RESULT PANEL ===== */
    .rmbg-result-panel { display: flex; flex-direction: column; }
    .rmbg-download-btn {
        margin-left: auto;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: linear-gradient(135deg, #10b981, #059669);
        color: white;
        font-size: 13px;
        font-weight: 700;
        padding: 7px 16px;
        border-radius: 100px;
        text-decoration: none;
        transition: all 0.25s;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }
    .rmbg-download-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 6px 20px rgba(16, 185, 129, 0.45);
        color: white;
    }

    .rmbg-result-body {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 360px;
        padding: 24px;
        background-image:
            linear-gradient(45deg, rgba(255,255,255,0.02) 25%, transparent 25%),
            linear-gradient(-45deg, rgba(255,255,255,0.02) 25%, transparent 25%),
            linear-gradient(45deg, transparent 75%, rgba(255,255,255,0.02) 75%),
            linear-gradient(-45deg, transparent 75%, rgba(255,255,255,0.02) 75%);
        background-size: 20px 20px;
        background-position: 0 0, 0 10px, 10px -10px, -10px 0;
        background-color: rgba(0,0,0,0.15);
    }

    /* === Loading State === */
    .rmbg-loading-state {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
    }
    .rmbg-ai-loader {
        position: relative;
        width: 80px; height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .ai-loader-ring {
        position: absolute;
        inset: 0;
        border: 2px solid transparent;
        border-top-color: var(--rmbg-primary);
        border-radius: 50%;
        animation: spin 1.2s linear infinite;
    }
    .ai-loader-ring--2 {
        inset: 10px;
        border-top-color: #60a5fa;
        animation-duration: 0.9s;
        animation-direction: reverse;
    }
    .ai-loader-ring--3 {
        inset: 20px;
        border-top-color: var(--rmbg-green);
        animation-duration: 1.5s;
    }
    .ai-loader-icon {
        font-size: 20px;
        color: var(--rmbg-primary-2);
    }
    .rmbg-loading-title {
        color: var(--rmbg-text);
        font-weight: 700;
        font-size: 16px;
        margin: 0;
    }
    .rmbg-loading-sub {
        color: var(--rmbg-muted);
        font-size: 13px;
        margin: 0;
    }
    .rmbg-progress-bar {
        width: 200px;
        height: 4px;
        background: rgba(255,255,255,0.08);
        border-radius: 100px;
        overflow: hidden;
    }
    .rmbg-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--rmbg-primary), #60a5fa);
        border-radius: 100px;
        animation: rmbg-progress 2.5s ease-in-out infinite;
    }
    @keyframes rmbg-progress {
        0% { width: 0%; margin-left: 0; }
        50% { width: 80%; margin-left: 0; }
        100% { width: 0%; margin-left: 100%; }
    }

    /* === Result State === */
    .rmbg-result-display {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 16px;
        width: 100%;
        animation: rmbg-fadeUp 0.5s ease-out;
    }
    .rmbg-result-img-wrap {
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.4);
    }
    .rmbg-result-img {
        max-height: 340px;
        max-width: 100%;
        display: block;
        object-fit: contain;
        filter: drop-shadow(0 8px 20px rgba(0,0,0,0.3));
    }
    .rmbg-success-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(16, 185, 129, 0.12);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #34d399;
        font-weight: 700;
        font-size: 14px;
        padding: 8px 18px;
        border-radius: 100px;
    }

    /* === Empty State === */
    .rmbg-empty-state {
        text-align: center;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }
    .rmbg-empty-icon-wrap {
        width: 80px; height: 80px;
        border-radius: 20px;
        background: rgba(139, 92, 246, 0.08);
        border: 1.5px solid rgba(139, 92, 246, 0.15);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        color: rgba(139, 92, 246, 0.4);
        margin-bottom: 4px;
    }
    .rmbg-empty-title {
        color: var(--rmbg-text);
        font-weight: 700;
        font-size: 17px;
        margin: 0;
    }
    .rmbg-empty-sub {
        color: var(--rmbg-muted);
        font-size: 13px;
        margin: 0 0 8px;
    }
    .rmbg-steps {
        display: flex;
        flex-direction: column;
        gap: 10px;
        text-align: left;
        width: 100%;
        max-width: 220px;
    }
    .rmbg-step {
        display: flex;
        align-items: center;
        gap: 12px;
        color: var(--rmbg-muted);
        font-size: 13px;
        font-weight: 500;
    }
    .rmbg-step__num {
        width: 26px; height: 26px;
        border-radius: 50%;
        background: rgba(139, 92, 246, 0.15);
        border: 1.5px solid rgba(139, 92, 246, 0.3);
        color: var(--rmbg-primary-2);
        font-weight: 800;
        font-size: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    /* ===== FEATURES ===== */
    .rmbg-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 16px;
        animation: rmbg-fadeUp 0.9s ease-out;
    }
    .rmbg-feature {
        display: flex;
        align-items: center;
        gap: 14px;
        padding: 18px 20px;
        background: var(--rmbg-surface);
        border: 1px solid var(--rmbg-border);
        border-radius: 14px;
        transition: all 0.3s;
    }
    .rmbg-feature:hover {
        border-color: rgba(139, 92, 246, 0.3);
        background: rgba(139, 92, 246, 0.05);
        transform: translateY(-2px);
    }
    .rmbg-feature > i {
        font-size: 24px;
        color: var(--rmbg-primary-2);
        width: 36px;
        text-align: center;
        flex-shrink: 0;
    }
    .rmbg-feature strong {
        display: block;
        color: var(--rmbg-text);
        font-size: 14px;
        margin-bottom: 2px;
    }
    .rmbg-feature p {
        color: var(--rmbg-muted);
        font-size: 12.5px;
        margin: 0;
    }

    /* ===== KEYFRAMES ===== */
    @keyframes rmbg-fadeUp {
        from { opacity: 0; transform: translateY(18px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    @keyframes spin {
        to { transform: rotate(360deg); }
    }
</style>
