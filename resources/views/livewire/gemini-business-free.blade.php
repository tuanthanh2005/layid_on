<div class="py-5 bg-white">
    <div class="container py-lg-5">
        <div class="row justify-content-center text-center">
            <!-- Header Section -->
            <div class="col-lg-10 col-xl-8">
                @if($mainPost)
                    <div class="article-header mb-5">
                        <div class="mb-4 d-flex justify-content-center gap-2 flex-wrap">
                            <span class="px-3 py-1 badge bg-primary-subtle text-primary rounded-pill fw-bold small text-uppercase tracking-wider">
                                <i class="fa-solid fa-lightbulb me-1"></i> Trick & Guide
                            </span>
                            <a href="{{ route('tools.remove-gemini') }}" class="px-3 py-1 badge bg-dark text-white rounded-pill fw-medium small text-decoration-none hover-elevation transition-all d-inline-flex align-items-center">
                                <i class="fa-solid fa-eraser me-2"></i> Xóa Logo Gemini
                            </a>
                        </div>
                        
                        <h1 class="fw-800 text-dark mb-4 lh-tight" style="font-size: clamp(2rem, 5vw, 3.5rem);">
                            {{ $mainPost->title }}
                        </h1>
                        
                        <div class="d-flex align-items-center justify-content-center gap-4 text-muted small flex-wrap mb-5">
                            <div class="d-flex align-items-center gap-2">
                                <i class="fa-solid fa-circle-user fs-5 text-primary"></i>
                                <span class="fw-medium">Admin TechTools</span>
                            </div>
                            <span class="d-flex align-items-center gap-2">
                                <i class="fa-regular fa-clock fs-6"></i>
                                {{ $mainPost->created_at->translatedFormat('d M, Y') }}
                            </span>
                            <span class="d-flex align-items-center gap-2">
                                <i class="fa-regular fa-eye fs-6"></i>
                                {{ number_format(rand(1000, 3000)) }} lượt xem
                            </span>
                        </div>

                        @if($mainPost->image)
                            <div class="rounded-4 shadow-lg overflow-hidden mb-5 mx-auto" style="max-width: 900px;">
                                <img src="{{ asset($mainPost->image) }}" class="w-100 h-100 object-fit-cover" style="max-height: 500px;" alt="{{ $mainPost->title }}">
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <!-- Article Body -->
            <div class="col-lg-10 col-xl-8">
                @if($mainPost)
                    <div class="content-wrapper">
                        <article class="article-body-text mb-5">
                            {!! $mainPost->content !!}
                        </article>

                        <div class="py-5 border-top border-bottom mb-5 d-flex flex-column flex-md-row justify-content-between align-items-center gap-4">
                            <div class="text-muted small fw-bold text-uppercase tracking-widest">Chia sẻ thủ thuật này</div>
                            <div class="d-flex gap-3">
                                <a href="#" class="social-btn"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="social-btn"><i class="fa-brands fa-telegram-plane"></i></a>
                                <button class="social-btn border-0 bg-transparent" onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!')"><i class="fa-solid fa-link"></i></button>
                            </div>
                        </div>

                        <!-- Other Guides -->
                        @if($otherPosts->isNotEmpty())
                            <div class="mt-5 pt-4">
                                <div class="text-center mb-5">
                                    <h3 class="fw-bold h2 mb-4">Hướng dẫn liên quan</h3>
                                    <div class="mx-auto bg-primary rounded-pill" style="width: 60px; height: 4px; opacity: 0.2"></div>
                                </div>
                                <div class="row g-4">
                                    @foreach($otherPosts as $post)
                                        <div class="col-md-6 col-lg-4">
                                            <a href="{{ route('gemini.business', ['slug' => $post->slug]) }}" class="text-decoration-none card-hover">
                                                <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden">
                                                    @if($post->image)
                                                        <div class="bg-light overflow-hidden" style="height: 160px;">
                                                            <img src="{{ asset($post->image) }}" class="w-100 h-100 object-fit-cover transition-transform" alt="{{ $post->title }}">
                                                        </div>
                                                    @endif
                                                    <div class="card-body p-4">
                                                        <h5 class="fw-bold text-dark line-clamp-2 mb-0">{{ $post->title }}</h5>
                                                        <p class="mt-3 text-primary small fw-bold mb-0">Xem hướng dẫn <i class="fa-solid fa-arrow-right ms-1"></i></p>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="py-5 text-center px-4">
                            <div class="display-1 text-muted opacity-10 mb-4"><i class="fa-solid fa-pen-nib"></i></div>
                            <h2 class="fw-bold">Nội dung đang được cập nhật</h2>
                            <p class="text-muted mx-auto mb-4" style="max-width: 500px;">Hệ thống đang chuẩn bị các hướng dẫn tốt nhất cho bạn. Vui lòng quay lại sau.</p>
                            <a href="{{ route('home') }}" class="btn btn-primary rounded-pill px-5">Về trang chủ</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');

    .fw-800 { font-weight: 800; }
    .tracking-widest { letter-spacing: 0.15em; }
    
    .article-body-text {
        font-family: 'Inter', sans-serif;
        font-size: 1.15rem;
        line-height: 1.85;
        color: #334155;
    }
    .article-body-text p { margin-bottom: 2rem; }
    .article-body-text h2, .article-body-text h3 {
        margin-top: 3.5rem;
        margin-bottom: 1.5rem;
        font-weight: 800;
        color: #0f172a;
    }
    .article-body-text img {
        max-width: 100%;
        height: auto;
        border-radius: 1.25rem;
        margin: 3rem auto;
        display: block;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
    }

    .social-btn {
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: #f8fafc;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #64748b;
        transition: all 0.3s;
        text-decoration: none;
        border: 1px solid #e2e8f0;
    }
    .social-btn:hover {
        background: #2563eb;
        color: white;
        border-color: #2563eb;
        transform: translateY(-3px);
    }

    .card-hover:hover .transition-transform { transform: scale(1.08); }
    .card-hover:hover .card { transform: translateY(-8px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1) !important; }
    .transition-transform { transition: transform 0.6s cubic-bezier(0.165, 0.84, 0.44, 1); }
    .card { transition: all 0.3s ease; }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    @media (max-width: 768px) {
        .article-body-text { font-size: 1.05rem; }
    }
</style>


