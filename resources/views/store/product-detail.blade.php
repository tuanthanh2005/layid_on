@extends('layouts.app')

@section('content')
<div class="pd-wrapper py-4">

    {{-- Breadcrumb --}}
    <nav class="pd-breadcrumb mb-4">
        <a href="/"><i class="fa-solid fa-house"></i> Trang chủ</a>
        <i class="fa-solid fa-chevron-right"></i>
        <a href="{{ route('store.ai') }}">AI Giá Rẻ</a>
        <i class="fa-solid fa-chevron-right"></i>
        <span>{{ $product->name }}</span>
    </nav>

    <div class="pd-layout">

        {{-- ===== MAIN CONTENT ===== --}}
        <div class="pd-main">

            {{-- Hero card --}}
            <div class="pd-hero-card">
                {{-- Ảnh 500x334 --}}
                <div class="pd-hero-img-wrap">
                    @if($product->image)
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="pd-hero-img">
                    @else
                    <div class="pd-hero-img-placeholder">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    @endif
                    @if($product->badge_text)
                    <div class="pd-badge">{{ $product->badge_text }}</div>
                    @endif
                    @if($product->category_label)
                    <div class="pd-category">{{ $product->category_label }}</div>
                    @endif
                </div>

                {{-- Info dưới ảnh --}}
                <div class="pd-hero-body">
                    <h1 class="pd-title">{{ $product->name }}</h1>

                    {{-- Rating mock --}}
                    <div class="pd-rating">
                        <span class="pd-stars">★★★★★</span>
                        <span class="pd-rating-text">5.0 — Hàng trăm khách hàng tin dùng</span>
                    </div>

                    @if($product->description)
                    <p class="pd-desc">{{ $product->description }}</p>
                    @endif

                    {{-- Trust badges --}}
                    <div class="pd-trust-grid">
                        <div class="pd-trust-item">
                            <i class="fa-solid fa-shield-halved"></i>
                            <span>Bảo hành 1 đổi 1</span>
                        </div>
                        <div class="pd-trust-item">
                            <i class="fa-solid fa-bolt"></i>
                            <span>Giao ngay 5 phút</span>
                        </div>
                        <div class="pd-trust-item">
                            <i class="fa-solid fa-certificate"></i>
                            <span>Chính hãng 100%</span>
                        </div>
                        <div class="pd-trust-item">
                            <i class="fa-solid fa-headset"></i>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tính năng nổi bật --}}
            @if($product->features && count($product->features) > 0)
            <div class="pd-section">
                <h2 class="pd-section-title"><i class="fa-solid fa-list-check"></i> Tính năng nổi bật</h2>
                <div class="pd-features-grid">
                    @foreach($product->features as $feat)
                    <div class="pd-feature-item">
                        <i class="fa-solid fa-circle-check"></i>
                        <span>{{ trim($feat) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- Chi tiết sản phẩm (HTML) --}}
            @if($product->details)
            <div class="pd-section">
                <h2 class="pd-section-title"><i class="fa-solid fa-circle-info"></i> Chi tiết sản phẩm</h2>
                <div class="pd-details-body">
                    {!! $product->details !!}
                </div>
            </div>
            @endif

            {{-- Video --}}
            @if($product->video_url)
            <div class="pd-section">
                <h2 class="pd-section-title"><i class="fa-brands fa-youtube text-danger"></i> Video giới thiệu</h2>
                <div class="pd-video-wrap ratio ratio-16x9">
                    <iframe src="{{ $product->video_url }}" allowfullscreen></iframe>
                </div>
            </div>
            @endif

            {{-- Sản phẩm liên quan --}}
            @if($related->count() > 0)
            <div class="pd-section">
                <h2 class="pd-section-title"><i class="fa-solid fa-grid-2"></i> Sản phẩm khác</h2>
                <div class="pd-related-grid">
                    @foreach($related as $rel)
                    <a href="{{ route('store.product', $rel->slug) }}" class="pd-related-card">
                        @if($rel->image)
                        <div class="pd-related-img-wrap">
                            <img src="{{ asset($rel->image) }}" alt="{{ $rel->name }}">
                        </div>
                        @endif
                        <div class="pd-related-info">
                            <div class="pd-related-name">{{ $rel->name }}</div>
                            <div class="pd-related-price">{{ number_format($rel->price) }}đ</div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>

        {{-- ===== SIDEBAR: MUA NGAY ===== --}}
        <div class="pd-sidebar">
            <div class="pd-buy-card">
                @if($product->image)
                <div class="pd-buy-thumb">
                    <img src="{{ asset($product->image) }}" alt="{{ $product->name }}">
                </div>
                @endif

                <div class="pd-buy-name">{{ $product->name }}</div>

                <div class="pd-pricing">
                    <div class="pd-price">{{ number_format($product->price) }}đ</div>
                    @if($product->discount_price)
                    <div class="pd-original">{{ number_format($product->discount_price) }}đ</div>
                    @if($product->discount_price > $product->price)
                    <div class="pd-save-badge">
                        Tiết kiệm {{ number_format($product->discount_price - $product->price) }}đ
                    </div>
                    @endif
                    @endif
                </div>

                <a href="{{ route('store.checkout', $product->slug) }}" class="pd-cta-btn">
                    <i class="fa-solid fa-cart-shopping"></i> Mua ngay
                </a>

                <div class="pd-guarantees">
                    <div class="pd-guarantee-item"><i class="fa-solid fa-shield-halved"></i> Bảo hành đổi mới trong toàn thời hạn</div>
                    <div class="pd-guarantee-item"><i class="fa-solid fa-bolt"></i> Giao tài khoản trong 5 phút qua Email</div>
                    <div class="pd-guarantee-item"><i class="fa-solid fa-lock"></i> Thanh toán bảo mật qua VietQR</div>
                    <div class="pd-guarantee-item"><i class="fa-solid fa-headset"></i> Hỗ trợ kỹ thuật 24/7 qua Telegram</div>
                </div>

                <div class="pd-share-row">
                    <span class="text-muted small">Chia sẻ:</span>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="pd-share-btn fb"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="https://t.me/share/url?url={{ urlencode(url()->current()) }}" target="_blank" class="pd-share-btn tg"><i class="fa-brands fa-telegram"></i></a>
                </div>
            </div>
        </div>

    </div>
</div>

<style>
/* ==============================================
   PRODUCT DETAIL PAGE — PREMIUM
   ============================================== */
.pd-wrapper { max-width: 1100px; margin: 0 auto; padding: 0 16px 60px; }

/* Breadcrumb */
.pd-breadcrumb {
    display: flex; align-items: center; gap: 8px;
    font-size: 0.82rem; color: #6b7280;
}
.pd-breadcrumb a { color: #6b7280; text-decoration: none; transition: color 0.2s; }
.pd-breadcrumb a:hover { color: #10b981; }
.pd-breadcrumb i { font-size: 0.7rem; }

/* Layout */
.pd-layout {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 28px;
    align-items: start;
}

/* ---- Hero card ---- */
.pd-hero-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 20px;
    overflow: hidden;
    margin-bottom: 24px;
}

.pd-hero-img-wrap {
    position: relative;
    width: 100%;
}
.pd-hero-img-wrap::before {
    content: ''; display: block;
    padding-top: calc(334 / 500 * 100%); /* 500x334 ratio */
}
.pd-hero-img {
    position: absolute; inset: 0;
    width: 100%; height: 100%;
    object-fit: cover;
}
.pd-hero-img-placeholder {
    position: absolute; inset: 0;
    display: flex; align-items: center; justify-content: center;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
}
.pd-hero-img-placeholder i { font-size: 5rem; color: #10b981; opacity: 0.35; }

.pd-badge {
    position: absolute; top: 16px; left: 16px;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff; font-size: 0.75rem; font-weight: 700;
    padding: 5px 14px; border-radius: 20px;
    box-shadow: 0 2px 10px rgba(239,68,68,0.4);
}
.pd-category {
    position: absolute; top: 16px; right: 16px;
    background: rgba(0,0,0,0.5); color: #fff;
    font-size: 0.72rem; font-weight: 600;
    padding: 4px 12px; border-radius: 20px;
    backdrop-filter: blur(4px);
}

.pd-hero-body { padding: 24px 28px; }

.pd-title {
    font-size: 1.6rem; font-weight: 800;
    color: #0f172a; margin-bottom: 10px; line-height: 1.2;
}

.pd-rating {
    display: flex; align-items: center; gap: 8px;
    margin-bottom: 14px;
}
.pd-stars { color: #f59e0b; font-size: 1rem; letter-spacing: 2px; }
.pd-rating-text { font-size: 0.82rem; color: #6b7280; }

.pd-desc {
    font-size: 0.95rem; color: #4b5563; line-height: 1.7;
    margin-bottom: 18px;
}

.pd-trust-grid {
    display: grid; grid-template-columns: repeat(2, 1fr);
    gap: 10px;
}
.pd-trust-item {
    display: flex; align-items: center; gap: 8px;
    font-size: 0.82rem; color: #374151;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    padding: 8px 12px; border-radius: 10px;
}
.pd-trust-item i { color: #10b981; font-size: 0.95rem; }

/* ---- Sections ---- */
.pd-section {
    background: #fff; border: 1px solid #e5e7eb;
    border-radius: 20px; padding: 28px 28px;
    margin-bottom: 20px;
}
.pd-section-title {
    font-size: 1.1rem; font-weight: 800;
    color: #0f172a; margin-bottom: 20px;
    display: flex; align-items: center; gap: 10px;
}
.pd-section-title i { color: #10b981; }

/* Features grid */
.pd-features-grid {
    display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px;
}
.pd-feature-item {
    display: flex; align-items: center; gap: 10px;
    font-size: 0.88rem; color: #1f2937;
    padding: 10px 14px; background: #f8fafc;
    border: 1px solid #e5e7eb; border-radius: 10px;
    transition: all 0.2s;
}
.pd-feature-item:hover { border-color: #10b981; background: #f0fdf4; }
.pd-feature-item i { color: #10b981; font-size: 1rem; flex-shrink: 0; }

/* Details HTML body */
.pd-details-body {
    font-size: 0.93rem; color: #374151; line-height: 1.8;
}
.pd-details-body h3 {
    font-size: 1.1rem; font-weight: 700; color: #0f172a;
    margin: 20px 0 10px; padding-bottom: 6px;
    border-bottom: 2px solid #e5e7eb;
}
.pd-details-body ul { padding-left: 20px; }
.pd-details-body li { margin-bottom: 6px; }
.pd-details-body p { margin-bottom: 12px; }
.pd-details-body .alert { border-radius: 10px; font-size: 0.88rem; }

/* Video */
.pd-video-wrap {
    border-radius: 14px; overflow: hidden;
    border: 1px solid #e5e7eb;
}

/* Related */
.pd-related-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
.pd-related-card {
    text-decoration: none; border-radius: 14px;
    border: 1px solid #e5e7eb; overflow: hidden;
    transition: all 0.2s;
}
.pd-related-card:hover { border-color: #10b981; transform: translateY(-3px); box-shadow: 0 8px 24px rgba(16,185,129,0.1); }
.pd-related-img-wrap {
    position: relative; width: 100%;
}
.pd-related-img-wrap::before { content: ''; display: block; padding-top: 66.8%; }
.pd-related-img-wrap img {
    position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
}
.pd-related-info { padding: 10px 12px; }
.pd-related-name { font-size: 0.82rem; font-weight: 700; color: #0f172a; margin-bottom: 4px; }
.pd-related-price { font-size: 0.88rem; font-weight: 800; color: #ef4444; }

/* ===== SIDEBAR BUY CARD ===== */
.pd-sidebar { position: sticky; top: 90px; }

.pd-buy-card {
    background: #fff; border: 1.5px solid #e5e7eb;
    border-radius: 20px; overflow: hidden;
    box-shadow: 0 8px 30px rgba(0,0,0,0.06);
}

.pd-buy-thumb {
    width: 100%; position: relative;
}
.pd-buy-thumb::before { content: ''; display: block; padding-top: 66.8%; }
.pd-buy-thumb img {
    position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;
}

.pd-buy-name {
    padding: 16px 20px 4px;
    font-size: 1rem; font-weight: 800; color: #0f172a; line-height: 1.3;
}

.pd-pricing {
    padding: 8px 20px 16px;
    border-bottom: 1px solid #f1f5f9;
}
.pd-price {
    font-size: 1.8rem; font-weight: 900; color: #ef4444; line-height: 1;
}
.pd-original {
    font-size: 0.88rem; color: #9ca3af; text-decoration: line-through; margin-top: 2px;
}
.pd-save-badge {
    display: inline-block; margin-top: 6px;
    background: #fef2f2; border: 1px solid #fecaca;
    color: #ef4444; font-size: 0.75rem; font-weight: 700;
    padding: 3px 10px; border-radius: 10px;
}

.pd-cta-btn {
    display: flex; align-items: center; justify-content: center; gap: 10px;
    margin: 16px 20px;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff; text-decoration: none;
    padding: 15px; border-radius: 12px;
    font-size: 1.05rem; font-weight: 800;
    transition: all 0.2s;
}
.pd-cta-btn:hover {
    background: linear-gradient(135deg, #047857, #059669);
    color: #fff; box-shadow: 0 8px 24px rgba(5,150,105,0.4);
    transform: translateY(-2px);
}

.pd-guarantees {
    padding: 0 20px 16px;
    display: flex; flex-direction: column; gap: 8px;
    border-bottom: 1px solid #f1f5f9;
}
.pd-guarantee-item {
    display: flex; align-items: center; gap: 8px;
    font-size: 0.8rem; color: #374151;
}
.pd-guarantee-item i { color: #10b981; width: 16px; text-align: center; }

.pd-share-row {
    padding: 14px 20px;
    display: flex; align-items: center; gap: 8px;
}
.pd-share-btn {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 0.85rem; text-decoration: none; transition: all 0.2s;
    border: 1px solid #e5e7eb; color: #6b7280;
}
.pd-share-btn.fb:hover { background: #1877f2; border-color: #1877f2; color: #fff; }
.pd-share-btn.tg:hover { background: #0088cc; border-color: #0088cc; color: #fff; }

/* ---- Responsive ---- */
@media (max-width: 900px) {
    .pd-layout { grid-template-columns: 1fr; }
    .pd-sidebar { position: static; }
    .pd-features-grid { grid-template-columns: 1fr; }
    .pd-related-grid { grid-template-columns: repeat(2, 1fr); }
    .pd-trust-grid { grid-template-columns: repeat(2, 1fr); }
}
@media (max-width: 600px) {
    .pd-related-grid { grid-template-columns: 1fr; }
    .pd-hero-body { padding: 16px; }
    .pd-title { font-size: 1.3rem; }
    .pd-section { padding: 20px; }
}
</style>
@endsection
