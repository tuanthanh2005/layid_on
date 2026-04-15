@extends('layouts.app')

@section('content')
<div class="post-detail-container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-9">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-decoration-none">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('blog.index') }}" class="text-decoration-none">Blog</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ Str::limit($post->title, 30) }}</li>
                </ol>
            </nav>

            <article class="post-main bg-white rounded-4 shadow-sm overflow-hidden border">
                @if($post->thumbnail)
                    <div class="post-header-image">
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="post-header-bg">
                        <img src="{{ $post->thumbnail }}" alt="{{ $post->title }}" class="main-img">
                    </div>
                @endif

                <div class="post-body p-4 p-md-5">
                    <div class="post-meta mb-3 d-flex align-items-center gap-3 flex-wrap">
                        <span class="badge bg-soft-primary text-primary px-3 py-2 rounded-pill">
                            <i class="fa-regular fa-calendar-days me-1"></i> {{ $post->created_at->format('d/m/Y') }}
                        </span>
                        <span class="text-muted small">
                            <i class="fa-regular fa-eye me-1"></i> {{ number_format($post->views) }} lượt xem
                        </span>
                    </div>

                    <h1 class="post-title fw-bold display-6 mb-4">{{ $post->title }}</h1>

                    <div class="post-content entry-content quill-content" style="line-height: 1.8; font-size: 1.1rem; color: #334155;">
                        {!! $post->content !!}
                    </div>

                    <div class="post-footer mt-5 pt-4 border-top">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div class="share-links d-flex align-items-center gap-3">
                                <span class="fw-bold text-muted small">Chia sẻ:</span>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="social-btn face">
                                    <i class="fa-brands fa-facebook-f"></i>
                                </a>
                                <a href="https://t.me/share/url?url={{ url()->current() }}&text={{ urlencode($post->title) }}" target="_blank" class="social-btn tele">
                                    <i class="fa-brands fa-telegram"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Posts -->
            @if($related->count() > 0)
            <div class="related-posts mt-5">
                <h3 class="fw-bold mb-4 d-flex align-items-center">
                    <i class="fa-solid fa-layer-group me-2 text-primary"></i> Bài viết liên quan
                </h3>
                <div class="row g-4">
                    @foreach($related as $rPost)
                        <div class="col-md-6 col-lg-3">
                            <div class="related-card h-100 bg-white rounded-3 border overflow-hidden transition-all shadow-sm">
                                <a href="{{ route('blog.show', $rPost->slug) }}" class="d-block overflow-hidden" style="height: 140px;">
                                    @if($rPost->thumbnail)
                                        <img src="{{ $rPost->thumbnail }}" alt="{{ $rPost->title }}" class="w-100 h-100 object-fit-cover transition-all" style="height: 140px;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-light text-primary fs-2">
                                            <i class="{{ $rPost->icon ?? 'fa-solid fa-newspaper' }}"></i>
                                        </div>
                                    @endif
                                </a>
                                <div class="p-3">
                                    <h5 class="fs-6 fw-bold mb-1" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 2.8rem;">
                                        <a href="{{ route('blog.show', $rPost->slug) }}" class="text-decoration-none text-dark hover-primary">{{ $rPost->title }}</a>
                                    </h5>
                                    <span class="text-muted extra-small" style="font-size: 0.75rem;">{{ $rPost->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
    .post-header-image {
        position: relative;
        background-color: #f8fafc;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 400px;
        max-height: 600px;
        isolation: isolate;
    }
    .post-header-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        filter: blur(40px) brightness(0.9);
        transform: scale(1.1);
        z-index: -1;
        opacity: 0.5;
    }
    .post-header-image img.main-img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        position: relative;
        z-index: 1;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
    .bg-soft-primary {
        background-color: rgba(16, 185, 129, 0.1);
    }
    .social-btn {
        width: 35px;
        height: 35px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: white;
        transition: transform 0.2s;
    }
    .social-btn:hover {
        transform: scale(1.1);
        color: white;
    }
    .social-btn.face { background: #1877f2; }
    .social-btn.tele { background: #0088cc; }
    
    .related-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        border-color: var(--accent-primary);
    }
    .related-card:hover img {
        transform: scale(1.05);
    }
    
    /* Post Content Styles */
    .post-content img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 20px 0;
    }
    .post-content p {
        margin-bottom: 20px;
    }
    .post-content h2, .post-content h3 {
        margin-top: 40px;
        margin-bottom: 20px;
        font-weight: 700;
        color: var(--text-primary);
    }
</style>
@endsection
