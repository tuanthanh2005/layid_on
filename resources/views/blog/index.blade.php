@extends('layouts.app')

@section('content')
<div class="blog-container py-5">
    <div class="blog-header text-center mb-5">
        <h1 class="fw-bold display-5 mb-3">Kiến thức <span class="highlight">Công nghệ & AI</span></h1>
        <p class="text-muted lead">Chia sẻ thủ thuật, kinh nghiệm sử dụng AI và các công cụ công nghệ mới nhất.</p>
        
        <div class="search-blog-wrapper mt-4 mx-auto" style="max-width: 600px;">
            <form action="{{ route('blog.index') }}" method="GET" class="search-bar w-100" style="display: flex;">
                <input type="text" name="q" placeholder="Tìm kiếm bài viết..." value="{{ request('q') }}" class="flex-grow-1">
                <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i> Tìm kiếm</button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
        <div class="col-lg-4 col-md-6">
            <article class="blog-card h-100">
                <a href="{{ route('blog.show', $post->slug) }}" class="blog-image-link">
                    @if($post->thumbnail)
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="blog-thumb-bg">
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="blog-thumb">
                    @else
                        <div class="blog-thumb-placeholder" style="background: {{ $post->color ?? 'var(--accent-primary)' }}">
                            <i class="{{ $post->icon ?? 'fa-solid fa-newspaper' }}"></i>
                        </div>
                    @endif
                </a>
                <div class="blog-content">
                    <div class="blog-meta mb-2">
                        <span class="badge bg-soft-primary text-primary me-2">
                            <i class="fa-regular fa-calendar-days me-1"></i> {{ $post->created_at->format('d/m/Y') }}
                        </span>
                        <span class="text-muted small">
                            <i class="fa-regular fa-eye me-1"></i> {{ number_format($post->views) }} lượt xem
                        </span>
                    </div>
                    <h3 class="blog-title">
                        <a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="blog-excerpt text-muted">
                        {{ Str::limit(strip_tags($post->content), 120) }}
                    </p>
                    <a href="{{ route('blog.show', $post->slug) }}" class="read-more">
                        Đọc tiếp <i class="fa-solid fa-arrow-right ms-1"></i>
                    </a>
                </div>
            </article>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <div class="empty-state">
                <i class="fa-solid fa-magnifying-glass fa-4x mb-3 text-muted"></i>
                <h3>Không tìm thấy bài viết nào</h3>
                <p class="text-muted">Thử tìm kiếm với từ khóa khác nhé!</p>
                <a href="{{ route('blog.index') }}" class="btn btn-primary mt-3">Xem tất cả bài viết</a>
            </div>
        </div>
        @endforelse
    </div>

    <div class="mt-5 d-flex justify-content-center">
        {{ $posts->links() }}
    </div>
</div>

<style>
    .blog-card {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid var(--border-color);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }
    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        border-color: var(--accent-primary);
    }
    .blog-image-link {
        display: block;
        width: 100%;
        height: 240px;
        overflow: hidden;
        position: relative;
        background-color: #f1f5f9;
        isolation: isolate;
    }
    /* Blur Background Strategy */
    .blog-thumb-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: blur(20px) brightness(0.9);
        transform: scale(1.1);
        z-index: -1;
        opacity: 0.6;
    }
    .blog-thumb {
        width: 100%;
        height: 100%;
        object-fit: contain; /* Prevent cropping */
        transition: transform 0.5s ease;
        position: relative;
        z-index: 1;
    }
    .blog-card:hover .blog-thumb {
        transform: scale(1.03);
    }
    .blog-thumb-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3rem;
    }
    .blog-content {
        padding: 24px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }
    .blog-title {
        font-size: 1.25rem;
        font-weight: 700;
        line-height: 1.4;
        margin-bottom: 12px;
    }
    .blog-title a {
        color: var(--text-primary);
        text-decoration: none;
        transition: color 0.2s;
    }
    .blog-title a:hover {
        color: var(--accent-primary);
    }
    .blog-excerpt {
        font-size: 0.95rem;
        margin-bottom: 20px;
        flex-grow: 1;
    }
    .read-more {
        font-weight: 600;
        text-decoration: none;
        color: var(--accent-primary);
        display: inline-flex;
        align-items: center;
        transition: gap 0.2s;
    }
    .read-more:hover {
        gap: 8px;
    }
    .bg-soft-primary {
        background-color: rgba(16, 185, 129, 0.1);
    }
</style>
@endsection
