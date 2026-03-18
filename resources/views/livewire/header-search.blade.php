<div class="search-bar" style="position: relative;">
    <i class="fa-solid fa-magnifying-glass search-icon"></i>
    <input type="text" 
           wire:model.live.debounce.400ms="query" 
           wire:keydown.enter="search"
           placeholder="Bạn đang tìm sản phẩm AI, công cụ nào..."
           class="search-input"
           style="outline: none; transition: all 0.3s;"
           autocomplete="off">
    <button class="search-btn" wire:click="search">Tìm kiếm</button>

    @if(!empty($query) && strlen($query) >= 2)
        <div class="search-dropdown shadow-lg rounded-3 overflow-hidden" 
             style="position: absolute; top: 110%; left: 0; width: 100%; background: #fff; z-index: 9999; border: 1px solid #e2e8f0; color: #334155;">
            @if(count($results) > 0)
                <div class="p-2 border-bottom bg-light text-muted small fw-bold">KẾT QUẢ TÌM KIẾM</div>
                <div style="max-height: 400px; overflow-y: auto;">
                    @foreach($results as $res)
                    <a href="{{ $res['url'] }}" class="d-flex align-items-center gap-3 p-3 text-decoration-none hover-bg-light transition-all">
                        <div class="search-res-icon d-flex align-items-center justify-content-center bg-primary-subtle text-primary rounded-circle" style="width: 32px; height: 32px; flex-shrink: 0;">
                            <i class="{{ $res['icon'] }} small"></i>
                        </div>
                        <div class="search-res-info flex-grow-1 overflow-hidden">
                            <div class="text-dark fw-bold text-truncate" style="font-size: 0.9rem;">{{ $res['title'] }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">{{ $res['type'] }}</div>
                        </div>
                        <i class="fa-solid fa-chevron-right text-muted small"></i>
                    </a>
                    @endforeach
                </div>
            @else
                <div class="p-4 text-center text-muted">
                    <i class="fa-solid fa-face-frown mb-2 opacity-50" style="font-size: 1.5rem;"></i>
                    <p class="mb-0 small">Không tìm thấy kết quả cho "<strong>{{ $query }}</strong>"</p>
                </div>
            @endif
        </div>
    @endif

    <style>
        .hover-bg-light:hover { background-color: #f8fafc; }
        .search-dropdown {
            animation: slideUp 0.2s ease-out;
        }
        @keyframes slideUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</div>
