@extends('layouts.admin')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css">
<style>
    .dd { max-width: 100%; }
    .dd-item > button { margin-top: 15px; }
    .dd-handle {
        height: 55px;
        padding: 15px 15px 15px 45px;
        background: #fff;
        border: 1px solid #eef2f7;
        border-radius: 8px;
        font-weight: 600;
        margin-bottom: 10px;
        cursor: move;
        display: flex;
        align-items: center;
        transition: all 0.2s;
    }
    .dd-handle:hover {
        border-color: var(--accent-color);
        background: #f8fbff;
    }
    .dd-dragel .dd-handle {
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }
    .drag-icon {
        position: absolute;
        left: 15px;
        top: 18px;
        color: #adb5bd;
    }
    .menu-actions {
        position: absolute;
        right: 15px;
        top: 12px;
        display: flex;
        gap: 8px;
        z-index: 10;
    }
    /* Ngăn cản việc kéo khi nhấn vào nút bấm */
    .menu-actions a, .menu-actions button {
        cursor: pointer;
    }
    .menu-url {
        font-weight: normal;
        color: #94a3b8;
        font-size: 12px;
        margin-left: 15px;
    }
    .dd-placeholder {
        margin-bottom: 10px;
        border-radius: 8px;
        background: #f0f7ff;
        border: 1px dashed #3e8ef7;
    }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">Cấu trúc Menu</h1>
        <p class="text-muted small">Dùng chuột kéo các mục để sắp xếp hoặc lùi vào để tạo menu con</p>
    </div>
    <div class="d-flex gap-2">
        <button id="save-menu" class="btn btn-success d-flex align-items-center gap-2 px-4">
            <i data-lucide="save" size="18"></i> Lưu cấu trúc
        </button>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary d-flex align-items-center gap-2">
            <i data-lucide="plus-circle" size="18"></i> Thêm mới
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="dd" id="nestable">
        <ol class="dd-list">
            @foreach($menus as $menu)
                <li class="dd-item" data-id="{{ $menu->id }}">
                    <i data-lucide="grip-vertical" class="drag-icon" size="18"></i>
                    <div class="dd-handle">
                        <i data-lucide="{{ $menu->icon ?? 'link' }}" size="18" class="me-2 text-primary"></i>
                        <span>{{ $menu->name }}</span>
                        <span class="menu-url d-none d-md-inline">{{ $menu->url }}</span>
                    </div>
                    <div class="menu-actions">
                        <span class="badge {{ $menu->status ? 'bg-success' : 'bg-secondary' }} me-2 d-none d-sm-inline-block">
                            {{ $menu->status ? 'Hiện' : 'Ẩn' }}
                        </span>
                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-light border"><i data-lucide="edit-2" size="14"></i></a>
                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa menu này?')">
                                <i data-lucide="trash-2" size="14"></i>
                            </button>
                        </form>
                    </div>

                    @if($menu->children->count() > 0)
                        <ol class="dd-list">
                            @foreach($menu->children as $child)
                                <li class="dd-item" data-id="{{ $child->id }}">
                                    <i data-lucide="grip-vertical" class="drag-icon" size="16" style="top: 19px;"></i>
                                    <div class="dd-handle">
                                        <i data-lucide="{{ $child->icon ?? 'link-2' }}" size="16" class="me-2 text-secondary"></i>
                                        <span>{{ $child->name }}</span>
                                    </div>
                                    <div class="menu-actions">
                                        <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-light border"><i data-lucide="edit-2" size="14"></i></a>
                                        <form action="{{ route('admin.menus.destroy', $child) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border text-danger" onclick="return confirm('Xóa menu con?')">
                                                <i data-lucide="trash-2" size="14"></i>
                                            </button>
                                        </form>
                                    </div>

                                    @if($child->children->count() > 0)
                                        <ol class="dd-list">
                                            @foreach($child->children as $subchild)
                                                <li class="dd-item" data-id="{{ $subchild->id }}">
                                                    <i data-lucide="grip-vertical" class="drag-icon" size="14" style="top: 20px;"></i>
                                                    <div class="dd-handle">
                                                        <span>{{ $subchild->name }}</span>
                                                    </div>
                                                    <div class="menu-actions">
                                                        <a href="{{ route('admin.menus.edit', $subchild) }}" class="btn btn-sm btn-light border"><i data-lucide="edit-2" size="14"></i></a>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ol>
                                    @endif
                                </li>
                            @endforeach
                        </ol>
                    @endif
                </li>
            @endforeach
        </ol>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js"></script>
<script>
    $(document).ready(function() {
        // Khởi tạo Nestable
        $('#nestable').nestable({
            maxDepth: 3
        });

        // Lưu vị trí
        $('#save-menu').on('click', function() {
            const list = $('#nestable').nestable('serialize');
            const saveBtn = $(this);
            
            saveBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Đang lưu...');

            $.ajax({
                url: "{{ route('admin.menus.reorder') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    list: JSON.stringify(list)
                },
                success: function(response) {
                    saveBtn.prop('disabled', false).html('<i data-lucide="save" size="18"></i> Lưu cấu trúc');
                    lucide.createIcons();
                    alert('Đã lưu cấu trúc menu thành công!');
                    location.reload();
                },
                error: function() {
                    saveBtn.prop('disabled', false).html('<i data-lucide="save" size="18"></i> Lưu cấu trúc');
                    lucide.createIcons();
                    alert('Lỗi: Không thể lưu vị trí menu.');
                }
            });
        });
    });
</script>
@endsection
