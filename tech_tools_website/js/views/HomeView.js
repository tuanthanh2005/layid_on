class HomeView {
    constructor(rootElement) {
        this.root = rootElement;
    }

    render() {
        const tools = [
            { id: '2fa', icon: 'fa-shield-halved', title: 'Lấy Mã 2FA Nhanh', desc: 'Trích xuất mã 2FA nhanh chóng từ Livepass.' },
            { id: 'gemini', icon: 'fa-robot', title: 'Gemini Business Free', desc: 'Nhận 1 tháng sử dụng Gemini Business miễn phí.' },
            { id: 'watermark', icon: 'fa-eraser', title: 'Xóa Watermark AI', desc: 'Loại bỏ logo Gemini trên ảnh dễ dàng.' },
            { id: 'blog', icon: 'fa-book-open', title: 'Blog Hướng Dẫn', desc: 'Tổng hợp mẹo và thủ thuật công nghệ.' },
            { id: 'ai-tips', icon: 'fa-lightbulb', title: 'Mẹo xài AI', desc: 'Tối ưu hóa Prompts ChatGPT, Claude, Gemini...' },
            { id: 'social-buff', icon: 'fa-heart', title: 'Dịch vụ Tăng Tương Tác', desc: 'Buff Follow, Like, Comment (TikTok, Facebook).' },
            { id: 'proxy', icon: 'fa-globe', title: 'Proxy Nuôi Acc', desc: 'Proxy Private, IPv4/IPv6 giá cực rẻ.' }
        ];

        let gridHTML = '<div class="home-grid">';
        tools.forEach(t => {
            gridHTML += `
                <div class="tool-card" onclick="app.navigate('/tools/${t.id}')">
                    <i class="fa-solid ${t.icon} tool-icon"></i>
                    <h3>${t.title}</h3>
                    <p style="color: var(--text-secondary); margin-top: 10px;">${t.desc}</p>
                </div>
            `;
        });
        gridHTML += '</div>';

        this.root.innerHTML = `
            <div class="page-header">
                <h1 style="color: var(--accent-primary)">Khám phá Công cụ & Dịch vụ</h1>
                <p>Nền tảng công cụ chuẩn SEO, thiết kế Responsive hiện đại cho mọi nền tảng.</p>
            </div>
            ${gridHTML}
        `;
    }
}
