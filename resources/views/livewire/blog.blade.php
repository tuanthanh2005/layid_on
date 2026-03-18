<div class="magazine-container">
    <!-- Cột Trái: Main Content -->
    <div class="magazine-main">

        <!-- Featured Post (Bài nổi bật) -->
        @if($featuredPost)
        <div class="featured-post" style="position: relative; border-radius: 12px; height: 380px; display: flex; align-items: flex-end; overflow: hidden; margin-bottom: 25px; box-shadow: var(--shadow-md);">
            @if($featuredPost->thumbnail)
                <div style="position: absolute; inset: 0; background: url('{{ asset($featuredPost->thumbnail) }}') center/cover; filter: brightness(0.4);"></div>
            @elseif($featuredPost->icon && $featuredPost->color)
                <div style="position: absolute; inset: 0; background: {{ $featuredPost->color }};"></div>
                <div style="position: absolute; inset: 0; display:flex; align-items:center; justify-content:center; opacity: 0.15;">
                    <i class="{{ $featuredPost->icon }}" style="font-size: 12rem; color: white;"></i>
                </div>
            @else
                <div style="position: absolute; inset: 0; background: linear-gradient(135deg, #1e293b, #0f172a);"></div>
            @endif

            <div style="position: absolute; top: 15px; left: 15px; background: rgba(59, 130, 246, 0.85); padding: 6px 12px; border-radius: 6px; display:flex; align-items:center; gap:6px; color:white; font-size:0.85rem; font-weight: 600; z-index: 2;">
                <i class="fa-solid fa-star"></i> NỔI BẬT
            </div>

            <div style="background: linear-gradient(to top, rgba(15,23,42,0.95), rgba(15,23,42,0.2)); width: 100%; padding: 30px; z-index: 1; position: relative; border-top: 1px solid rgba(255,255,255,0.05);">
                <a href="{{ route('post.show', $featuredPost->slug) }}" style="text-decoration:none;">
                    <h2 style="color: white; font-size: 1.8rem; margin: 0; font-weight: 800; line-height: 1.3;">{{ $featuredPost->title }}</h2>
                </a>
                @if($featuredPost->meta_description)
                <p style="color: #94a3b8; font-size: 0.95rem; margin: 10px 0 0 0; line-height: 1.6; max-width: 90%;">{{ Str::limit($featuredPost->meta_description, 180) }}</p>
                @endif
            </div>
        </div>
        @else
        <div class="featured-post" style="background: linear-gradient(135deg, #1e293b, #0f172a); position: relative; border-radius: 12px; height: 280px; display: flex; align-items: center; justify-content: center; margin-bottom: 25px; text-align: center; padding: 30px;">
            <div>
                <i class="fa-solid fa-newspaper fa-4x text-muted mb-3" style="opacity:.3;"></i>
                <h3 class="text-white mb-2">Blog & Mẹo Công Nghệ</h3>
                <p class="text-secondary">Cập nhật những kiến thức công nghệ mới nhất, thủ thuật AI và xu hướng số.</p>
            </div>
        </div>
        @endif

        <!-- Mô tả Blog -->
        <p style="color: var(--text-primary); font-size: 0.95rem; margin-bottom: 25px; line-height: 1.6;">
            Cập nhật những công nghệ mới nhất, đánh giá sản phẩm, thủ thuật phần mềm, bảo mật, AI, điện thoại, máy tính và xu hướng số.
        </p>
        <hr style="border:0; border-bottom: 2px solid var(--border-color); margin-bottom: 25px;">

        <!-- Danh sách bài viết -->
        <div style="display: flex; flex-direction: column; gap: 25px;">
            @forelse($posts as $post)
            <div class="post-list-item">
                <!-- Thumbnail -->
                <a href="{{ route('post.show', $post->slug) }}" class="post-list-thumb">
                    <div class="post-list-thumb-inner">
                        @if($post->thumbnail)
                            <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->title }}" style="width:100%; height:100%; object-fit:cover; transition: transform 0.3s;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @elseif($post->icon && $post->color)
                            <div style="width:100%; height:100%; background: {{ $post->color }}; display:flex; align-items:center; justify-content:center; color:white;">
                                <i class="{{ $post->icon }}" style="font-size: 3rem;"></i>
                            </div>
                        @else
                            <div style="width:100%; height:100%; background: linear-gradient(135deg, #334155, #475569); display:flex; align-items:center; justify-content:center; color:white;">
                                <i class="fa-solid fa-newspaper" style="font-size: 2.5rem; opacity:.5;"></i>
                            </div>
                        @endif
                    </div>
                </a>

                <div class="post-list-content">
                    <a href="{{ route('post.show', $post->slug) }}" class="post-title" style="font-size: 1.15rem; display: block; margin-bottom: 8px;">{{ $post->title }}</a>
                    <div style="font-size: 0.82rem; color: var(--text-secondary); margin-bottom: 8px; display:flex; align-items:center; gap:12px;">
                        <span><i class="fa-regular fa-clock me-1"></i>{{ $post->updated_at->diffForHumans() }}</span>
                        @if($post->views > 0)
                        <span><i class="fa-regular fa-eye me-1"></i>{{ number_format($post->views) }}</span>
                        @endif
                    </div>
                    <p style="color: var(--text-secondary); font-size: 0.9rem; margin: 0; line-height: 1.55; overflow: hidden; display:-webkit-box; -webkit-line-clamp:3; -webkit-box-orient:vertical;">
                        {{ $post->meta_description ?: Str::limit(strip_tags($post->content), 180) }}
                    </p>
                </div>
            </div>
            @empty
            <div class="text-center py-5">
                <i class="fa-solid fa-inbox fa-3x text-muted mb-3" style="opacity:.3;"></i>
                <p class="text-muted">Chưa có bài viết nào. Hãy quay lại sau nhé!</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-5 pt-4" style="border-top: 1px solid var(--border-color);">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Cột Phải: Sidebar -->
    <div class="magazine-sidebar">
        <div class="sidebar-widget">
            <h3 class="widget-title">Có thể bạn quan tâm</h3>
            @if($sidebarPosts->count() > 0)
            <ul class="widget-list">
                @foreach($sidebarPosts as $sp)
                <li class="widget-item" style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                    <a href="{{ route('post.show', $sp->slug) }}" style="display:flex; align-items:center; gap:10px; text-decoration:none;">
                        <div class="widget-thumb" style="width: 60px; height: 60px; border-radius: 6px; overflow:hidden; flex-shrink:0;
                            {{ $sp->thumbnail ? '' : 'background: ' . ($sp->color ?? 'linear-gradient(135deg, #e0f2fe, #bae6fd)') . '; display:flex; align-items:center; justify-content:center;' }}">
                            @if($sp->thumbnail)
                                <img src="{{ asset($sp->thumbnail) }}" alt="{{ $sp->title }}" style="width:100%; height:100%; object-fit:cover;">
                            @elseif($sp->icon)
                                <i class="{{ $sp->icon }}" style="color:white; font-size:1.3rem;"></i>
                            @endif
                        </div>
                        <div class="widget-info" style="flex:1; min-width:0;">
                            <h4 style="font-size: 0.88rem; margin:0 0 4px; line-height:1.4; overflow:hidden; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; color:var(--text-primary);">{{ $sp->title }}</h4>
                            <div style="font-size: 0.73rem; color: var(--text-secondary);">
                                <i class="fa-regular fa-clock"></i> {{ $sp->updated_at->diffForHumans() }}
                            </div>
                        </div>
                    </a>
                </li>
                @endforeach
            </ul>
            @else
            <div class="text-center py-4" style="color: var(--text-secondary);">
                <i class="fa-solid fa-bookmark fa-2x mb-2" style="opacity:.3;"></i>
                <p class="small">Chưa có bài viết được ghim vào đây.</p>
            </div>
            @endif
        </div>
    </div>
</div>
