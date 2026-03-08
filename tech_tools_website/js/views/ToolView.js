class ToolView {
    constructor(rootElement) {
        this.root = rootElement;
    }

    render2FA() {
        this.root.innerHTML = `
            <div class="tool-section">
                <div class="page-header">
                    <h2 style="color: var(--accent-primary)"><i class="fa-solid fa-shield-halved"></i> Công Cụ Nhận Mã 2FA</h2>
                    <p>Hỗ trợ lấy mã code đăng nhập từ chuỗi 2FA cho mọi nền tảng.</p>
                </div>
                <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: var(--bg-card); border-radius: 8px;">
                    <label style="display: block; margin-bottom: 10px; color: var(--text-secondary)">Nhập chuỗi Token 2FA của bạn:</label>
                    <textarea id="2fa-input" rows="4" style="width: 100%; padding: 15px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary); outline: none; margin-bottom: 15px;" placeholder="VD: NDKS 29KS KD8S KS92 ..."></textarea>
                    
                    <button class="btn btn-primary" onclick="alert('Đã Mock Tạo Mã code: 123 456')"><i class="fa-solid fa-key"></i> Lấy Mã (Mock)</button>
                    
                    <div style="margin-top: 20px; padding: 15px; border-left: 4px solid var(--accent-primary); background: var(--bg-secondary);">
                        <strong style="color: var(--accent-primary)">Kết quả:</strong>
                        <h1 style="letter-spacing: 5px; margin-top: 10px; font-size: 2.5rem; color: #fff;">------</h1>
                    </div>
                </div>
            </div>
        `;
    }

    renderPlaceholder(title, desc) {
        this.root.innerHTML = `
            <div class="tool-section" style="text-align: center; padding: 50px 20px;">
                <i class="fa-solid fa-gears" style="font-size: 4rem; color: var(--accent-primary); margin-bottom: 20px;"></i>
                <h2 style="margin-bottom: 15px;">${title}</h2>
                <p style="color: var(--text-secondary); max-width: 500px; margin: 0 auto;">${desc}<br>Tính năng đang trong quá trình phát triển (Beta). Vui lòng quay lại sau!</p>
                <button class="btn btn-primary" style="margin-top: 25px;" onclick="app.navigate('/')"><i class="fa-solid fa-house"></i> Về Trang chủ</button>
            </div>
        `;
    }
}
