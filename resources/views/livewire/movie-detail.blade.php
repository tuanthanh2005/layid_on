<div class="magazine-container">
    <div class="magazine-main">
        <!-- Breadcrumb -->
        <div style="font-size: 0.9rem; margin-bottom: 20px;">
            <a href="/" style="color: var(--accent-primary); text-decoration: none;">Trang chủ</a> 
            <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem; color: var(--text-secondary); margin: 0 8px;"></i>
            <a href="{{ route('movies.index') }}" style="color: var(--accent-primary); text-decoration: none;">Review Phim</a>
            <i class="fa-solid fa-chevron-right" style="font-size: 0.7rem; color: var(--text-secondary); margin: 0 8px;"></i>
            <span style="color: var(--text-secondary); display: inline-block; max-width: 250px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; vertical-align: middle;">{{ $movie->title }}</span>
        </div>

        <!-- Article Title -->
        <h1 style="font-size: 2.2rem; line-height: 1.3; color: var(--text-primary); margin-bottom: 15px; font-weight: 800;">
            {{ $movie->title }}
        </h1>
        
        <!-- Authors & Meta -->
        <div style="display: flex; align-items: center; gap: 15px; margin-bottom: 30px; border-bottom: 1px solid var(--border-color); padding-bottom: 15px; flex-wrap: wrap;">
            <div style="display: flex; align-items: center; gap: 10px;">
                <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff&rounded=true" alt="Author" style="width: 40px; height: 40px;">
                <div>
                    <div style="font-weight: bold; color: var(--text-primary);">Ban Biên Tập Layid</div>
                    <div style="font-size: 0.85rem; color: var(--text-secondary);">
                        <i class="fa-regular fa-clock"></i> {{ $movie->updated_at->diffForHumans() }} • 
                        <i class="fa-solid fa-eye ms-2"></i> {{ number_format($movie->views) }} lượt xem
                    </div>
                </div>
            </div>
            
             <!-- Rating Badge -->
            <div style="margin-left: auto; text-align: right;">
                <div style="font-size: 0.85rem; color: var(--text-secondary); font-weight: bold; margin-bottom: 3px;">Layid Đánh Giá</div>
                <div class="d-flex align-items-center gap-2">
                    <div style="color: #f59e0b;">
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
                    <span style="background: {{ $movie->rating >= 4 ? '#ef4444' : '#f59e0b' }}; color: white; border-radius: 4px; padding: 2px 6px; font-size: 0.85rem; font-weight: bold;">{{ number_format($movie->rating, 1) }}/5</span>
                </div>
            </div>
        </div>

        <!-- Movie Info Grid -->
        <div style="background: var(--bg-card); border-radius: 12px; padding: 25px; margin-bottom: 30px; border: 1px solid var(--border-color); display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px;">
            @if($movie->original_title)<div><span class="text-muted small d-block">Tên gốc:</span> <span class="fw-bold">{{ $movie->original_title }}</span></div>@endif
            @if($movie->genre)<div><span class="text-muted small d-block">Thể loại:</span> <span class="fw-bold">{{ $movie->genre }}</span></div>@endif
            @if($movie->country)<div><span class="text-muted small d-block">Quốc gia:</span> <span class="fw-bold">{{ $movie->country }}</span></div>@endif
            @if($movie->director)<div><span class="text-muted small d-block">Đạo diễn:</span> <span class="fw-bold">{{ $movie->director }}</span></div>@endif
            @if($movie->release_year)<div><span class="text-muted small d-block">Năm phát hành:</span> <span class="fw-bold">{{ $movie->release_year }}</span></div>@endif
            @if($movie->duration_text)<div><span class="text-muted small d-block">Thời lượng:</span> <span class="fw-bold">{{ $movie->duration_text }}</span></div>@endif
        </div>

        <!-- Summary / Sapô -->
        @if($movie->summary)
        <p style="font-size: 1.15rem; font-weight: 500; color: var(--text-primary); line-height: 1.7; margin-bottom: 30px; background: rgba(59, 130, 246, 0.05); padding: 20px; border-radius: 10px; border-left: 5px solid #3b82f6;">
            <strong>Tóm tắt:</strong> {{ $movie->summary }}
        </p>
        @endif

        <!-- Main Banner Image -->
        @if($movie->thumbnail)
        <div style="width: 100%; height: 420px; border-radius: 12px; overflow: hidden; margin-bottom: 30px; box-shadow: var(--shadow-sm);">
            <img src="{{ asset($movie->thumbnail) }}" alt="{{ $movie->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
        @endif

        <!-- Article Body Content -->
        <div class="article-content" style="font-size: 1.1rem; line-height: 1.8; color: var(--text-primary);">
            {!! $movie->content !!}
        </div>

        <!-- Trailer Section -->
        @if($movie->trailer_url)
        <div style="margin-top: 50px;">
            <h3 style="margin-bottom: 20px; font-weight: 800; border-left: 4px solid #ef4444; padding-left: 15px;">Trailer Phim</h3>
            <div style="border-radius: 12px; overflow: hidden; box-shadow: var(--shadow-md);">
                @php
                    $videoID = '';
                    if (strpos($movie->trailer_url, 'v=') !== false) {
                        $parts = explode('v=', $movie->trailer_url);
                        $videoID = explode('&', $parts[1])[0];
                    } elseif (strpos($movie->trailer_url, 'youtu.be/') !== false) {
                        $videoID = substr($movie->trailer_url, strpos($movie->trailer_url, 'youtu.be/') + 9);
                    }
                @endphp
                @if($videoID)
                    <iframe width="100%" height="450" src="https://www.youtube.com/embed/{{ $videoID }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <a href="{{ $movie->trailer_url }}" target="_blank" class="btn btn-danger w-100 py-3 fw-bold">Xem Trailer trên YouTube <i class="fa-brands fa-youtube ms-2"></i></a>
                @endif
            </div>
        </div>
        @endif

        <!-- Social Share/Tags -->
        <div style="margin-top: 50px; padding-top: 25px; border-top: 1px solid var(--border-color); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 20px;">
            <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                @foreach($movie->tags_array as $tag)
                <span style="background: #f1f5f9; color: #475569; padding: 6px 15px; border-radius: 20px; font-size: 0.85rem; font-weight: 500;">#{{ $tag }}</span>
                @endforeach
            </div>
            <div style="display: flex; gap: 15px; font-size: 1.6rem;">
                <span class="small text-muted me-2 align-self-center">Chia sẻ:</span>
                <a href="#" style="color: #1877f2;"><i class="fa-brands fa-facebook-square"></i></a>
                <a href="#" style="color: #1da1f2;"><i class="fa-brands fa-twitter-square"></i></a>
                <a href="#" style="color: #25d366;"><i class="fa-brands fa-whatsapp-square"></i></a>
            </div>
        </div>

    </div>

    <!-- Cột Phải: Sidebar -->
    <div class="magazine-sidebar">
        <!-- Có thể bạn quan tâm (Interested Movies) -->
        <div class="sidebar-widget">
            <h3 class="widget-title">Có thể bạn quan tâm</h3>
            @if($interestedMovies->count() > 0)
            <ul class="widget-list">
                @foreach($interestedMovies as $im)
                <li class="widget-item" style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                    <a wire:navigate href="{{ route('movies.show', $im->slug) }}" style="display:flex; align-items:flex-start; gap:12px; text-decoration:none;">
                        <div class="widget-thumb" style="width: 70px; height: 95px; border-radius: 6px; overflow:hidden; flex-shrink:0;">
                            @if($im->thumbnail)
                                <img src="{{ asset($im->thumbnail) }}" alt="{{ $im->title }}" style="width:100%; height:100%; object-fit:cover;">
                            @else
                                <div style="width:100%; height:100%; background: {{ $im->color ?? '#1e293b' }}; display:flex; align-items:center; justify-content:center; color:white;">
                                    <i class="{{ $im->icon ?? 'fa-solid fa-film' }}" style="font-size:1.2rem;"></i>
                                </div>
                            @endif
                        </div>
                        <div class="widget-info" style="flex:1; min-width:0;">
                            <h4 style="font-size: 0.9rem; margin:0 0 5px; line-height:1.4; font-weight:700; color:var(--text-primary); overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ $im->title }}</h4>
                            <div style="font-size: 0.75rem; color: #f59e0b;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa-solid fa-star" style="font-size: 9px; color: {{ $i <= $im->rating ? '#f59e0b' : '#cbd5e1' }};"></i>
                                @endfor
                                <span class="ms-1 text-muted">{{ number_format($im->rating, 1) }}</span>
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="small text-muted text-center py-3">Chưa có đề xuất phù hợp.</p>
            @endif
        </div>
        
        <!-- Phim Đề Xuất (Trending) -->
        <div class="sidebar-widget" style="margin-top: 40px;">
            <h3 class="widget-title">Phim TOP Trending</h3>
            @if($trendingMovies->count() > 0)
            <ul class="widget-list">
                @foreach($trendingMovies as $tm)
                <li class="widget-item" style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                    <a wire:navigate href="{{ route('movies.show', $tm->slug) }}" style="display:flex; align-items:center; gap:12px; text-decoration:none;">
                        <div class="widget-thumb" style="width: 60px; height: 80px; border-radius: 6px; overflow:hidden; flex-shrink:0;">
                             @if($tm->thumbnail)
                                <img src="{{ asset($tm->thumbnail) }}" alt="{{ $tm->title }}" style="width:100%; height:100%; object-fit:cover;">
                             @else
                                <div style="width:100%; height:100%; background: {{ $tm->color ?? '#334155' }}; display:flex; align-items:center; justify-content:center; color:white;">
                                    <i class="{{ $tm->icon ?? 'fa-solid fa-clapperboard' }}" style="font-size:1rem;"></i>
                                </div>
                             @endif
                        </div>
                        <div class="widget-info" style="flex:1; min-width:0;">
                            <h4 style="font-size: 0.88rem; margin:0 0 4px; line-height:1.4; font-weight:700; color:var(--text-primary); overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical;">{{ $tm->title }}</h4>
                            <div style="font-size: 0.73rem; color: var(--text-secondary);">
                                <i class="fa-solid fa-eye me-1"></i> {{ number_format($tm->views) }} lượt xem
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <p class="small text-muted text-center py-3">Vẫn đang cập nhật bảng xếp hạng.</p>
            @endif
        </div>

        <!-- Banner Ad placeholder -->
        <div class="mt-4 rounded-4 shadow-sm" style="background: #f8fafc; border: 1px dashed #cbd5e1; height: 300px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 0.9rem;">
            Quảng cáo / Banner
        </div>
    </div>
</div>

<style>
    .article-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 25px 0;
        box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    }
    .article-content h2 { margin: 40px 0 20px; font-weight: 800; color: var(--text-primary); font-size: 1.7rem; }
    .article-content h3 { margin: 30px 0 15px; font-weight: 700; color: var(--text-primary); font-size: 1.4rem; }
    .article-content blockquote { font-style: italic; border-left: 5px solid #10b981; padding: 20px; background: #f0fdf4; border-radius: 8px; margin: 30px 0; }
</style>
