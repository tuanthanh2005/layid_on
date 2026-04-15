<div class="home-wrapper">

    {{-- ===== HERO BANNER ===== --}}
    <section class="hero-banner">
        <div class="hero-content">
            <div class="hero-badge">
                <i class="fa-solid fa-bolt"></i> Uy tín · Giá rẻ · Giao ngay
            </div>
            <h1 class="hero-title">Tài Khoản AI <span class="hero-accent">Premium</span><br>Giá Tốt Nhất Việt Nam</h1>
            <p class="hero-sub">ChatGPT Plus, Gemini Ultra, Claude Pro... Bảo hành 1 đổi 1 trọn gói. Giao trong 5 phút sau thanh toán.</p>
            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-num">500+</span>
                    <span class="stat-label">Khách hàng tin dùng</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-num">5★</span>
                    <span class="stat-label">Đánh giá trung bình</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-num">5 phút</span>
                    <span class="stat-label">Thời gian giao hàng</span>
                </div>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-float-card card-1">
                <i class="fa-solid fa-robot"></i>
                <span>AI sẵn sàng</span>
            </div>
            <div class="hero-float-card card-2">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Bảo hành 1:1</span>
            </div>
            <div class="hero-float-card card-3">
                <i class="fa-solid fa-clock"></i>
                <span>Giao ngay 24/7</span>
            </div>
        </div>
    </section>

    {{-- ===== TRUST BADGES ===== --}}
    <section class="trust-row">
        <div class="trust-item">
            <i class="fa-solid fa-shield-halved trust-icon"></i>
            <div>
                <div class="trust-title">Bảo hành trọn thời hạn</div>
                <div class="trust-sub">Đổi mới nếu gặp lỗi</div>
            </div>
        </div>
        <div class="trust-item">
            <i class="fa-solid fa-bolt trust-icon"></i>
            <div>
                <div class="trust-title">Giao tài khoản ngay</div>
                <div class="trust-sub">5 phút sau thanh toán</div>
            </div>
        </div>
        <div class="trust-item">
            <i class="fa-solid fa-headset trust-icon"></i>
            <div>
                <div class="trust-title">Hỗ trợ 24/7</div>
                <div class="trust-sub">Qua Telegram / Zalo</div>
            </div>
        </div>
        <div class="trust-item">
            <i class="fa-solid fa-tag trust-icon"></i>
            <div>
                <div class="trust-title">Giá tốt nhất thị trường</div>
                <div class="trust-sub">Cam kết hoàn tiền nếu sai</div>
            </div>
        </div>
    </section>

    {{-- ===== PRODUCT GRID ===== --}}
    @if($aiProducts->count() > 0)
    <section class="product-section">
        <div class="section-header">
            <div>
                <h2 class="section-heading">🛒 Cửa Hàng Tài Khoản AI</h2>
                <p class="section-desc">Tài khoản chính hãng, bảo hành 1 đổi 1 trong toàn bộ thời gian sử dụng</p>
            </div>
            @if($aiProducts->count() > 6)
            <a href="{{ route('store.ai') }}" class="view-all-btn">Xem tất cả <i class="fa-solid fa-arrow-right"></i></a>
            @endif
        </div>

        <div class="product-grid">
            @foreach($aiProducts->take(6) as $product)
            <div class="product-card">
                @if($product->badge_text)
                <div class="product-badge">{{ $product->badge_text }}</div>
                @endif

                <a href="{{ route('store.checkout', $product->slug) }}" class="product-image-wrap">
                    @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="product-image">
                    @else
                    <div class="product-image-placeholder">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    @endif
                    <div class="product-image-overlay">
                        <span><i class="fa-solid fa-eye"></i> Xem chi tiết</span>
                    </div>
                </a>

                <div class="product-info">
                    <h3 class="product-name">{{ $product->name }}</h3>

                    @if($product->discount_price)
                    <div class="product-discount-pct">
                        -{{ round((($product->discount_price - $product->price) / $product->discount_price) * 100) }}%
                    </div>
                    @endif

                    <div class="product-pricing">
                        <span class="product-price">{{ number_format($product->price) }}đ</span>
                        @if($product->discount_price)
                        <span class="product-original">{{ number_format($product->discount_price) }}đ</span>
                        @endif
                    </div>

                    <div class="product-meta">
                        <span><i class="fa-solid fa-shield-halved"></i> Bảo hành 1:1</span>
                        <span><i class="fa-solid fa-bolt"></i> Giao ngay</span>
                    </div>

                    <a href="{{ route('store.checkout', $product->slug) }}" class="product-buy-btn">
                        <i class="fa-solid fa-cart-shopping"></i> Mua ngay
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ===== HOW IT WORKS ===== --}}
    <section class="how-section">
        <h2 class="section-heading text-center mb-2">Quy trình mua hàng đơn giản</h2>
        <p class="section-desc text-center mb-5">Chỉ 3 bước để sở hữu tài khoản AI premium</p>
        <div class="steps-row">
            <div class="step-item">
                <div class="step-num">1</div>
                <div class="step-icon"><i class="fa-solid fa-mouse-pointer"></i></div>
                <h4>Chọn sản phẩm</h4>
                <p>Chọn gói AI phù hợp với nhu cầu và nhấn "Mua ngay"</p>
            </div>
            <div class="step-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            <div class="step-item">
                <div class="step-num">2</div>
                <div class="step-icon"><i class="fa-solid fa-qrcode"></i></div>
                <h4>Thanh toán VietQR</h4>
                <p>Quét mã QR hoặc chuyển khoản theo hướng dẫn</p>
            </div>
            <div class="step-arrow"><i class="fa-solid fa-chevron-right"></i></div>
            <div class="step-item">
                <div class="step-num">3</div>
                <div class="step-icon"><i class="fa-solid fa-envelope-circle-check"></i></div>
                <h4>Nhận tài khoản</h4>
                <p>Thông tin được gửi qua Email trong 5 phút</p>
            </div>
        </div>
    </section>

</div>

<style>
/* =============================================
   HOME PAGE — PREMIUM REDESIGN
   ============================================= */

.home-wrapper {
    padding: 0;
}

/* --- HERO --- */
.hero-banner {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #0f2942 100%);
    border-radius: 20px;
    padding: 56px 48px;
    margin: 20px 0 30px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 40px;
    overflow: hidden;
    position: relative;
}

.hero-banner::before {
    content: '';
    position: absolute;
    top: -60px; right: -60px;
    width: 300px; height: 300px;
    background: radial-gradient(circle, rgba(16,185,129,0.15) 0%, transparent 70%);
    border-radius: 50%;
}

.hero-content { flex: 1; max-width: 580px; position: relative; z-index: 1; }

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(16,185,129,0.15);
    border: 1px solid rgba(16,185,129,0.3);
    color: #34d399;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.82rem;
    font-weight: 600;
    margin-bottom: 18px;
    letter-spacing: 0.5px;
}

.hero-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: #f8fafc;
    line-height: 1.2;
    margin-bottom: 16px;
}

.hero-accent {
    background: linear-gradient(135deg, #10b981, #34d399);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-sub {
    color: #94a3b8;
    font-size: 1rem;
    line-height: 1.7;
    margin-bottom: 28px;
}

.hero-stats {
    display: flex;
    align-items: center;
    gap: 24px;
}

.stat-item { text-align: center; }
.stat-num { display: block; font-size: 1.4rem; font-weight: 800; color: #f8fafc; }
.stat-label { font-size: 0.75rem; color: #64748b; margin-top: 2px; }
.stat-divider { width: 1px; height: 36px; background: rgba(255,255,255,0.1); }

.hero-visual {
    position: relative;
    width: 200px;
    height: 200px;
    flex-shrink: 0;
}

.hero-float-card {
    position: absolute;
    background: rgba(255,255,255,0.07);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 14px;
    padding: 12px 16px;
    display: flex;
    align-items: center;
    gap: 8px;
    color: #e2e8f0;
    font-size: 0.82rem;
    font-weight: 500;
    white-space: nowrap;
    animation: floatCard 3s ease-in-out infinite;
}

.hero-float-card i { color: #34d399; font-size: 1rem; }
.card-1 { top: 0; left: 0; animation-delay: 0s; }
.card-2 { top: 50%; left: 20px; transform: translateY(-50%); animation-delay: 1s; }
.card-3 { bottom: 0; left: 0; animation-delay: 2s; }

@keyframes floatCard {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-8px); }
}
.card-2 { animation-name: floatCardMid; }
@keyframes floatCardMid {
    0%, 100% { transform: translateY(-50%); }
    50% { transform: translateY(calc(-50% - 8px)); }
}

/* --- TRUST ROW --- */
.trust-row {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-bottom: 40px;
}

.trust-item {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: all 0.2s ease;
}

.trust-item:hover {
    border-color: #10b981;
    box-shadow: 0 4px 20px rgba(16,185,129,0.08);
    transform: translateY(-2px);
}

.trust-icon {
    font-size: 1.5rem;
    color: #10b981;
    flex-shrink: 0;
}

.trust-title { font-weight: 700; font-size: 0.88rem; color: #1f2937; margin-bottom: 2px; }
.trust-sub { font-size: 0.75rem; color: #6b7280; }

/* --- SECTION HEADER --- */
.product-section { margin-bottom: 50px; }
.section-header {
    display: flex;
    align-items: flex-end;
    justify-content: space-between;
    margin-bottom: 24px;
}

.section-heading {
    font-size: 1.5rem;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px;
}

.section-desc {
    font-size: 0.88rem;
    color: #6b7280;
    margin: 0;
}

.view-all-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #059669;
    padding: 8px 18px;
    border-radius: 20px;
    font-size: 0.85rem;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.2s;
    white-space: nowrap;
}

.view-all-btn:hover {
    background: #10b981;
    border-color: #10b981;
    color: #fff;
    transform: translateX(3px);
}

/* --- PRODUCT GRID --- */
.product-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
}

.product-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: all 0.3s ease;
}

.product-card:hover {
    border-color: #10b981;
    box-shadow: 0 12px 40px rgba(16,185,129,0.12);
    transform: translateY(-4px);
}

.product-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    z-index: 10;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    box-shadow: 0 2px 8px rgba(239,68,68,0.4);
    letter-spacing: 0.3px;
}

.product-image-wrap {
    display: block;
    height: 170px;
    background: #f8fafc;
    overflow: hidden;
    position: relative;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.product-card:hover .product-image { transform: scale(1.05); }

.product-image-placeholder {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
}

.product-image-placeholder i { font-size: 3rem; color: #10b981; opacity: 0.5; }

.product-image-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.45);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}

.product-image-overlay span {
    color: #fff;
    font-size: 0.85rem;
    font-weight: 600;
    border: 2px solid rgba(255,255,255,0.7);
    padding: 7px 18px;
    border-radius: 20px;
    display: flex;
    align-items: center;
    gap: 6px;
}

.product-card:hover .product-image-overlay { opacity: 1; }

.product-info { padding: 16px; display: flex; flex-direction: column; flex: 1; }

.product-name {
    font-size: 0.97rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.4;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.product-discount-pct {
    display: inline-block;
    background: #fef2f2;
    color: #ef4444;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 10px;
    margin-bottom: 6px;
    border: 1px solid #fecaca;
}

.product-pricing {
    display: flex;
    align-items: baseline;
    gap: 8px;
    margin-bottom: 8px;
}

.product-price {
    font-size: 1.25rem;
    font-weight: 800;
    color: #ef4444;
}

.product-original {
    font-size: 0.8rem;
    color: #9ca3af;
    text-decoration: line-through;
}

.product-meta {
    display: flex;
    gap: 10px;
    margin-bottom: 14px;
    flex-wrap: wrap;
}

.product-meta span {
    font-size: 0.72rem;
    color: #059669;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    padding: 3px 10px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.product-buy-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    text-decoration: none;
    padding: 11px 0;
    border-radius: 10px;
    font-size: 0.9rem;
    font-weight: 700;
    margin-top: auto;
    transition: all 0.2s;
    letter-spacing: 0.3px;
}

.product-buy-btn:hover {
    background: linear-gradient(135deg, #047857, #059669);
    color: #fff;
    box-shadow: 0 6px 20px rgba(5,150,105,0.35);
    transform: translateY(-2px);
}

/* --- HOW IT WORKS --- */
.how-section {
    background: #f8fafc;
    border-radius: 20px;
    padding: 48px 40px;
    margin-bottom: 40px;
    border: 1px solid #e5e7eb;
}

.steps-row {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 20px;
}

.step-item {
    text-align: center;
    flex: 1;
    max-width: 200px;
}

.step-num {
    width: 32px;
    height: 32px;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    font-size: 0.85rem;
    font-weight: 800;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 14px;
    box-shadow: 0 4px 12px rgba(16,185,129,0.3);
}

.step-icon {
    width: 64px;
    height: 64px;
    background: #fff;
    border: 2px solid #e5e7eb;
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: #10b981;
    margin: 0 auto 14px;
    transition: all 0.3s;
}

.step-item:hover .step-icon {
    border-color: #10b981;
    background: #f0fdf4;
    box-shadow: 0 4px 16px rgba(16,185,129,0.15);
}

.step-item h4 {
    font-size: 0.95rem;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 6px;
}

.step-item p {
    font-size: 0.8rem;
    color: #6b7280;
    line-height: 1.5;
    margin: 0;
}

.step-arrow {
    color: #d1d5db;
    font-size: 1.1rem;
    flex-shrink: 0;
}

/* =============================================
   RESPONSIVE
   ============================================= */
@media (max-width: 900px) {
    .trust-row { grid-template-columns: repeat(2, 1fr); }
    .product-grid { grid-template-columns: repeat(2, 1fr); }
    .hero-banner { flex-direction: column; padding: 36px 24px; }
    .hero-visual { display: none; }
    .hero-title { font-size: 1.8rem; }
    .steps-row { flex-wrap: wrap; }
    .step-arrow { display: none; }
}

@media (max-width: 600px) {
    .trust-row { grid-template-columns: 1fr; }
    .product-grid { grid-template-columns: 1fr; }
    .section-header { flex-direction: column; align-items: flex-start; gap: 10px; }
    .hero-stats { gap: 16px; }
    .stat-num { font-size: 1.1rem; }
    .how-section { padding: 28px 20px; }
}
</style>
