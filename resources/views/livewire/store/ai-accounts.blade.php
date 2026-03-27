<div class="tool-section">
    <div class="page-header" style="text-align: center; border-bottom: none;">
        <h1 style="color: var(--accent-primary); font-size: 2.5rem; margin-bottom: 15px;"><i class="fa-solid fa-store"></i> Cửa Hàng Tài Khoản AI</h1>
        <p style="color: var(--text-secondary); max-width: 600px; margin: 0 auto;">Cung cấp tài khoản ChatGPT Plus, Claude Pro, Midjourney, Canva Pro... với giá cực rẻ, bảo hành uy tín 1 đổi 1 trong toàn thời gian sử dụng.</p>
    </div>

    <style>
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }
        .pricing-card {
            background: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 30px 20px;
            position: relative;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }
        .pricing-card:hover {
            border-color: var(--accent-primary);
            box-shadow: var(--shadow-md);
            transform: translateY(-5px);
        }
        .pricing-card.popular {
            border-color: var(--accent-primary);
            box-shadow: 0 0 15px rgba(138, 43, 226, 0.2);
        }
        .popular-badge {
            position: absolute;
            top: 15px;
            right: -30px;
            background: var(--accent-primary);
            color: #fff;
            padding: 5px 40px;
            font-size: 0.8rem;
            font-weight: 600;
            transform: rotate(45deg);
        }
        .pricing-header {
            text-align: center;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 20px;
            margin-bottom: 20px;
        }
        .pricing-title {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }
        .pricing-price {
            font-size: 2rem;
            font-weight: 700;
            color: var(--accent-primary);
        }
        .pricing-price span {
            font-size: 1rem;
            color: var(--text-secondary);
            font-weight: 400;
        }
        .pricing-features {
            list-style: none;
            margin-bottom: 30px;
            flex-grow: 1;
        }
        .pricing-features li {
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .pricing-features li i {
            color: #10b981; /* Green check */
        }
        .pricing-action {
            width: 100%;
        }
        .description-wrapper {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 15px;
            transition: all 0.3s ease;
        }
        .description-wrapper.collapsed {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
        .description-toggle {
            display: inline-block;
            color: var(--accent-primary);
            cursor: pointer;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 15px;
            transition: color 0.3s ease;
            background: none;
            border: none;
            padding: 0;
        }
        .description-toggle:hover {
            color: var(--accent-primary);
            opacity: 0.8;
        }
        .description-container {
            margin-bottom: 25px;
        }
    </style>

    <div class="pricing-grid">
        @forelse($products as $product)
        <div class="pricing-card {{ $product->badge_text ? 'popular' : '' }}">
            @if($product->badge_text)
            <div class="popular-badge">{{ $product->badge_text }}</div>
            @endif
            <div class="pricing-header">
                @if($product->image)
                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="width: 80px; height: 80px; object-fit: contain; margin-bottom: 15px; border-radius: 12px;">
                @else
                <i class="fa-solid fa-robot" style="font-size: 3rem; color: var(--accent-primary); margin-bottom: 15px;"></i>
                @endif
                <h3 class="pricing-title">{{ $product->name }}</h3>
                <div class="pricing-price">{{ number_format($product->price) }}đ</div>
                @if($product->discount_price)
                <div style="text-decoration: line-through; color: var(--text-secondary); font-size: 0.9rem;">Giá gốc: {{ number_format($product->discount_price) }}đ</div>
                @endif
            </div>
            <div class="description-container">
                <div class="description-wrapper collapsed" id="desc-{{ $product->id }}">
                    {!! nl2br(e($product->description)) !!}
                </div>
                <button class="description-toggle" onclick="toggleDescription(event, {{ $product->id }})">
                    <span class="toggle-text">Xem thêm</span>
                    <i class="fa-solid fa-chevron-down" style="margin-left: 5px; font-size: 0.8rem;"></i>
                </button>
            </div>
                        <a href="{{ route('store.checkout', $product->slug) }}" class="btn {{ $product->badge_text ? 'btn-primary' : 'btn-outline' }} pricing-action text-center text-decoration-none">
                <i class="fa-solid fa-cart-shopping"></i> Mua Ngay
            </a>
        </div>
        @empty
        <div style="grid-column: 1 / -1; text-align: center; padding: 50px; background: var(--bg-card); border-radius: 12px; border: 1px dashed var(--border-color);">
            <i class="fa-solid fa-box-open fa-3x" style="color: var(--text-secondary); opacity: 0.3; margin-bottom: 15px;"></i>
            <p style="color: var(--text-secondary);">Hiện chưa có sản phẩm nào trong cửa hàng.</p>
        </div>
        @endforelse
    </div>

    <script>
        function toggleDescription(event, productId) {
            event.preventDefault();
            const wrapper = document.getElementById('desc-' + productId);
            const button = event.currentTarget;
            const toggleText = button.querySelector('.toggle-text');
            const icon = button.querySelector('i');

            wrapper.classList.toggle('collapsed');
            
            if (wrapper.classList.contains('collapsed')) {
                toggleText.textContent = 'Xem thêm';
                icon.style.transform = 'rotate(0deg)';
            } else {
                toggleText.textContent = 'Ẩn bớt';
                icon.style.transform = 'rotate(180deg)';
            }
        }
    </script>
</div>
