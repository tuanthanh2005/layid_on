<div class="courses-container" style="padding-bottom: 50px;">
    <!-- Hero Section cho Học IT -->
    <div style="background: linear-gradient(135deg, #0f172a, #1e293b); padding: 40px; border-radius: 12px; margin-bottom: 35px; color: white; position: relative; overflow: hidden; box-shadow: var(--shadow-md);">
        <div style="position: absolute; right: -20px; bottom: -20px; opacity: 0.1; transform: rotate(-15deg);">
            <i class="fa-solid fa-graduation-cap" style="font-size: 15rem;"></i>
        </div>
        <div style="position: relative; z-index: 1;">
            <h1 style="font-size: 2.2rem; font-weight: 800; margin-bottom: 10px;">Học IT Miễn Phí <span style="color: #38bdf8;">Cùng TechTools</span></h1>
            <p style="font-size: 1.1rem; color: #94a3b8; max-width: 600px; line-height: 1.6;">Khám phá lộ trình học lập trình từ cơ bản đến nâng cao hoàn toàn miễn phí qua video bài giảng chất lượng cao.</p>
        </div>
    </div>

    <!-- Filter/Search mỏng -->
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h2 style="font-size: 1.5rem; color: var(--text-primary);">Tất cả khóa học</h2>
        <div style="display: flex; gap: 10px;">
            <select style="padding: 8px 15px; border-radius: 6px; border: 1px solid var(--border-color); background: var(--bg-card); color: var(--text-primary); outline: none;">
                <option>Mới nhất</option>
                <option>Đánh giá cao nhất</option>
                <option>Phổ biến nhất</option>
            </select>
        </div>
    </div>

    <!-- Course Grid -->
    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px;">
        <!-- Javascript Card -->
        <a wire:navigate href="/courses/javascript-mastery" style="text-decoration: none; display: block;">
            <div class="course-card" style="background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; transition: all 0.3s ease; height: 100%; box-shadow: var(--shadow-sm);">
                <div style="height: 160px; background: linear-gradient(135deg, #f7df1e, #e9d44d); display: flex; align-items: center; justify-content: center; color: #323330;">
                    <i class="fa-brands fa-js fa-5x"></i>
                </div>
                <div style="padding: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                        <span style="background: rgba(245, 158, 11, 0.1); color: #f59e0b; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">FRONTEND</span>
                        <div style="color: #f59e0b; font-size: 0.85rem;">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <span style="color: var(--text-secondary); margin-left: 2px;">(4.9)</span>
                        </div>
                    </div>
                    <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 8px; line-height: 1.4;">Javascript Mastery: Từ Zero đến Fullstack</h3>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px;">Làm chủ ngôn ngữ của thế giới Web. Học ES6+, DOM, Fetch API và hơn thế nữa...</p>
                    <div style="display: flex; align-items: center; gap: 15px; font-size: 0.8rem; color: var(--text-secondary);">
                        <span><i class="fa-solid fa-play-circle"></i> 45 Bài học</span>
                        <span><i class="fa-solid fa-clock"></i> 12.5 giờ</span>
                    </div>
                </div>
            </div>
        </a>

        <!-- Python Card -->
        <div class="course-card" style="background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; opacity: 0.9; cursor: pointer; height: 100%;">
            <div style="height: 160px; background: linear-gradient(135deg, #3776ab, #2b5b84); display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fa-brands fa-python fa-5x"></i>
            </div>
            <div style="padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="background: rgba(14, 165, 233, 0.1); color: #0ea5e9; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">BACKEND</span>
                    <div style="color: #f59e0b; font-size: 0.85rem;">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                        <span style="color: var(--text-secondary); margin-left: 2px;">(4.8)</span>
                    </div>
                </div>
                <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 8px;">Python cho Khoa học dữ liệu (Data Science)</h3>
                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px;">Phân tích dữ liệu chuyên nghiệp với Pandas, NumPy và trực quan hóa dữ liệu.</p>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 0.8rem; color: var(--text-secondary);">
                    <span><i class="fa-solid fa-play-circle"></i> 38 Bài học</span>
                    <span><i class="fa-solid fa-clock"></i> 10 giờ</span>
                </div>
            </div>
        </div>

        <!-- PHP & Laravel Card -->
        <div class="course-card" style="background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; height: 100%;">
            <div style="height: 160px; background: linear-gradient(135deg, #777bb4, #4f5b93); display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fa-brands fa-laravel fa-5x"></i>
            </div>
            <div style="padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="background: rgba(168, 85, 247, 0.1); color: #a855f7; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">PHP FRAMEWORK</span>
                    <div style="color: #f59e0b; font-size: 0.85rem;">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-regular fa-star" style="color: #cbd5e1;"></i>
                        <span style="color: var(--text-secondary); margin-left: 2px;">(4.7)</span>
                    </div>
                </div>
                <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 8px;">Laravel: Phát triển Web hiện đại cực nhanh</h3>
                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px;">Học Laravel thông qua dự án thực tế: Xây dựng hệ thống quản lý chuyên nghiệp.</p>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 0.8rem; color: var(--text-secondary);">
                    <span><i class="fa-solid fa-play-circle"></i> 52 Bài học</span>
                    <span><i class="fa-solid fa-clock"></i> 18 giờ</span>
                </div>
            </div>
        </div>

        <!-- HTML/CSS Card -->
        <div class="course-card" style="background: var(--bg-card); border-radius: 12px; border: 1px solid var(--border-color); overflow: hidden; height: 100%;">
            <div style="height: 160px; background: linear-gradient(135deg, #e44d26, #f06529); display: flex; align-items: center; justify-content: center; color: white;">
                <i class="fa-brands fa-html5 fa-5x"></i>
            </div>
            <div style="padding: 20px;">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
                    <span style="background: rgba(16, 185, 129, 0.1); color: #10b981; padding: 4px 10px; border-radius: 4px; font-size: 0.75rem; font-weight: bold;">BASICS</span>
                    <div style="color: #f59e0b; font-size: 0.85rem;">
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <span style="color: var(--text-secondary); margin-left: 2px;">(5.0)</span>
                    </div>
                </div>
                <h3 style="font-size: 1.2rem; color: var(--text-primary); margin-bottom: 8px;">HTML5 & CSS3: Nền tảng thiết kế Web chuyên nghiệp</h3>
                <p style="color: var(--text-secondary); font-size: 0.9rem; line-height: 1.5; margin-bottom: 15px;">Tự tay thiết kế giao diện Web chuẩn Mobile Responsive cực đẹp.</p>
                <div style="display: flex; align-items: center; gap: 15px; font-size: 0.8rem; color: var(--text-secondary);">
                    <span><i class="fa-solid fa-play-circle"></i> 25 Bài học</span>
                    <span><i class="fa-solid fa-clock"></i> 6 giờ</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        .course-card:hover {
            transform: translateY(-8px);
            border-color: var(--accent-primary) !important;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
    </style>
</div>
