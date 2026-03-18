<div class="course-detail-page pb-5">
    <div class="container-fluid px-0">
        <!-- Video Player Section -->
        <div class="bg-dark text-white py-4" style="min-height: 50vh; background: #0f172a !important;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @if($currentLesson)
                            <div class="video-container rounded-4 overflow-hidden shadow-lg bg-black mb-3" style="aspect-ratio: 16/9; position: relative;">
                                @if($currentLesson->video_type == 'youtube')
                                    @php
                                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $currentLesson->video_url, $matches);
                                        $videoId = $matches[1] ?? '';
                                    @endphp
                                    <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                @elseif($currentLesson->video_type == 'driver')
                                    @php
                                        // Extract driver ID
                                        preg_match('/[-\w]{25,}/', $currentLesson->video_url, $matches);
                                        $driverId = $matches[0] ?? '';
                                    @endphp
                                    <iframe src="https://drive.google.com/file/d/{{ $driverId }}/preview" width="100%" height="100%" allow="autoplay"></iframe>
                                @else
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center p-4">
                                        <i class="fa-solid fa-link fa-3x mb-3 text-muted"></i>
                                        <h4>Xem qua liên kết ngoài</h4>
                                        <p class="text-muted">Bài học này được chia sẻ qua liên kết bên dưới:</p>
                                        <a href="{{ $currentLesson->video_url }}" target="_blank" class="btn btn-primary rounded-pill px-4">Mở liên kết ngay <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i></a>
                                    </div>
                                @endif
                            </div>
                            <div class="lesson-header">
                                <h1 class="fw-bold h3 mb-2">{{ $currentLesson->title }}</h1>
                                <div class="d-flex align-items-center gap-3 text-muted small">
                                    <span><i class="fa-solid fa-graduation-cap me-1 text-primary"></i> {{ $course->title }}</span>
                                    <span><i class="fa-solid fa-clock me-1"></i> Cập nhật: {{ $currentLesson->updated_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center h-100 py-5">
                                <i class="fa-solid fa-film fa-4x mb-3 text-muted"></i>
                                <h3>Khóa học đang chuẩn bị nội dung</h3>
                            </div>
                        @endif
                    </div>
                    
                    <div class="col-lg-3">
                        <div class="lessons-sidebar bg-white rounded-4 overflow-hidden border mt-lg-0 mt-4 shadow-sm" style="height: calc(50vh + 60px);">
                            <div class="p-3 border-bottom bg-light">
                                <h5 class="m-0 fw-bold text-dark"><i class="fa-solid fa-list-ol me-2 text-primary"></i> Nội dung khóa học</h5>
                            </div>
                            <div class="lessons-list overflow-auto" style="height: calc(100% - 55px);">
                                @foreach($course->lessons as $lesson)
                                    <a wire:navigate href="{{ route('course.detail', ['slug' => $course->slug, 'lesson_slug' => $lesson->slug]) }}" 
                                       class="lesson-item p-3 d-flex align-items-start gap-2 border-bottom text-decoration-none transition-all {{ ($currentLesson && $currentLesson->id == $lesson->id) ? 'bg-primary-subtle border-start border-primary border-4' : 'text-dark' }}">
                                        <div class="mt-1">
                                            @if($currentLesson && $currentLesson->id == $lesson->id)
                                                <i class="fa-solid fa-play-circle text-primary"></i>
                                            @else
                                                <i class="fa-regular fa-circle-play text-muted"></i>
                                            @endif
                                        </div>
                                        <div style="flex:1;">
                                            <div class="fw-bold small {{ ($currentLesson && $currentLesson->id == $lesson->id) ? 'text-primary' : '' }}">{{ $lesson->title }}</div>
                                            <div class="extra-small text-muted mt-1">{{ $lesson->video_type == 'youtube' ? 'Video Youtube' : 'Tài liệu' }}</div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Course Content & Info -->
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8">
                    @if($currentLesson && $currentLesson->content)
                        <div class="lesson-content card border-0 shadow-sm rounded-4 p-4 mb-4">
                            <h4 class="fw-bold mb-3 border-bottom pb-2">Ghi chú & Tài liệu</h4>
                            <div class="content-body text-dark" style="line-height: 1.8;">
                                {!! nl2br(e($currentLesson->content)) !!}
                            </div>
                        </div>
                    @endif

                    <div class="course-info card border-0 shadow-sm rounded-4 p-4">
                        <h4 class="fw-bold mb-3">Về khóa học này</h4>
                        <div class="mb-4">
                            <p class="text-muted">{{ $course->description }}</p>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <div class="p-3 bg-light rounded-3 text-center h-100">
                                    <div class="text-primary fw-bold display-6 mb-1">{{ $course->lessons->count() }}</div>
                                    <div class="small text-muted fw-bold">BÀI HỌC</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 bg-light rounded-3 text-center h-100">
                                    <div class="text-success fw-bold display-6 mb-1">FREE</div>
                                    <div class="small text-muted fw-bold">CHI PHÍ</div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="p-3 bg-light rounded-3 text-center h-100">
                                    <div class="text-warning fw-bold display-6 mb-1">{{ $course->level }}</div>
                                    <div class="small text-muted fw-bold">TRÌNH ĐỘ</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar-sticky" style="top: 20px;">
                        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4 bg-primary text-white">
                            <h5 class="fw-bold mb-3">Tự học IT cùng Layid</h5>
                            <p class="small opacity-90">Tham gia cộng đồng học lập trình để nhận được sự hỗ trợ và chia sẻ tài liệu hữu ích nhất.</p>
                            <a href="#" class="btn btn-light rounded-pill w-100 fw-bold">Tham gia nhóm ngay</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .extra-small { font-size: 0.75rem; }
    .lesson-item:hover { background-color: #f8fafc; }
    .bg-primary-subtle { background-color: #ebf5ff !important; }
    .transition-all { transition: all 0.2s ease-in-out; }
    .lessons-list::-webkit-scrollbar { width: 4px; }
    .lessons-list::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
</style>
