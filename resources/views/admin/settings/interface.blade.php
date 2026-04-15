@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="h3 mb-0 text-gray-800"><i data-lucide="palette" class="me-2"></i> Quản lý Giao diện & Nhận diện</h2>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show border-0 shadow-sm rounded-4" role="alert">
    <i data-lucide="check-circle" class="me-2"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="row">
        <!-- Cột Trái: Favicon & Logo -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold mb-4 text-start d-flex align-items-center">
                        <i data-lucide="image" class="me-2 text-primary" size="20"></i> Quản lý Favicon (Biểu tượng web)
                    </h5>
                    
                    <div class="favicon-preview mb-4 p-4 border rounded-4 bg-light d-inline-block position-relative">
                        <small class="position-absolute top-0 start-50 translate-middle badge bg-primary">Xem trước (32x32)</small>
                        <img src="{{ $settings['favicon'] ?? '/favicon.ico' }}" 
                             id="favicon_preview"
                             class="rounded shadow-sm bg-white" 
                             style="width: 64px; height: 64px; object-fit: contain; padding: 5px; border: 1px dashed #ccc;">
                    </div>
                    
                    <div class="mb-4 text-start">
                        <label class="form-label fw-semibold">Tải lên Favicon mới</label>
                        <input type="file" name="favicon_file" class="form-control" accept="image/*" onchange="previewImage(this, 'favicon_preview')">
                        <div class="text-muted small mt-2">
                            <i data-lucide="info" size="14" class="me-1"></i> 
                            Dùng định dạng <b>.png, .ico hoặc .svg</b>. Kích thước chuẩn là 32x32px.
                        </div>
                    </div>

                    <div class="mb-4 text-start">
                        <label class="form-label fw-semibold">Tiêu đề Website (SEO Title)</label>
                        <input type="text" name="site_title" class="form-control" value="{{ $settings['site_title'] ?? 'LayID Online' }}" placeholder="VD: LayID - Công cụ AI cực mạnh">
                    </div>

                    <div class="mb-0 text-start">
                        <label class="form-label fw-semibold">Mã xác minh Google (Meta Tag)</label>
                        <input type="text" name="google_verification" class="form-control" value="{{ $settings['google_verification'] ?? '' }}" placeholder="Dán mã meta verification ở đây">
                        <small class="text-muted small mt-1 d-block"><i data-lucide="info" size="14"></i> Chỉ dán mã (VD: CYV1H...), hệ thống sẽ tự tạo thẻ meta.</small>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cột Phải: Màu sắc chủ đạo (Theme) -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 rounded-4 h-100">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i data-lucide="paint-bucket" class="me-2 text-primary" size="20"></i> Màu sắc giao diện (Brand)
                    </h5>
                    
                    <!-- Primary Color -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block">Màu chính yếu (Primary Color)</label>
                        <div class="d-flex gap-3 align-items-center">
                            <input type="color" name="theme_color" class="form-control form-control-color border-0 p-0" id="color_pick_1" value="{{ $settings['theme_color'] ?? '#3b82f6' }}" style="width: 60px; height: 60px; border-radius: 12px; cursor: pointer;" oninput="document.getElementById('color_text_1').value = this.value">
                            <div class="flex-grow-1">
                                <input type="text" id="color_text_1" class="form-control fw-bold" value="{{ $settings['theme_color'] ?? '#3b82f6' }}" oninput="document.getElementById('color_pick_1').value = this.value">
                                <small class="text-muted">Màu này dùng cho Nút bấm, Icon chính, Link...</small>
                            </div>
                        </div>
                    </div>

                    <!-- Secondary Color -->
                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block">Màu thứ cấp (Secondary Color)</label>
                        <div class="d-flex gap-3 align-items-center">
                            <input type="color" name="theme_color_sub" class="form-control form-control-color border-0 p-0" id="color_pick_2" value="{{ $settings['theme_color_sub'] ?? '#1d4ed8' }}" style="width: 50px; height: 50px; border-radius: 12px; cursor: pointer;" oninput="document.getElementById('color_text_2').value = this.value">
                            <div class="flex-grow-1">
                                <input type="text" id="color_text_2" class="form-control fw-bold" value="{{ $settings['theme_color_sub'] ?? '#1d4ed8' }}" oninput="document.getElementById('color_pick_2').value = this.value">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <!-- Background Color -->
                        <div class="col-6 mb-4">
                            <label class="form-label fw-semibold d-block">Màu Nền Web</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" name="bg_color" class="form-control form-control-color border-0 p-0" id="color_pick_3" value="{{ $settings['bg_color'] ?? '#f8fafc' }}" style="width: 40px; height: 40px; border-radius: 8px; cursor: pointer;" oninput="document.getElementById('color_text_3').value = this.value">
                                <input type="text" id="color_text_3" class="form-control form-control-sm fw-bold" value="{{ $settings['bg_color'] ?? '#f8fafc' }}" oninput="document.getElementById('color_pick_3').value = this.value">
                            </div>
                        </div>
                        <!-- Text Color -->
                        <div class="col-6 mb-4">
                            <label class="form-label fw-semibold d-block">Màu Chữ Chính</label>
                            <div class="d-flex gap-2 align-items-center">
                                <input type="color" name="text_color" class="form-control form-control-color border-0 p-0" id="color_pick_4" value="{{ $settings['text_color'] ?? '#334155' }}" style="width: 40px; height: 40px; border-radius: 8px; cursor: pointer;" oninput="document.getElementById('color_text_4').value = this.value">
                                <input type="text" id="color_text_4" class="form-control form-control-sm fw-bold" value="{{ $settings['text_color'] ?? '#334155' }}" oninput="document.getElementById('color_pick_4').value = this.value">
                            </div>
                        </div>
                    </div>

                    <div class="alert alert-info rounded-4 py-2 border-0 small">
                        <i data-lucide="sparkles" size="16" class="me-1"></i> Mẹo: Hãy chọn màu phù hợp với logo của bạn để trang web trông uy tín hơn đối với cả người dùng và Google.
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Telegram Configuration -->
    <div class="row">
        <div class="col-12 mb-4">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-4">
                    <h5 class="fw-bold mb-4 d-flex align-items-center">
                        <i data-lucide="send" class="me-2 text-primary" size="20"></i> Thông báo Telegram Admin (Đơn hàng mới)
                    </h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Telegram Bot Token</label>
                            <input type="password" name="telegram_bot_token" class="form-control" value="{{ $settings['telegram_bot_token'] ?? '' }}" placeholder="VD: 123456789:ABCdefGHIjkl...">
                            <small class="text-muted">Lấy từ <a href="https://t.me/BotFather" target="_blank">@BotFather</a></small>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Admin Chat ID</label>
                            <input type="text" name="telegram_admin_chat_id" class="form-control" value="{{ $settings['telegram_admin_chat_id'] ?? '' }}" placeholder="VD: 123456789">
                            <small class="text-muted">Dùng <a href="https://t.me/userinfobot" target="_blank">@userinfobot</a> để lấy ID của bạn</small>
                        </div>
                    </div>
                    
                    <div class="alert alert-warning border-0 rounded-4 small mb-0">
                        <i data-lucide="bell" size="16" class="me-2"></i> Hệ thống sẽ tự động nhắn tin cho bạn qua Telegram ngay khi có người dùng thanh toán/tạo đơn hàng mới.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Nút thao tác -->
    <div class="text-end d-flex justify-content-end gap-3 mt-4">
        <button type="button" class="btn btn-outline-secondary px-4 py-2 fw-bold" onclick="resetToDefault()">
            <i data-lucide="rotate-ccw" class="me-2"></i> Đặt lại mặc định
        </button>
        <button type="submit" class="btn btn-primary px-5 py-2 fw-bold shadow">
            <i data-lucide="save" class="me-2"></i> Lưu tất cả cài đặt
        </button>
    </div>
</form>

<script>
    function previewImage(input, previewId) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById(previewId).src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function resetToDefault() {
        if (confirm('Bạn có chắc chắn muốn khôi phục về màu sắc mặc định? (Hãy nhấn Lưu sau khi đặt lại)')) {
            // Danh sách màu mặc định
            const defaults = {
                'color_pick_1': '#10b981', // Primary
                'color_text_1': '#10b981',
                'color_pick_2': '#059669', // Secondary
                'color_text_2': '#059669',
                'color_pick_3': '#f8fafc', // BG
                'color_text_3': '#f8fafc',
                'color_pick_4': '#334155', // Text
                'color_text_4': '#334155'
            };

            for (let id in defaults) {
                let el = document.getElementById(id);
                if (el) el.value = defaults[id];
            }
        }
    }
</script>
@endsection
