<div class="magazine-container">
    <div class="magazine-main">
        <!-- Header / Banner chính -->
        @if($featuredMovie && !$search && !$genre)
        <div class="featured-movie-banner mb-4" style="position: relative; border-radius: 12px; height: 350px; overflow: hidden; box-shadow: var(--shadow-md); display: flex; align-items: flex-end;">
            @if($featuredMovie->thumbnail)
                <img src="{{ asset($featuredMovie->thumbnail) }}" style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover; filter: brightness(0.5);">
            @else
                <div style="position: absolute; inset: 0; background: {{ $featuredMovie->color ?? 'linear-gradient(135deg, #1e293b, #0f172a)' }};"></div>
            @endif
            
            <div style="position: absolute; top: 20px; left: 20px; z-index: 2;">
                <span class="badge bg-danger px-3 py-2 rounded-pill fw-bold">PHIM HOT</span>
            </div>

            <div style="position: relative; z-index: 2; padding: 30px; width: 100%; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);">
                <a wire:navigate href="{{ route('movies.show', $featuredMovie->slug) }}" class="text-decoration-none">
                    <h1 style="color: white; font-size: 2.2rem; margin-bottom: 10px; font-weight: 800;">{{ $featuredMovie->title }}</h1>
                </a>
                <div class="d-flex gap-3 text-white-50 mb-3 small fw-medium">
                    <span><i class="fa-solid fa-calendar-days me-1"></i> {{ $featuredMovie->release_year }}</span>
                    <span><i class="fa-solid fa-clock me-1"></i> {{ $featuredMovie->duration_text }}</span>
                    <span><i class="fa-solid fa-earth-americas me-1"></i> {{ $featuredMovie->country }}</span>
                </div>
                <p style="color: #cbd5e1; font-size: 1rem; line-height: 1.6; max-width: 80%;" class="d-none d-md-block">
                    {{ Str::limit($featuredMovie->summary, 180) }}
                </p>
            </div>
        </div>
        @else
        <div style="margin-bottom: 30px;">
            <h1 style="font-size: 2rem; color: var(--text-primary); margin-bottom: 10px;">Review Phim Chiếu Rạp & Phim Mới</h1>
            <p style="color: var(--text-secondary); font-size: 1rem;">@if($search) Kết quả tìm kiếm cho: "<strong>{{ $search }}</strong>" @elseif($genre) Phim thể loại: "<strong>{{ $genre }}</strong>" @else Khám phá những bộ phim đáng xem nhất cùng Layid Review. @endif</p>
            <hr style="border: 0; border-bottom: 1px solid var(--border-color); margin-top: 15px;">
        </div>
        @endif

        <!-- Filter Bar -->
        <div class="mb-4 d-flex gap-3 flex-wrap">
            <div style="flex: 1; min-width: 250px; position: relative;">
                <i class="fa-solid fa-magnifying-glass" style="position: absolute; left: 15px; top: 50%; transform: translateY(-50%); color: #94a3b8;"></i>
                <input type="text" wire:model.live.debounce.400ms="search" placeholder="Tìm tên phim, nội dung..." style="width: 100%; padding: 12px 15px 12px 45px; border-radius: 12px; border: 1px solid var(--border-color); outline: none; background: white; font-size: 0.95rem; box-shadow: var(--shadow-sm);">
            </div>
            <div style="width: 180px;">
                <select wire:model.live="genre" style="width: 100%; padding: 12px 15px; border-radius: 12px; border: 1px solid var(--border-color); outline: none; background: white; font-size: 0.95rem; box-shadow: var(--shadow-sm); appearance: none; cursor: pointer;">
                    <option value="">Tất cả thể loại</option>
                    @foreach($genres as $g)
                        <option value="{{ $g }}">{{ $g }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Movie List -->
        <div style="display: flex; flex-direction: column; gap: 30px;">
            @forelse($movies as $movie)
            <div style="display: flex; gap: 20px; align-items: stretch; border-bottom: 1px solid var(--border-color); padding-bottom: 25px;">
                <a wire:navigate href="{{ route('movies.show', $movie->slug) }}" style="flex-shrink: 0; display: block; width: 250px; height: 160px; border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-sm);">
                    @if($movie->thumbnail)
                        <img src="{{ asset($movie->thumbnail) }}" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    @else
                        <div style="width: 100%; height: 100%; background: {{ $movie->color ?? '#f1f5f9' }}; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,0.8);">
                            @if($movie->icon)<i class="{{ $movie->icon }} fa-3x"></i>@else<i class="fa-solid fa-film fa-3x"></i>@endif
                        </div>
                    @endif
                </a>
                
                <div style="display: flex; flex-direction: column; justify-content: flex-start; gap: 8px; flex: 1;">
                    <div style="color: #94a3b8; font-size: 0.85rem;">{{ $movie->created_at->diffForHumans() }} • {{ $movie->genre }}</div>
                    <a wire:navigate href="{{ route('movies.show', $movie->slug) }}" style="text-decoration: none;">
                        <h2 style="font-size: 1.35rem; color: var(--text-primary); margin: 0; line-height: 1.4; font-weight: 700;">{{ $movie->title }}</h2>
                    </a>
                    
                    <div style="display: flex; align-items: center; gap: 5px; margin: 5px 0;">
                        <span style="font-size: 0.85rem; font-weight: bold; color: var(--text-secondary); margin-right: 5px;">Layid Đánh Giá: </span>
                        <div style="color: #f59e0b; font-size: 0.9rem;">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($movie->rating))
                                    <i class="fa-solid fa-star"></i>
                                @elseif($i == ceil($movie->rating) && $movie->rating != floor($movie->rating))
                                    <i class="fa-solid fa-star-half-stroke"></i>
                                @else
                                    <i class="fa-regular fa-star" style="color: #cbd5e1;"></i>
                                @endif
                            @endfor
                        </div>
                        @if($movie->rating_label)
                        <span style="background: {{ $movie->rating >= 4 ? '#ecfdf5' : '#fffbeb' }}; color: {{ $movie->rating >= 4 ? '#10b981' : '#f59e0b' }}; font-size: 0.75rem; padding: 2px 8px; border-radius: 12px; font-weight: bold; margin-left: 10px;">{{ $movie->rating_label }}</span>
                        @endif
                    </div>
                    
                    <p style="color: var(--text-secondary); font-size: 0.95rem; margin: 0; line-height: 1.6; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $movie->summary ?: Str::limit(strip_tags($movie->content), 150) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fa-solid fa-clapperboard fa-4x text-muted mb-3" style="opacity: 0.2"></i>
                <h4 class="text-muted">Chưa có bài review phim nào</h4>
                <p class="text-muted small">Hãy quay lại sau để cập nhật những bộ phim mới nhất nhé!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 pt-4">
            {{ $movies->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Cột Phải: Sidebar -->
    <div class="magazine-sidebar">
        <!-- Phim Đề Xuất -->
        <div class="sidebar-widget">
            <h3 class="widget-title">Phim Được Đề Xuất</h3>
            @if($sidebarMovies->count() > 0)
            <ul class="widget-list">
                @foreach($sidebarMovies as $sm)
                <li class="widget-item" style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                    <a href="{{ route('movies.show', $sm->slug) }}" class="text-decoration-none d-flex gap-3 align-items-center">
                        <div class="widget-thumb" style="width: 60px; height: 85px; border-radius: 6px; overflow: hidden; flex-shrink: 0;">
                            @if($sm->thumbnail)
                                <img src="{{ asset($sm->thumbnail) }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                <div style="width: 100%; height: 100%; background: {{ $sm->color ?? '#1e293b' }}; color: white; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: bold; text-align: center; padding: 5px;">
                                    @if($sm->icon)<i class="{{ $sm->icon }}"></i>@else{{ Str::limit($sm->genre, 10, '') }}@endif
                                </div>
                            @endif
                        </div>
                        <div class="widget-info" style="flex: 1; min-width: 0;">
                            <h4 style="font-size: 0.88rem; margin-bottom: 5px; line-height: 1.4; font-weight: 600; color: var(--text-primary); overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                                {{ $sm->title }}
                            </h4>
                            <div style="font-size: 0.75rem;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star" style="color: {{ $i <= $sm->rating ? '#f59e0b' : '#cbd5e1' }}; font-size: 10px;"></i>
                                @endfor
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="small text-muted text-center py-3">Chưa có đề xuất phim nào.</p>
            @endif
        </div>

        <!-- Sidebar Ads/Banner placeholder -->
        <div class="sidebar-widget mt-4 rounded-4 overflow-hidden" style="background: linear-gradient(135deg, #3b82f6, #1d4ed8); padding: 25px; color: white;">
            <h4 class="fw-bold mb-2">Review Phim Tận Tâm</h4>
            <p class="small mb-0 opacity-75">Cung cấp cái nhìn khách quan về điện ảnh trong và ngoài nước.</p>
        </div>
    </div>
</div>
