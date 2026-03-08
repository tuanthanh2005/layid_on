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
    </style>

    <div class="pricing-grid">
        <!-- ChatGPT Plus Card -->
        <div class="pricing-card popular">
            <div class="popular-badge">HOT</div>
            <div class="pricing-header">
                <i class="fa-solid fa-robot" style="font-size: 3rem; color: #10a37f; margin-bottom: 15px;"></i>
                <h3 class="pricing-title">ChatGPT Plus</h3>
                <div class="pricing-price">99.000đ <span>/tháng</span></div>
                <div style="text-decoration: line-through; color: var(--text-secondary); font-size: 0.9rem;">Giá gốc: 499.000đ</div>
            </div>
            <ul class="pricing-features">
                <li><i class="fa-solid fa-check"></i> Truy cập GPT-4 & GPT-4o</li>
                <li><i class="fa-solid fa-check"></i> DALL-E 3 tạo ảnh không giới hạn</li>
                <li><i class="fa-solid fa-check"></i> Tạo GPTs cá nhân hóa</li>
                <li><i class="fa-solid fa-check"></i> Bảo hành 1 đổi 1 suốt 30 ngày</li>
            </ul>
            <button class="btn btn-primary pricing-action" onclick="alert('Đã thêm vào giỏ hàng: ChatGPT Plus 1 tháng')"><i class="fa-solid fa-cart-shopping"></i> Mua Ngay</button>
        </div>

        <!-- Claude Pro Card -->
        <div class="pricing-card">
            <div class="pricing-header">
                <i class="fa-solid fa-brain" style="font-size: 3rem; color: #cc785c; margin-bottom: 15px;"></i>
                <h3 class="pricing-title">Claude Pro (Opus)</h3>
                <div class="pricing-price">120.000đ <span>/tháng</span></div>
                <div style="text-decoration: line-through; color: var(--text-secondary); font-size: 0.9rem;">Giá gốc: 500.000đ</div>
            </div>
            <ul class="pricing-features">
                <li><i class="fa-solid fa-check"></i> Mô hình Opus thông minh nhất</li>
                <li><i class="fa-solid fa-check"></i> Xử lý 200k tokens (Rất dài)</li>
                <li><i class="fa-solid fa-check"></i> Phân tích file (PDF, Word, Code)</li>
                <li><i class="fa-solid fa-check"></i> Lập trình vượt trội</li>
            </ul>
            <button class="btn btn-outline pricing-action" onclick="alert('Đã thêm vào giỏ hàng: Claude Pro 1 tháng')"><i class="fa-solid fa-cart-shopping"></i> Mua Ngay</button>
        </div>

        <!-- Midjourney Card -->
        <div class="pricing-card">
            <div class="pricing-header">
                <i class="fa-solid fa-palette" style="font-size: 3rem; color: #5865F2; margin-bottom: 15px;"></i>
                <h3 class="pricing-title">Midjourney Pro</h3>
                <div class="pricing-price">150.000đ <span>/tháng</span></div>
                <div style="text-decoration: line-through; color: var(--text-secondary); font-size: 0.9rem;">Giá gốc: 699.000đ</div>
            </div>
            <ul class="pricing-features">
                <li><i class="fa-solid fa-check"></i> Render Fast Mode ưu tiên</li>
                <li><i class="fa-solid fa-check"></i> Tạo ảnh thương mại hoá</li>
                <li><i class="fa-solid fa-check"></i> Kết nối thẳng Discord cá nhân</li>
                <li><i class="fa-solid fa-check"></i> Kèm thư viện Prompt khổng lồ</li>
            </ul>
            <button class="btn btn-outline pricing-action" onclick="alert('Đã thêm vào giỏ hàng: Midjourney 1 tháng')"><i class="fa-solid fa-cart-shopping"></i> Mua Ngay</button>
        </div>
        
        <!-- Canva Pro Card -->
        <div class="pricing-card">
            <div class="pricing-header">
                <i class="fa-solid fa-pen-nib" style="font-size: 3rem; color: #00c4cc; margin-bottom: 15px;"></i>
                <h3 class="pricing-title">Canva Pro Lifetime</h3>
                <div class="pricing-price">49.000đ <span>/vĩnh viễn</span></div>
                <div style="text-decoration: line-through; color: var(--text-secondary); font-size: 0.9rem;">Giá gốc: 990.000đ</div>
            </div>
            <ul class="pricing-features">
                <li><i class="fa-solid fa-check"></i> Upgrade thẳng Email cá nhân</li>
                <li><i class="fa-solid fa-check"></i> Bảo hành vĩnh viễn (Life time)</li>
                <li><i class="fa-solid fa-check"></i> Kho ảnh gốc, video Pro không dán nhãn</li>
                <li><i class="fa-solid fa-check"></i> Tính năng Magic Studio AI mới nhất</li>
            </ul>
            <button class="btn btn-outline pricing-action" onclick="alert('Đã thêm vào giỏ hàng: Canva Pro Vĩnh viễn')"><i class="fa-solid fa-cart-shopping"></i> Mua Ngay</button>
        </div>
    </div>
</div>
