<div class="course-list-page pb-5" style="padding-top: 30px;">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="fw-bold mb-2" style="font-size: 2.5rem; color: var(--text-primary);">Học Ngôn Ngữ Miễn Phí</h1>
            <p class="text-muted">Tổng hợp kiến thức lập trình, thủ thuật công nghệ từ cơ bản đến nâng cao hoàn toàn miễn phí.</p>
        </div>

        <div class="row g-4">
            @forelse($courses as $course)
            <div class="col-lg-4 col-md-6">
                <div class="course-card h-100 bg-white shadow-sm rounded-4 overflow-hidden border border-light transition-all">
                    <a href="{{ route('course.detail', $course->slug) }}" class="d-block overflow-hidden" style="height: 200px;">
                        @if($course->thumbnail)
                            <img src="{{ $course->thumbnail }}" class="w-100 h-100 object-fit-cover transition-img" alt="{{ $course->title }}">
                        @else
                            <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center bg-primary-subtle text-primary">
                                <i class="fa-solid fa-graduation-cap fa-3x mb-2"></i>
                                <span class="small fw-bold">CHƯA CÓ ẢNH</span>
                            </div>
                        @endif
                    </a>
                    <div class="p-4 d-flex flex-column justify-content-between" style="min-height: 180px;">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1" style="font-size: 0.7rem;">{{ $course->level }}</span>
                                <span class="text-muted small"><i class="fa-regular fa-clock me-1"></i>{{ $course->duration }}</span>
                            </div>
                            <h3 style="font-size: 1.2rem; line-height: 1.4;" class="fw-bold mb-3">
                                <a href="{{ route('course.detail', $course->slug) }}" class="text-dark text-decoration-none hover-primary">{{ $course->title }}</a>
                            </h3>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-auto">
                            <div class="lessons-count small text-muted">
                                <i class="fa-solid fa-play-circle me-1"></i> {{ $course->lessons->count() }} bài học
                            </div>
                            <a href="{{ route('course.detail', $course->slug) }}" class="btn btn-primary rounded-pill px-4 btn-sm shadow-sm transition-all">Học ngay</a>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="opacity-50 mb-3">
                    <i class="fa-solid fa-box-open fa-3x text-muted"></i>
                </div>
                <h4 class="text-muted">Hiện tại chưa có khóa học nào được đăng tải.</h4>
            </div>
            @endforelse
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $courses->links() }}
        </div>
    </div>
</div>

<style>
    .transition-all { transition: all 0.3s ease; }
    .course-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px -5px rgba(0,0,0,0.1) !important; border-color: var(--accent-primary) !important; }
    .transition-img { transition: transform 0.5s ease; }
    .course-card:hover .transition-img { transform: scale(1.1); }
    .hover-primary:hover { color: var(--accent-primary) !important; }
    .object-fit-cover { object-fit: cover; }
    .bg-primary-subtle { background-color: #ebf5ff; }
</style>
