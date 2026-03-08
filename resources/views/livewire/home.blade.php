    <div class="magazine-container">
        <!-- Cột Trái: Main Content -->
        <div class="magazine-main">
            <!-- Featured Post -->
            <div class="featured-post" style="background: linear-gradient(135deg, #1d4ed8, #1e3a8a); position: relative; border-radius: 8px; height: 320px; display: flex; align-items: flex-end; overflow: hidden; margin-bottom: 25px;">
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; opacity: 0.1;">
                     <i class="fa-solid fa-code" style="font-size: 15rem; color: white;"></i>
                </div>
                <div style="background: rgba(0,0,0,0.6); width: 100%; padding: 15px 20px; z-index: 1;">
                    <a href="#" style="text-decoration:none;"><h2 style="color: white; font-size: 1.4rem; margin: 0;">Cấu trúc của một prompt</h2></a>
                </div>
            </div>

            <!-- Post Grid -->
            <div class="post-grid">
                <!-- Bai 1 -->
                <div class="post-card">
                    <div class="post-thumb" style="background: linear-gradient(135deg, #38bdf8, #0ea5e9); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-file-pdf fa-4x"></i></div>
                    <a href="#" class="post-title" style="color: #ef4444;">Cách chuyển câu trả lời của Grok thành file PDF</a>
                </div>
                <!-- Bai 2 -->
                <div class="post-card">
                    <div class="post-thumb" style="background: linear-gradient(135deg, #10b981, #059669); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-robot fa-4x"></i></div>
                    <a href="#" class="post-title">Cách sử dụng Gemini để viết bài chuẩn SEO Google</a>
                </div>
                <!-- Bai 3 -->
                <div class="post-card">
                    <div class="post-thumb" style="background: linear-gradient(135deg, #f43f5e, #e11d48); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-book-open fa-4x"></i></div>
                    <a href="#" class="post-title">Tính năng mới của NotebookLM biến giấc mơ của các nhà nghiên cứu thành hiện thực</a>
                </div>
                <!-- Bai 4 -->
                <div class="post-card">
                    <div class="post-thumb" style="background: linear-gradient(135deg, #a855f7, #9333ea); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-map-location-dot fa-4x"></i></div>
                    <a href="#" class="post-title">Cách kết hợp Gemini và Google Maps trong nhiếp ảnh</a>
                </div>
            </div>

            <!-- Tags -->
            <div style="display: flex; gap: 10px; margin: 5px 0 25px 0; overflow-x: auto;">
                <span style="color: #ef4444; border: 1px solid #ef4444; padding: 3px 10px; border-radius: 4px; font-size: 0.8rem;"><i class="fa-solid fa-fire"></i></span>
                <span style="border: 1px solid var(--border-color); padding: 3px 10px; border-radius: 4px; font-size: 0.8rem; color: var(--text-secondary);">Mạng xã hội</span>
                <span style="border: 1px solid var(--border-color); padding: 3px 10px; border-radius: 4px; font-size: 0.8rem; color: var(--text-secondary);">Facebook</span>
                <span style="border: 1px solid var(--border-color); padding: 3px 10px; border-radius: 4px; font-size: 0.8rem; color: var(--text-secondary);">Tin học văn phòng</span>
                <span style="border: 1px solid var(--border-color); padding: 3px 10px; border-radius: 4px; font-size: 0.8rem; color: var(--text-secondary);">Code game</span>
            </div>

            <!-- List Post -->
            <div style="display: flex; gap: 20px; margin-bottom: 25px; align-items: flex-start;">
                <div class="post-thumb" style="width: 280px; height: 160px; margin-bottom: 0; flex-shrink: 0; background: linear-gradient(135deg, #475569, #334155); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-gauge-high fa-4x"></i></div>
                <div>
                    <a href="#" class="post-title" style="font-size: 1.25rem;">Cách hiển thị tốc độ Internet trên Windows Taskbar</a>
                    <div style="font-size: 0.85rem; color: var(--text-secondary); margin: 10px 0;"><i class="fa-regular fa-clock"></i> 10 phút &nbsp;&nbsp; <i class="fa-regular fa-comment"></i> 1</div>
                    <p style="color: var(--text-secondary); font-size: 0.95rem; margin: 0; line-height: 1.5;">Windows 11 đã loại bỏ API mà các công cụ cũ dựa vào để nhúng vào Taskbar, vì vậy các tùy chọn hoạt động ít hơn bạn mong đợi. Hai công cụ dưới đây hoạt động...</p>
                </div>
            </div>

            <!-- Tiện ích -->
            <div class="section-title">Tiện ích</div>
            <div class="post-grid" style="grid-template-columns: repeat(3, 1fr);">
                <div class="post-card">
                    <div class="post-thumb" style="height: 120px; background: linear-gradient(135deg, #4f46e5, #4338ca); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-brands fa-php fa-3x"></i></div>
                    <a href="#" class="post-title" style="font-size: 1rem; font-weight: 500;">Viết code PHP trên trình duyệt</a>
                </div>
                <div class="post-card">
                    <div class="post-thumb" style="height: 120px; background: linear-gradient(135deg, #10b981, #059669); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-chart-line fa-3x"></i></div>
                    <a href="#" class="post-title" style="font-size: 1rem; font-weight: 500;">Giá tiêu hôm nay<br><span style="color: var(--text-secondary); font-weight: normal; font-size: 0.85rem;">06/03/2026</span></a>
                </div>
                <div class="post-card">
                    <div class="post-thumb" style="height: 120px; background: linear-gradient(135deg, #f59e0b, #d97706); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-database fa-3x"></i></div>
                    <a href="#" class="post-title" style="font-size: 1rem; font-weight: 500;">SQL Online Editor</a>
                </div>
            </div>
            
            <!-- Video -->
            <div class="section-title">Video</div>
            <div class="post-grid" style="grid-template-columns: repeat(3, 1fr);">
                <div class="post-card">
                    <div class="post-thumb" style="height: 110px; background: linear-gradient(135deg, #ec4899, #be185d); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-brands fa-facebook fa-3x"></i></div>
                    <a href="#" class="post-title" style="font-size: 0.95rem; font-weight: 500;">Hướng dẫn đổi ID Facebook, thay địa chỉ...</a>
                </div>
                <div class="post-card">
                    <div class="post-thumb" style="height: 110px; background: linear-gradient(135deg, #f43f5e, #e11d48); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-brands fa-instagram fa-3x"></i></div>
                    <a href="#" class="post-title" style="font-size: 0.95rem; font-weight: 500;">Cách bật, tắt chế độ tạm thời trên Instagram...</a>
                </div>
                <div class="post-card">
                    <div class="post-thumb" style="height: 110px; background: linear-gradient(135deg, #3b82f6, #1d4ed8); display:flex; align-items:center; justify-content:center; color:white;"><i class="fa-solid fa-hard-drive fa-3x"></i></div>
                    <a href="#" class="post-title" style="font-size: 0.95rem; font-weight: 500;">Cách dùng Recuva để khôi phục, lấy lại dữ liệu...</a>
                </div>
            </div>

        </div>

        <!-- Cột Phải: Sidebar -->
        <div class="magazine-sidebar">
            <!-- Được đề cử -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Được đề cử</h3>
                <ul class="widget-list">
                    <li class="widget-item">
                        <div class="widget-thumb" style="background: linear-gradient(135deg, #e0f2fe, #bae6fd); display:flex; align-items:center; justify-content:center; color:#0369a1; border-radius: 4px;"><i class="fa-brands fa-windows" style="font-size: 1.5rem;"></i></div>
                        <div class="widget-info">
                            <a href="#" style="text-decoration:none;"><h4>Cách bật và tắt AI Actions trong Windows 11</h4></a>
                        </div>
                    </li>
                    <li class="widget-item">
                        <div class="widget-thumb" style="background: linear-gradient(135deg, #fce7f3, #fbcfe8); display:flex; align-items:center; justify-content:center; color:#be185d; border-radius: 4px;"><i class="fa-solid fa-brain" style="font-size: 1.5rem;"></i></div>
                        <div class="widget-info">
                            <a href="#" style="text-decoration:none;"><h4>Các LLM cục bộ không thể thay thế ChatGPT hoặc Gemini</h4></a>
                        </div>
                    </li>
                    <li class="widget-item">
                        <div class="widget-thumb" style="background: linear-gradient(135deg, #dcfce7, #bbf7d0); display:flex; align-items:center; justify-content:center; color:#15803d; border-radius: 4px;"><i class="fa-solid fa-image" style="font-size: 1.5rem;"></i></div>
                        <div class="widget-info">
                            <a href="#" style="text-decoration:none;"><h4>Cách sử dụng Gemini để tạo ảnh trực tiếp trong Google Sheets</h4></a>
                        </div>
                    </li>
                    <li class="widget-item">
                        <div class="widget-thumb" style="background: linear-gradient(135deg, #ede9fe, #ddd6fe); display:flex; align-items:center; justify-content:center; color:#6d28d9; border-radius: 4px;"><i class="fa-solid fa-chart-pie" style="font-size: 1.5rem;"></i></div>
                        <div class="widget-info">
                            <a href="#" style="text-decoration:none;"><h4>Hướng dẫn vẽ biểu đồ trong Canva</h4></a>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Download -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Download</h3>
                
                <div class="download-item">
                    <div class="download-icon" style="background: #1e293b; color: #f59e0b; border-radius: 12px;"><i class="fa-solid fa-star"></i></div>
                    <div class="download-info" style="flex:1;">
                        <h4>Luminar AI</h4>
                        <div class="download-dev">Skylum Software</div>
                        <span class="download-rating"><i class="fa-solid fa-star" style="color:#60a5fa;"></i><i class="fa-solid fa-star" style="color:#60a5fa;"></i><i class="fa-solid fa-star" style="color:#60a5fa;"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i></span>
                        <span class="free-tag">Miễn phí</span>
                    </div>
                </div>

                <div class="download-item">
                    <div class="download-icon" style="background: #fbbf24; color: white; border-radius: 12px; font-weight:bold; font-size:1rem;">HT<br>HT</div>
                    <div class="download-info" style="flex:1;">
                        <h4>Huyền Thoại Hải Tặc...</h4>
                        <div class="download-dev">GOSU</div>
                    </div>
                </div>

                <div class="download-item">
                    <div class="download-icon" style="background: white; border: 1px solid #e5e7eb; border-radius: 50%; color: #3b82f6;"><i class="fa-brands fa-chrome"></i></div>
                    <div class="download-info" style="flex:1;">
                        <h4>Google Chrome</h4>
                        <div class="download-dev">Google</div>
                        <span class="download-rating"><i class="fa-solid fa-star" style="color:#22c55e;"></i><i class="fa-solid fa-star" style="color:#22c55e;"></i><i class="fa-solid fa-star" style="color:#22c55e;"></i><i class="fa-solid fa-star" style="color:#22c55e;"></i><i class="fa-solid fa-star" style="color:#22c55e;"></i></span>
                        <span class="free-tag" style="color:#22c55e;">Miễn phí</span>
                    </div>
                </div>
            </div>

            <!-- Có thể bạn quan tâm -->
            <div class="sidebar-widget">
                <h3 class="widget-title">Có thể bạn quan tâm</h3>
                <ul class="widget-list">
                    <li class="widget-item">
                        <div class="widget-thumb" style="background: linear-gradient(135deg, #bbf7d0, #86efac); border-radius: 4px;"></div>
                        <div class="widget-info">
                            <a href="#" style="text-decoration:none;"><h4>Cách viết chữ kiểu FB: chữ in đậm, chữ nghiêng, đổi font chữ Facebook</h4></a>
                        </div>
                    </li>
                    <li class="widget-item">
                        <div class="widget-thumb" style="background: linear-gradient(135deg, #334155, #1e293b); border-radius: 4px;"></div>
                        <div class="widget-info">
                            <a href="#" style="text-decoration:none;"><h4>Code FC Mobile mới nhất hôm nay 08/03/2026: Nhận quà TOTY...</h4></a>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</div>
