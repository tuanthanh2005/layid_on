    <div class="magazine-container">
        <!-- Cột Trái: Main Content -->
        <div class="magazine-main">
            <!-- Featured Post -->
            @if($featuredPost)
            <a href="{{ route('post.show', $featuredPost->slug) }}" style="text-decoration:none; display: block;">
                <div class="featured-post" style="background: {{ $featuredPost->thumbnail ? 'url(\''.asset($featuredPost->thumbnail).'\') center/cover' : ($featuredPost->color ?? 'linear-gradient(135deg, #1d4ed8, #1e3a8a)') }}; position: relative; border-radius: 8px; height: 320px; display: flex; align-items: flex-end; overflow: hidden; margin-bottom: 25px;">
                    @if(!$featuredPost->thumbnail && $featuredPost->icon)
                    <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; opacity: 0.1;">
                         <i class="{{ $featuredPost->icon }}" style="font-size: 15rem; color: white;"></i>
                    </div>
                    @endif
                    <div style="background: rgba(0,0,0,0.6); width: 100%; padding: 15px 20px; z-index: 1;">
                        <h2 style="color: white; font-size: 1.4rem; margin: 0;">{{ $featuredPost->title }}</h2>
                    </div>
                </div>
            </a>
            @endif

            <!-- Post Grid -->
            @if($gridPosts->count() > 0)
            <div class="post-grid">
                @foreach($gridPosts as $grid)
                <div class="post-card">
                    <a href="{{ route('post.show', $grid->slug) }}" style="display: block;">
                        <div class="post-thumb" style="background: {{ $grid->thumbnail ? 'url(\''.asset($grid->thumbnail).'\') center/cover' : ($grid->color ?? 'linear-gradient(135deg, #38bdf8, #0ea5e9)') }}; display:flex; align-items:center; justify-content:center; color:white;">
                            @if(!$grid->thumbnail && $grid->icon)
                            <i class="{{ $grid->icon }} fa-4x"></i>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('post.show', $grid->slug) }}" class="post-title" style="color: {{ $loop->first ? '#ef4444' : 'var(--text-primary)' }};">{{ $grid->title }}</a>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Latest Section -->
            <div style="display: flex; gap: 12px; margin: 5px 0 25px 0; align-items: center; border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
                <div style="display: flex; align-items: center; gap: 8px;">
                     <span style="color: white; background: #ef4444; width: 36px; height: 36px; display: flex; align-items: center; justify-content: center; border-radius: 10px; font-size: 1rem; flex-shrink: 0; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);"><i class="fa-solid fa-fire"></i></span>
                     <span style="font-size: 1.1rem; font-weight: 700; color: var(--text-primary); text-transform: uppercase; letter-spacing: 0.5px;">Mới nhất</span>
                </div>
            </div>

            <!-- List Post -->
            @forelse($latestPosts as $post)
            <div class="post-list-item">
                <a href="{{ route('post.show', $post->slug) }}" class="post-list-thumb">
                    <div class="post-list-thumb-inner" style="background: {{ $post->thumbnail ? 'url(\''.asset($post->thumbnail).'\') center/cover' : ($post->color ?? 'linear-gradient(135deg, #475569, #334155)') }}; display:flex; align-items:center; justify-content:center; color:white;">
                        @if(!$post->thumbnail && $post->icon)
                        <i class="{{ $post->icon }} fa-4x"></i>
                        @endif
                    </div>
                </a>
                <div class="post-list-content">
                    <a href="{{ route('post.show', $post->slug) }}" class="post-title" style="font-size: 1.25rem;">{{ $post->title }}</a>
                    <div style="font-size: 0.85rem; color: var(--text-secondary); margin: 10px 0;"><i class="fa-regular fa-clock"></i> {{ $post->created_at->diffForHumans() }} &nbsp;&nbsp; <i class="fa-regular fa-comment"></i> {{ $post->comments_count }}</div>
                    <p style="color: var(--text-secondary); font-size: 0.95rem; margin: 0; line-height: 1.5;">{{ Str::limit($post->meta_description ?? strip_tags($post->content), 120) }}</p>
                </div>
            </div>
            @empty
            <div class="text-center text-muted my-5">
                Chưa có bài viết nào mới.
            </div>
            @endforelse

            <!-- Review Phim Section -->
            @if($movies->count() > 0)
            <div class="section-title d-flex justify-content-between align-items-center">
                <span>Review Phim Mới</span>
                <a href="{{ route('movies.index') }}" class="text-primary small text-decoration-none fw-bold" style="font-size: 0.8rem; text-transform: none;">Xem tất cả <i class="fa-solid fa-angle-right ms-1"></i></a>
            </div>
            <div class="post-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 35px; gap: 15px;">
                @foreach($movies as $movie)
                <div class="post-card" style="border: 0; background: transparent;">
                    <a href="{{ route('movies.show', $movie->slug) }}" style="display: block; position: relative; border-radius: 12px; overflow: hidden; height: 180px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
                        @if($movie->thumbnail)
                            <img src="{{ asset($movie->thumbnail) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s;">
                        @else
                            <div style="width: 100%; height: 100%; background: {{ $movie->color ?? '#1e293b' }}; display: flex; align-items: center; justify-content: center; color: white;">
                                <i class="{{ $movie->icon ?? 'fa-solid fa-film' }} fa-3x"></i>
                            </div>
                        @endif
                        <div style="position: absolute; bottom: 0; left: 0; width: 100%; padding: 10px; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); color: white;">
                             <div style="font-size: 0.7rem; opacity: 0.8; margin-bottom: 2px;">{{ $movie->genre }}</div>
                             <div style="font-size: 0.9rem; font-weight: 700; -webkit-line-clamp: 1; display: -webkit-box; -webkit-box-orient: vertical; overflow: hidden;">{{ $movie->title }}</div>
                        </div>
                        <div style="position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.6); color: #f59e0b; font-size: 0.75rem; padding: 2px 6px; border-radius: 4px; font-weight: bold; backdrop-filter: blur(4px);">
                            <i class="fa-solid fa-star"></i> {{ number_format($movie->rating, 1) }}
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
            @endif

            <!-- AI Account Store -->
            @if($aiProducts->count() > 0)
            <div class="section-title">Cửa Hàng Tài Khoản AI</div>
            <div class="post-grid" style="grid-template-columns: repeat(3, 1fr); margin-bottom: 35px; gap: 15px;">
                @foreach($aiProducts as $product)
                <div class="post-card" style="border: 1px solid #f1f5f9; padding: 10px; border-radius: 12px; transition: all 0.3s ease; position: relative; background: #fff;">
                    @if($product->badge_text)
                    <div style="position: absolute; top: 15px; left: 15px; z-index: 2; background: #ef4444; color: white; font-size: 0.75rem; padding: 2px 10px; border-radius: 20px; font-weight: 700; box-shadow: 0 4px 6px -1px rgba(239, 68, 68, 0.3);">{{ $product->badge_text }}</div>
                    @endif
                    <a href="{{ $product->url ?? '#' }}" target="_blank" style="display: block;">
                        <div class="post-thumb" style="height: 140px; background: {{ $product->image ? 'url(\''.asset($product->image).'\') center/contain no-repeat' : 'linear-gradient(135deg, #f8fafc, #f1f5f9)' }}; border-radius: 8px; margin-bottom: 12px; border: 1px solid #f8fafc;">
                            @if(!$product->image)
                            <i class="fa-solid fa-robot fa-3x" style="opacity: 0.1; color: #475569;"></i>
                            @endif
                        </div>
                    </a>
                    <div style="text-align: center;">
                        <a href="{{ $product->url ?? '#' }}" target="_blank" class="post-title" style="font-size: 1rem; font-weight: 700; margin-bottom: 5px; height: auto; -webkit-line-clamp: 1;">{{ $product->name }}</a>
                        <div style="margin-bottom: 10px;">
                            <span style="color: #ef4444; font-weight: 800; font-size: 1.1rem;">{{ number_format($product->price) }}đ</span>
                            @if($product->discount_price)
                            <br><small style="color: #94a3b8; text-decoration: line-through;">{{ number_format($product->discount_price) }}đ</small>
                            @endif
                        </div>
                        <a href="{{ route('store.checkout', $product->slug) }}" style="display: block; background: #1d4ed8; color: white; text-decoration: none; padding: 6px 0; border-radius: 8px; font-size: 0.85rem; font-weight: 600; transition: all 0.2s;">Mua ngay</a>
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Tiện ích (không thuộc bài viết) -->
            <div class="section-title">Tiện ích</div>
            <div class="post-grid" style="grid-template-columns: repeat(3, 1fr);">
                @foreach($utilities as $utility)
                <div class="post-card">
                    <a href="{{ $utility->url }}" style="display: block;">
                        <div class="post-thumb" style="height: 120px; background: {{ $utility->color }}; display:flex; align-items:center; justify-content:center; color:white;"><i class="{{ $utility->icon }} fa-3x"></i></div>
                    </a>
                    <a href="{{ $utility->url }}" class="post-title" style="font-size: 1rem; font-weight: 500;">
                        {{ $utility->title }}
                        @if($utility->description)
                        <br><span style="color: var(--text-secondary); font-weight: normal; font-size: 0.85rem;">{{ $utility->description === 'now()' ? now()->format('d/m/Y') : $utility->description }}</span>
                        @endif
                    </a>
                </div>
                @endforeach
            </div>
            
            <!-- Video -->
            @if($videoPosts->count() > 0)
            <div class="section-title">Nổi bật (Video / Media)</div>
            <div class="post-grid" style="grid-template-columns: repeat(3, 1fr);">
                @foreach($videoPosts as $video)
                <div class="post-card">
                    <a href="{{ route('post.show', $video->slug) }}" style="display: block;">
                        <div class="post-thumb" style="height: 110px; background: {{ $video->thumbnail ? 'url(\''.asset($video->thumbnail).'\') center/cover' : ($video->color ?? 'linear-gradient(135deg, #ec4899, #be185d)') }}; display:flex; align-items:center; justify-content:center; color:white;">
                            @if(!$video->thumbnail && $video->icon)
                            <i class="{{ $video->icon }} fa-3x"></i>
                            @endif
                        </div>
                    </a>
                    <a href="{{ route('post.show', $video->slug) }}" class="post-title" style="font-size: 0.95rem; font-weight: 500;">{{ Str::limit($video->title, 50) }}</a>
                </div>
                @endforeach
            </div>
            @endif

        </div>

        <!-- Cột Phải: Sidebar -->
        <div class="magazine-sidebar">
            <!-- Được đề cử -->
            @if($recommendedPosts->count() > 0)
            <div class="sidebar-widget">
                <h3 class="widget-title">Được đề cử</h3>
                <ul class="widget-list">
                    @foreach($recommendedPosts as $rec)
                    <li class="widget-item">
                        <a href="{{ route('post.show', $rec->slug) }}" style="display: block;">
                            <div class="widget-thumb" style="background: {{ $rec->thumbnail ? 'url(\''.asset($rec->thumbnail).'\') center/cover' : ($rec->color ?? 'linear-gradient(135deg, #e0f2fe, #bae6fd)') }}; display:flex; align-items:center; justify-content:center; color:rgba(0,0,0,0.5); border-radius: 4px;">
                                @if(!$rec->thumbnail && $rec->icon)
                                <i class="{{ $rec->icon }}" style="font-size: 1.5rem; color: #fff; text-shadow: 0 0 5px rgba(0,0,0,0.3);"></i>
                                @endif
                            </div>
                        </a>
                        <div class="widget-info">
                            <a href="{{ route('post.show', $rec->slug) }}" style="text-decoration:none;"><h4>{{ $rec->title }}</h4></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- AI Giá Rẻ - Shop Widget -->
            <div class="sidebar-widget">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="widget-title m-0">AI Giá Rẻ</h3>
                    <a href="{{ route('store.ai') }}" class="text-primary small text-decoration-none fw-bold">Tất cả <i class="fa-solid fa-angle-right ms-1"></i></a>
                </div>
                
                @if($aiProducts->count() > 0)
                    <div class="shop-sidebar-list">
                        @foreach($aiProducts->take(3) as $product)
                        <div class="download-item p-2 mb-2 border rounded-3 transition-all hover-bg-light" style="cursor: pointer;" onclick="window.location.href='{{ route('store.checkout', $product->slug) }}'">
                            <div class="download-icon shadow-sm" style="background: white; border: 1px solid #f1f5f9; padding: 5px;">
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" class="w-100 h-100 object-fit-contain" alt="{{ $product->name }}">
                                @else
                                    <i class="fa-solid fa-robot text-primary"></i>
                                @endif
                            </div>
                            <div class="download-info ms-2" style="flex:1;">
                                <h4 class="m-0 text-dark-800" style="font-size: 0.9rem; -webkit-line-clamp: 1;">{{ $product->name }}</h4>
                                <div class="d-flex align-items-center gap-2 mt-1">
                                    <span class="text-danger fw-bold small">{{ number_format($product->price) }}đ</span>
                                    @if($product->discount_price)
                                        <span class="text-muted small text-decoration-line-through" style="font-size: 0.7rem;">{{ number_format($product->discount_price) }}đ</span>
                                    @endif
                                </div>
                            </div>
                            <div class="ms-auto">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-2 py-1" style="font-size: 0.65rem;">Mua</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 bg-light rounded-3 border">
                        <i class="fa-solid fa-store opacity-20 display-6 mb-2"></i>
                        <p class="text-muted small mb-0">Gian hàng đang cập nhật</p>
                    </div>
                @endif
            </div>
            <!-- Học IT Miễn Phí - Sidebar Widget -->
            <div class="sidebar-widget mt-4">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h3 class="widget-title m-0">Học IT Miễn Phí</h3>
                    <a href="{{ route('course.index') }}" class="text-primary small text-decoration-none fw-bold">Tất cả <i class="fa-solid fa-angle-right ms-1"></i></a>
                </div>
                
                @if($courses->count() > 0)
                    <div class="course-sidebar-list">
                        @foreach($courses as $course)
                        <a href="{{ route('course.detail', $course->slug) }}" class="text-decoration-none">
                            <div class="d-flex align-items-center gap-3 p-2 mb-2 border-bottom hover-bg-light transition-all">
                                <div class="course-thumb-mini rounded-2 overflow-hidden" style="width: 60px; height: 60px; flex-shrink: 0;">
                                    @if($course->thumbnail)
                                        <img src="{{ $course->thumbnail }}" class="w-100 h-100 object-fit-cover" alt="{{ $course->title }}">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-primary-subtle text-primary">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="course-info-mini">
                                    <h4 class="m-0 text-dark fw-bold" style="font-size: 0.85rem; line-height: 1.3;">{{ $course->title }}</h4>
                                    <div class="small text-muted mt-1" style="font-size: 0.7rem;">
                                        <span class="badge bg-light text-dark border me-1">{{ $course->level }}</span>
                                        <span>{{ $course->lessons->count() }} bài học</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 bg-light rounded-3 border">
                        <i class="fa-solid fa-graduation-cap opacity-20 display-6 mb-2"></i>
                        <p class="text-muted small mb-0">Khóa học đang chuẩn bị</p>
                    </div>
                @endif
            </div>

            <!-- Có thể bạn quan tâm (Dịch vụ Buff) -->
            @if($interestServices->count() > 0)
            <div class="sidebar-widget">
                <h3 class="widget-title">Dịch vụ nổi bật</h3>
                <ul class="widget-list">
                    @foreach($interestServices as $service)
                    <li class="widget-item">
                        <a href="{{ route('social.buff', $service->slug) }}" class="widget-thumb bg-primary-subtle d-flex align-items-center justify-content-center" style="border-radius: 6px; text-decoration: none;">
                            <i class="{{ $service->icon }} text-primary fs-5"></i>
                        </a>
                        <div class="widget-info">
                            <a href="{{ route('social.buff', $service->slug) }}" class="text-decoration-none">
                                <h4 class="fw-bold mb-1" style="font-size: 0.9rem;">{{ $service->name }}</h4>
                                <div class="small text-muted" style="font-size: 0.75rem;">Chất lượng & Uy tín</div>
                            </a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>
</div>

