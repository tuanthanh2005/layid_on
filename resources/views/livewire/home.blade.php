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
            <div style="display: flex; gap: 20px; margin-bottom: 25px; align-items: flex-start;">
                <a href="{{ route('post.show', $post->slug) }}" style="flex-shrink: 0; display: block;">
                    <div class="post-thumb" style="width: 280px; height: 160px; margin-bottom: 0; background: {{ $post->thumbnail ? 'url(\''.asset($post->thumbnail).'\') center/cover' : ($post->color ?? 'linear-gradient(135deg, #475569, #334155)') }}; display:flex; align-items:center; justify-content:center; color:white;">
                        @if(!$post->thumbnail && $post->icon)
                        <i class="{{ $post->icon }} fa-4x"></i>
                        @endif
                    </div>
                </a>
                <div>
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

            <!-- Download (Không thuộc quản lý bài viết nên giữ nguyên hiển thị tĩnh tĩnh hoặc CMS riêng) -->
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
            </div>

            <!-- Có thể bạn quan tâm -->
            @if($interestedPosts->count() > 0)
            <div class="sidebar-widget">
                <h3 class="widget-title">Có thể bạn quan tâm</h3>
                <ul class="widget-list">
                    @foreach($interestedPosts as $interest)
                    <li class="widget-item">
                        <a href="{{ route('post.show', $interest->slug) }}" style="display: block;">
                            <div class="widget-thumb" style="background: {{ $interest->thumbnail ? 'url(\''.asset($interest->thumbnail).'\') center/cover' : ($interest->color ?? 'linear-gradient(135deg, #bbf7d0, #86efac)') }}; border-radius: 4px; display:flex; align-items:center; justify-content:center;">
                                @if(!$interest->thumbnail && $interest->icon)
                                <i class="{{ $interest->icon }}" style="color:white; opacity: 0.8;"></i>
                                @endif
                            </div>
                        </a>
                        <div class="widget-info">
                            <a href="{{ route('post.show', $interest->slug) }}" style="text-decoration:none;"><h4>{{ $interest->title }}</h4></a>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif

        </div>
    </div>
</div>

