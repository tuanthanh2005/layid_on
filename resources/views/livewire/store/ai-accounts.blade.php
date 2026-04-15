<div class="store-wrapper">

    {{-- ===== PAGE HERO ===== --}}
    <section class="store-hero">
        <div class="store-hero-badge">
            <i class="fa-solid fa-certificate"></i> Cửa hàng chính hãng
        </div>
        <h1 class="store-hero-title">Tài Khoản AI <span class="store-hero-accent">Chất Lượng Cao</span></h1>
        <p class="store-hero-sub">Tất cả sản phẩm được kiểm duyệt kỹ lưỡng, bảo hành 1 đổi 1 trọn thời gian sử dụng. Giao tài khoản qua Email sau 5 phút thanh toán.</p>
        <div class="store-trust-pills">
            <span><i class="fa-solid fa-shield-halved"></i> Bảo hành 1:1</span>
            <span><i class="fa-solid fa-bolt"></i> Giao trong 5 phút</span>
            <span><i class="fa-solid fa-headset"></i> Hỗ trợ 24/7</span>
            <span><i class="fa-solid fa-star"></i> 5★ đánh giá</span>
        </div>
    </section>

    {{-- ===== PRODUCT GRID ===== --}}
    <section class="store-grid">
        @forelse($products as $product)
        <div class="store-card">
            {{-- Badge --}}
            @if($product->badge_text)
            <div class="store-badge">{{ $product->badge_text }}</div>
            @endif

            {{-- Ảnh 500x334 ratio --}}
            <a href="{{ route('store.checkout', $product->slug) }}" class="store-img-wrap">
                @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="store-img">
                @else
                <div class="store-img-placeholder">
                    <i class="fa-solid fa-robot"></i>
                </div>
                @endif
                <div class="store-img-overlay">
                    <span><i class="fa-solid fa-cart-shopping"></i> Xem & Mua</span>
                </div>
            </a>

            {{-- Thông tin sản phẩm --}}
            <div class="store-card-body">
                {{-- Tên + giá --}}
                <div class="store-card-top">
                    <h2 class="store-card-name">{{ $product->name }}</h2>
                    <div class="store-card-pricing">
                        <span class="store-card-price">{{ number_format($product->price) }}đ</span>
                        @if($product->discount_price)
                        <span class="store-card-original">{{ number_format($product->discount_price) }}đ</span>
                        <span class="store-card-pct">-{{ round((($product->discount_price - $product->price) / $product->discount_price) * 100) }}%</span>
                        @endif
                    </div>
                </div>

                {{-- Mô tả ngắn --}}
                @if($product->description)
                <div class="store-card-desc" id="desc-{{ $product->id }}">
                    {!! nl2br(e($product->description)) !!}
                </div>
                <button class="store-desc-toggle" onclick="toggleDesc(event, {{ $product->id }})">
                    <span class="tgl-text">Xem thêm</span>
                    <i class="fa-solid fa-chevron-down tgl-icon"></i>
                </button>
                @endif

                {{-- Feature badges --}}
                <div class="store-features">
                    <span><i class="fa-solid fa-circle-check"></i> Chính hãng 100%</span>
                    <span><i class="fa-solid fa-circle-check"></i> Bảo hành 1:1</span>
                    <span><i class="fa-solid fa-bolt"></i> Giao ngay 5 phút</span>
                    <span><i class="fa-solid fa-headset"></i> Hỗ trợ 24/7</span>
                </div>

                {{-- CTA --}}
                <a href="{{ route('store.checkout', $product->slug) }}" class="store-buy-btn">
                    <i class="fa-solid fa-cart-shopping"></i> Mua ngay — {{ number_format($product->price) }}đ
                </a>
                @if($product->url || $product->details || ($product->features && count($product->features) > 0))
                <a href="{{ route('store.product', $product->slug) }}" class="store-info-btn">
                    <i class="fa-solid fa-circle-info"></i> Tìm hiểu thêm về sản phẩm
                </a>
                @endif
            </div>
        </div>
        @empty
        <div class="store-empty">
            <i class="fa-solid fa-box-open"></i>
            <h3>Chưa có sản phẩm</h3>
            <p>Cửa hàng đang cập nhật sản phẩm mới, vui lòng quay lại sau.</p>
        </div>
        @endforelse
    </section>

</div>

<script>
function toggleDesc(event, id) {
    event.preventDefault();
    const desc = document.getElementById('desc-' + id);
    const btn  = event.currentTarget;
    desc.classList.toggle('expanded');
    btn.querySelector('.tgl-text').textContent = desc.classList.contains('expanded') ? 'Ẩn bớt' : 'Xem thêm';
    btn.querySelector('.tgl-icon').style.transform = desc.classList.contains('expanded') ? 'rotate(180deg)' : 'rotate(0deg)';
}
</script>

<style>
/* =============================================
   AI STORE — Card 500×334 image ratio
   ============================================= */

.store-wrapper { padding: 0 0 60px; }

/* --- Hero --- */
.store-hero {
    background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #064e3b 100%);
    border-radius: 20px;
    padding: 50px 48px;
    margin: 20px 0 36px;
    position: relative;
    overflow: hidden;
}
.store-hero::before {
    content: '';
    position: absolute;
    bottom: -80px; right: -80px;
    width: 350px; height: 350px;
    background: radial-gradient(circle, rgba(16,185,129,0.12) 0%, transparent 70%);
}
.store-hero-badge {
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
    margin-bottom: 16px;
}
.store-hero-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: #f8fafc;
    margin-bottom: 14px;
    line-height: 1.2;
}
.store-hero-accent {
    background: linear-gradient(135deg, #10b981, #34d399);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.store-hero-sub {
    color: #94a3b8;
    font-size: 0.97rem;
    line-height: 1.7;
    max-width: 650px;
    margin-bottom: 24px;
}
.store-trust-pills { display: flex; gap: 10px; flex-wrap: wrap; }
.store-trust-pills span {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.1);
    color: #cbd5e1;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 500;
}
.store-trust-pills span i { color: #34d399; }

/* --- Product Grid: 2 columns --- */
.store-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 28px;
}

/* --- Card --- */
.store-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 18px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    position: relative;
    transition: all 0.3s ease;
}
.store-card:hover {
    border-color: #10b981;
    box-shadow: 0 16px 48px rgba(16,185,129,0.12);
    transform: translateY(-4px);
}

/* Badge */
.store-badge {
    position: absolute;
    top: 14px; left: 14px;
    z-index: 10;
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 20px;
    box-shadow: 0 2px 10px rgba(239,68,68,0.4);
    letter-spacing: 0.3px;
}

/* Image wrapper — 500:334 = 66.8% aspect ratio */
.store-img-wrap {
    display: block;
    width: 100%;
    position: relative;
    overflow: hidden;
    background: #f1f5f9;
}
.store-img-wrap::before {
    content: '';
    display: block;
    padding-top: calc(334 / 500 * 100%); /* = 66.8% */
}
.store-img {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}
.store-card:hover .store-img { transform: scale(1.04); }

.store-img-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #f0fdf4, #dcfce7);
}
.store-img-placeholder i { font-size: 4rem; color: #10b981; opacity: 0.35; }

.store-img-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,0.38);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s;
}
.store-img-overlay span {
    background: #10b981;
    color: #fff;
    padding: 10px 24px;
    border-radius: 24px;
    font-weight: 700;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 8px;
}
.store-card:hover .store-img-overlay { opacity: 1; }

/* Card body — width matches image (100%) */
.store-card-body {
    padding: 20px 22px 22px;
    display: flex;
    flex-direction: column;
    flex: 1;
}

.store-card-top { margin-bottom: 10px; }

.store-card-name {
    font-size: 1.1rem;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 8px;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.store-card-pricing {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.store-card-price {
    font-size: 1.4rem;
    font-weight: 900;
    color: #ef4444;
}
.store-card-original {
    font-size: 0.85rem;
    color: #9ca3af;
    text-decoration: line-through;
}
.store-card-pct {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: #fff;
    font-size: 0.72rem;
    font-weight: 800;
    padding: 3px 9px;
    border-radius: 10px;
}

/* Description */
.store-card-desc {
    font-size: 0.83rem;
    color: #4b5563;
    line-height: 1.65;
    margin-bottom: 4px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    transition: all 0.3s;
}
.store-card-desc.expanded {
    -webkit-line-clamp: unset;
    overflow: visible;
}
.store-desc-toggle {
    background: none;
    border: none;
    color: #059669;
    font-size: 0.78rem;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    padding: 0;
    margin-bottom: 12px;
}
.tgl-icon { transition: transform 0.3s; font-size: 0.65rem; }

/* Feature badges */
.store-features {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6px;
    margin-bottom: 16px;
}
.store-features span {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.77rem;
    color: #374151;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    padding: 5px 10px;
    border-radius: 8px;
}
.store-features span i { color: #10b981; font-size: 0.8rem; }

/* CTA */
.store-buy-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    background: linear-gradient(135deg, #059669, #10b981);
    color: #fff;
    text-decoration: none;
    padding: 13px 16px;
    border-radius: 12px;
    font-size: 0.95rem;
    font-weight: 800;
    margin-top: auto;
    margin-bottom: 8px;
    transition: all 0.2s;
    letter-spacing: 0.2px;
}
.store-buy-btn:hover {
    background: linear-gradient(135deg, #047857, #059669);
    color: #fff;
    box-shadow: 0 8px 24px rgba(5,150,105,0.4);
    transform: translateY(-2px);
}
.store-info-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    border: 1.5px solid #e5e7eb;
    color: #6b7280;
    text-decoration: none;
    padding: 9px 14px;
    border-radius: 10px;
    font-size: 0.82rem;
    font-weight: 600;
    transition: all 0.2s;
}
.store-info-btn:hover {
    border-color: #10b981;
    color: #059669;
    background: #f0fdf4;
}

/* Empty */
.store-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 80px 40px;
    background: #f8fafc;
    border-radius: 20px;
    border: 2px dashed #e5e7eb;
}
.store-empty i { font-size: 3rem; color: #d1d5db; margin-bottom: 16px; display: block; }
.store-empty h3 { font-size: 1.2rem; color: #374151; margin-bottom: 8px; }
.store-empty p { color: #9ca3af; font-size: 0.9rem; }

/* --- Responsive --- */
@media (max-width: 860px) {
    .store-grid { grid-template-columns: 1fr 1fr; gap: 18px; }
    .store-hero { padding: 36px 24px; }
    .store-hero-title { font-size: 1.7rem; }
}
@media (max-width: 600px) {
    .store-grid { grid-template-columns: 1fr; }
    .store-features { grid-template-columns: 1fr; }
    .store-card-name { font-size: 1rem; }
    .store-trust-pills { gap: 6px; }
    .store-hero { padding: 28px 18px; }
}
</style>
