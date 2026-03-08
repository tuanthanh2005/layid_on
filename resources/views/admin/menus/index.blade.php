@extends('layouts.admin')

@section('styles')
<style>
    .dd { position: relative; display: block; margin: 0; padding: 0; list-style: none; font-size: 13px; line-height: 20px; }
    .dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
    .dd-list .dd-list { padding-left: 30px; }
    .dd-collapsed .dd-list { display: none; }
    .dd-item, .dd-empty, .dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }
    .dd-handle { 
        display: block; height: 50px; margin: 10px 0; padding: 14px 25px; color: #333; text-decoration: none; 
        font-weight: bold; border: 1px solid #eef2f7; background: #fff; border-radius: 8px; box-sizing: border-box; 
        cursor: move; transition: all 0.2s;
    }
    .dd-handle:hover { color: var(--accent-color); background: #f8f9fa; border-color: var(--accent-color); }
    .dd-item > button { 
        display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 30px; margin: 10px 0; 
        padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; 
        font-size: 12px; line-height: 1; text-align: center; font-weight: bold; 
    }
    .dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-indent: 0; }
    .dd-item > button[data-action="collapse"]:before { content: '-'; }
    .dd-placeholder, .dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; border-radius: 8px; }
    .dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5; background-size: 60px 60px; background-position: 0 0, 30px 30px; }
    .dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
    .dd-dragel > .dd-item .dd-handle { margin-top: 0; box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1); border-color: var(--accent-color); }
    
    .menu-actions { position: absolute; right: 15px; top: 12px; display: flex; gap: 8px; }
    .menu-url { font-weight: normal; color: #6c757d; font-size: 12px; margin-left: 10px; }
</style>
@endsection

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1 class="page-title mb-1">Cấu trúc Menu</h1>
        <p class="text-muted small">Kéo thả để sắp xếp vị trí và cấp bậc (như Wordpress)</p>
    </div>
    <div class="d-flex gap-2">
        <button id="save-menu" class="btn btn-success d-flex align-items-center gap-2 px-4 shadow-sm">
            <i data-lucide="save" size="18"></i> Lưu vị trí
        </button>
        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary d-flex align-items-center gap-2 shadow-sm">
            <i data-lucide="plus-circle" size="18"></i> Thêm mới
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm p-4">
    <div class="dd" id="nestable">
        <ol class="dd-list">
            @foreach($menus as $menu)
                <li class="dd-item" data-id="{{ $menu->id }}">
                    <div class="dd-handle">
                        <i data-lucide="{{ $menu->icon ?? 'link' }}" size="16" class="me-2 text-primary"></i>
                        <span>{{ $menu->name }}</span>
                        <span class="menu-url"><code>{{ $menu->url }}</code></span>
                        
                        <div class="menu-actions">
                            <span class="badge {{ $menu->status ? 'bg-success' : 'bg-secondary' }} me-2" style="font-size: 10px; padding: 4px 8px;">
                                {{ $menu->status ? 'Hiển thị' : 'Ẩn' }}
                            </span>
                            <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-sm btn-light border p-1" style="height: 28px; width: 28px;"><i data-lucide="edit-2" size="12"></i></a>
                            <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border p-1 text-danger" style="height: 28px; width: 28px;" onclick="return confirm('Xóa menu này?')">
                                    <i data-lucide="trash-2" size="12"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    @if($menu->children->count() > 0)
                        <ol class="dd-list">
                            @foreach($menu->children as $child)
                                <li class="dd-item" data-id="{{ $child->id }}">
                                    <div class="dd-handle">
                                        <i data-lucide="{{ $child->icon ?? 'link-2' }}" size="14" class="me-2 text-secondary"></i>
                                        <span>{{ $child->name }}</span>
                                        <span class="menu-url"><code>{{ $child->url }}</code></span>
                                        
                                        <div class="menu-actions">
                                            <span class="badge {{ $child->status ? 'bg-success' : 'bg-secondary' }} me-2" style="font-size: 10px; padding: 4px 8px;">
                                                {{ $child->status ? 'Hiển thị' : 'Ẩn' }}
                                            </span>
                                            <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-sm btn-light border p-1" style="height: 28px; width: 28px;"><i data-lucide="edit-2" size="12"></i></a>
                                            <form action="{{ route('admin.menus.destroy', $child) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-light border p-1 text-danger" style="height: 28px; width: 28px;" onclick="return confirm('Xóa menu con?')">
                                                    <i data-lucide="trash-2" size="12"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                    @if($child->children->count() > 0)
                                        <ol class="dd-list">
                                            @foreach($child->children as $subchild)
                                                <li class="dd-item" data-id="{{ $subchild->id }}">
                                                    <div class="dd-handle">
                                                        <i data-lucide="{{ $subchild->icon ?? 'dot' }}" size="12" class="me-2 text-muted"></i>
                                                        <span>{{ $subchild->name }}</span>
                                                        
                                                        <div class="menu-actions">
                                                            <a href="{{ route('admin.menus.edit', $subchild) }}" class="btn btn-sm btn-light border p-1" style="height: 28px; width: 28px;"><i data-lucide="edit-2" size="12"></i></a>
                                                            <form action="{{ route('admin.menus.destroy', $subchild) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-light border p-1 text-danger" style="height: 28px; width: 28px;"><i data-lucide="trash-2" size="12"></i></button>
                                                            </form>
                                                        </div>
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
<script src="https://cdn.jsdelivr.net/gh/Robsomeone/Nestable2@latest/jquery.nestable.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize Nestable
        $('#nestable').nestable({
            maxDepth: 3
        });

        // Save Menu Order
        $('#save-menu').on('click', function() {
            const list = $('#nestable').nestable('serialize');
            const saveBtn = $(this);
            const originalHtml = saveBtn.html();
            
            saveBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span> Đang lưu...');

            $.ajax({
                url: "{{ route('admin.menus.reorder') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    list: JSON.stringify(list)
                },
                success: function(response) {
                    saveBtn.prop('disabled', false).html(originalHtml);
                    // Show success toast (assuming toast component is in layout)
                    if(typeof bootstrap !== 'undefined') {
                        // Re-trigger global success message or show simple alert
                        location.reload(); // Reload to refresh the tree view status
                    }
                },
                error: function(err) {
                    saveBtn.prop('disabled', false).html(originalHtml);
                    alert('Lỗi: Không thể lưu vị trí menu.');
                }
            });
        });
    });
</script>
@endsection
