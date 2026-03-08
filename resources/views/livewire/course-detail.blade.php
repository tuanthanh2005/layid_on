<div class="course-detail-container">
    <div style="display: flex; flex-direction: column; gap: 30px;">
        <!-- Phần Video & Header -->
        <div>
            <div style="margin-bottom: 20px;">
                <nav style="font-size: 0.85rem; color: var(--text-secondary); margin-bottom: 10px;">
                    <a wire:navigate href="/courses" style="color: inherit; text-decoration: none;">Khóa học</a> &nbsp;/&nbsp; <span style="color: var(--accent-primary);">Javascript Mastery</span>
                </nav>
                <h1 style="font-size: 2rem; color: var(--text-primary); font-weight: 800; margin-bottom: 15px;">Bài 1: Giới thiệu khóa học Javascript Mastery & Cài đặt môi trường</h1>
                <div style="display: flex; align-items: center; gap: 20px; font-size: 0.9rem; color: var(--text-secondary);">
                    <span style="display: flex; align-items: center; gap: 5px;"><i class="fa-solid fa-star" style="color: #f59e0b;"></i> 4.9 (128 đánh giá)</span>
                    <span><i class="fa-solid fa-users"></i> 1,542 học viên</span>
                    <span><i class="fa-solid fa-calendar-alt"></i> Cập nhật: 06/03/2026</span>
                </div>
            </div>

            <!-- Video Player -->
            <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; border-radius: 12px; box-shadow: var(--shadow-md); background: #000;">
                <iframe 
                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;"
                    src="https://www.youtube.com/embed/PkZNo7MFNFg" 
                    title="YouTube video player" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    allowfullscreen>
                </iframe>
            </div>
        </div>

        <div class="magazine-container" style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; margin-top: 10px;">
            <!-- Cột Trái: Nội dung & Bình luận -->
            <div class="magazine-main">
                <div style="background: var(--bg-card); padding: 30px; border-radius: 12px; border: 1px solid var(--border-color); margin-bottom: 30px;">
                    <h3 style="font-size: 1.3rem; margin-bottom: 20px; color: var(--text-primary); border-bottom: 2px solid var(--accent-primary); display: inline-block; padding-bottom: 5px;">Tóm tắt nội dung</h3>
                    <div style="color: var(--text-secondary); line-height: 1.8; font-size: 1rem;">
                        <p>Chào mừng các bạn đến với khóa học <strong>Javascript Mastery</strong>. Trong bài học đầu tiên này, chúng ta sẽ cùng điểm qua các nội dung chính mà khóa học sẽ bao phủ, cũng như chuẩn bị các công cụ cần thiết để bắt đầu hành trình chinh phục ngôn ngữ lập trình phổ biến nhất thế giới Web.</p>
                        <h4 style="color: var(--text-primary); margin-top: 20px;">Nội dung chính:</h4>
                        <ul style="padding-left: 20px;">
                            <li>Tổng quan về hệ sinh thái Javascript năm 2026.</li>
                            <li>Tại sao Javascript vẫn là lựa chọn hàng đầu cho Fullstack Developer?</li>
                            <li>Hướng dẫn cài đặt VS Code, Node.js và các Extension hữu ích.</li>
                            <li>Viết chương trình Hello World đầu tiên và chạy trên Console.</li>
                        </ul>
                        <div style="background: var(--bg-secondary); padding: 15px; border-radius: 8px; border-left: 4px solid var(--accent-primary); margin-top: 25px;">
                            <i class="fa-solid fa-circle-info" style="color: var(--accent-primary);"></i> <strong>Lưu ý:</strong> Hãy đảm bảo bạn đã cài đặt môi trường đúng cách để có thể thực hành các bài học tiếp theo suôn sẻ nhất.
                        </div>
                    </div>
                </div>

                <!-- Section: Đánh giá & Bình luận -->
                <div class="sidebar-widget" style="margin-top: 20px; border-top: 1px solid var(--border-color); padding-top: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
                        <h3 style="font-size: 1.4rem; margin: 0; color: var(--text-primary);"><i class="fa-solid fa-comments"></i> 24 Thảo luận & Đánh giá</h3>
                    </div>

                    <!-- Review Input (Có đánh giá sao) -->
                    <div style="display: flex; gap: 15px; margin-bottom: 35px; background: var(--bg-secondary); padding: 20px; border-radius: 12px;">
                        <img src="https://ui-avatars.com/api/?name=You&background=3b82f6&color=fff&rounded=true" style="width: 45px; height: 45px; border-radius: 50%; border: 2px solid white;">
                        <div style="flex-grow: 1;">
                            <div style="margin-bottom: 10px; display: flex; align-items: center; gap: 10px;">
                                <span style="font-size: 0.9rem; color: var(--text-primary); font-weight: bold;">Đánh giá của bạn:</span>
                                <div style="font-size: 1.1rem; color: #cbd5e1; display: flex; gap: 5px;">
                                    <i class="fa-solid fa-star" style="cursor: pointer; color: #f59e0b;"></i>
                                    <i class="fa-solid fa-star" style="cursor: pointer; color: #f59e0b;"></i>
                                    <i class="fa-solid fa-star" style="cursor: pointer; color: #f59e0b;"></i>
                                    <i class="fa-solid fa-star" style="cursor: pointer; color: #f59e0b;"></i>
                                    <i class="fa-solid fa-star" style="cursor: pointer;"></i>
                                </div>
                            </div>
                            <div style="border: 1px solid #cbd5e1; border-radius: 8px; overflow: hidden; background: white;">
                                <textarea placeholder="Hỏi đáp hoặc đóng góp ý kiến về bài học..." style="width: 100%; border: none; padding: 12px; font-family: inherit; font-size: 0.95rem; resize: none; outline: none; min-height: 80px;"></textarea>
                                <div style="padding: 10px; background: #f8fafc; display: flex; justify-content: flex-end;">
                                    <button class="btn btn-primary" style="padding: 6px 20px; font-size: 0.9rem;">Gửi bình luận</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Comment List -->
                    <div style="display: flex; flex-direction: column; gap: 25px;">
                        <!-- Comment 1 -->
                        <div style="display: flex; gap: 12px;">
                            <img src="https://ui-avatars.com/api/?name=TV&background=ef4444&color=fff&rounded=true" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div>
                                <div style="background: #f1f5f9; padding: 12px 15px; border-radius: 15px;">
                                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 5px;">
                                        <span style="font-weight: bold; font-size: 0.95rem;">Thành Vinh</span>
                                        <div style="font-size: 0.75rem; color: #f59e0b;">
                                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                        </div>
                                    </div>
                                    <div style="font-size: 0.95rem; color: #334155; line-height: 1.5;">Khóa học chất lượng quá admin ơi, video rất nét và giải thích cực kỳ dễ hiểu. Mong sớm ra bài 2!</div>
                                </div>
                                <div style="font-size: 0.8rem; color: #64748b; margin: 5px 0 0 10px; display: flex; gap: 15px;">
                                    <span style="font-weight: 600; cursor: pointer;">Thích</span>
                                    <span style="font-weight: 600; cursor: pointer;">Phản hồi</span>
                                    <span>Vừa xong</span>
                                </div>
                            </div>
                        </div>

                        <!-- Comment 2 -->
                        <div style="display: flex; gap: 12px;">
                            <img src="https://ui-avatars.com/api/?name=A&background=10b981&color=fff&rounded=true" style="width: 40px; height: 40px; border-radius: 50%;">
                            <div>
                                <div style="background: #f1f5f9; padding: 12px 15px; border-radius: 15px;">
                                    <div style="font-weight: bold; font-size: 0.95rem; margin-bottom: 5px;">Admin TechTools <i class="fa-solid fa-circle-check" style="color: #3b82f6; font-size: 0.8rem;"></i></div>
                                    <div style="font-size: 0.95rem; color: #334155;">Chào Thành Vinh, cảm ơn bạn đã quan tâm. Bài 2 sẽ được cập nhật vào tối thứ 4 tuần này nhé!</div>
                                </div>
                                <div style="font-size: 0.8rem; color: #64748b; margin: 5px 0 0 10px; display: flex; gap: 15px;">
                                    <span style="font-weight: 600; cursor: pointer;">Thích</span>
                                    <span style="font-weight: 600; cursor: pointer;">Phản hồi</span>
                                    <span>2 giờ trước</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột Phải: Sidebar Khóa học -->
            <div class="magazine-sidebar">
                <div class="sidebar-widget" style="background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden;">
                    <h3 style="padding: 15px 20px; font-size: 1.1rem; color: var(--text-primary); background: var(--bg-secondary); margin: 0; border-bottom: 1px solid var(--border-color);">Danh sách bài học</h3>
                    <div style="max-height: 500px; overflow-y: auto;">
                        <div style="padding: 12px 20px; border-bottom: 1px solid var(--border-color); background: rgba(56, 189, 248, 0.1); border-left: 4px solid var(--accent-primary); display: flex; align-items: center; gap: 10px;">
                            <i class="fa-solid fa-play-circle" style="color: var(--accent-primary);"></i>
                            <div style="font-size: 0.9rem; color: var(--text-primary); font-weight: 600;">1. Giới thiệu khóa học & Cài đặt</div>
                        </div>
                        <div style="padding: 12px 20px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <i class="fa-solid fa-lock" style="color: #94a3b8; font-size: 0.8rem;"></i>
                            <div style="font-size: 0.9rem; color: var(--text-secondary);">2. Biến và Kiểu dữ liệu trong JS</div>
                        </div>
                        <div style="padding: 12px 20px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <i class="fa-solid fa-lock" style="color: #94a3b8; font-size: 0.8rem;"></i>
                            <div style="font-size: 0.9rem; color: var(--text-secondary);">3. Hàm và Scope</div>
                        </div>
                        <div style="padding: 12px 20px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <i class="fa-solid fa-lock" style="color: #94a3b8; font-size: 0.8rem;"></i>
                            <div style="font-size: 0.9rem; color: var(--text-secondary);">4. Xử lý Mảng (Array Methods)</div>
                        </div>
                        <div style="padding: 12px 20px; border-bottom: 1px solid var(--border-color); display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <i class="fa-solid fa-lock" style="color: #94a3b8; font-size: 0.8rem;"></i>
                            <div style="font-size: 0.9rem; color: var(--text-secondary);">5. Object và Destructuring</div>
                        </div>
                    </div>
                </div>

                <div class="sidebar-widget" style="margin-top: 30px;">
                    <h3 class="widget-title">Gợi ý cho bạn</h3>
                    <div style="display: flex; flex-direction: column; gap: 15px;">
                        <a href="#" style="text-decoration: none; display: flex; gap: 10px;">
                            <div style="width: 80px; height: 50px; background: #3776ab; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white;"><i class="fa-brands fa-python"></i></div>
                            <h4 style="font-size: 0.85rem; color: var(--text-primary); margin: 0; line-height: 1.4;">Python: Data Science cho người mới</h4>
                        </a>
                        <a href="#" style="text-decoration: none; display: flex; gap: 10px;">
                            <div style="width: 80px; height: 50px; background: #777bb4; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: white;"><i class="fa-brands fa-laravel"></i></div>
                            <h4 style="font-size: 0.85rem; color: var(--text-primary); margin: 0; line-height: 1.4;">Laravel 11: Xây dựng Blog chuyên nghiệp</h4>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
