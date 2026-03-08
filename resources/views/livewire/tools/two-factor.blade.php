<div class="tool-section">
    <div class="page-header">
        <h2 style="color: var(--accent-primary)"><i class="fa-solid fa-shield-halved"></i> Công Cụ Nhận Mã 2FA</h2>
        <p>Hỗ trợ lấy mã code đăng nhập từ chuỗi 2FA cho mọi nền tảng.</p>
    </div>
    
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; background: var(--bg-card); border-radius: 8px;">
        <form wire:submit="generate">
            <label style="display: block; margin-bottom: 10px; color: var(--text-secondary)">Nhập chuỗi Token 2FA của bạn:</label>
            <textarea wire:model="tokenInput" rows="4" style="width: 100%; padding: 15px; background: var(--bg-secondary); border: 1px solid var(--border-color); border-radius: 6px; color: var(--text-primary); outline: none; margin-bottom: 5px;" placeholder="VD: NDKS 29KS KD8S KS92 ..."></textarea>
            @error('tokenInput') <span style="color:red; font-size:0.85rem; display:block; margin-bottom: 15px;">Vui lòng nhập Token hợp lệ.</span> @enderror
            
            <button type="submit" class="btn btn-primary">
                <span wire:loading.remove wire:target="generate"><i class="fa-solid fa-key"></i> Lấy Mã</span>
                <span wire:loading wire:target="generate">Đang tạo...</span>
            </button>
        </form>
        
        @if(count($results) > 0)
        <div style="margin-top: 30px;">
            <p style="color: var(--text-secondary); margin-bottom: 15px;">Kết quả nhận mã:</p>
            <div style="display: flex; flex-direction: column; gap: 12px;">
                @foreach($results as $res)
                <div style="display: flex; align-items: center; justify-content: space-between; padding: 12px 15px; border: 1px solid var(--border-color); background: var(--bg-secondary); border-radius: 8px;">
                    <div style="max-width: 60%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                        <small style="color: var(--text-secondary); display: block;">Input:</small>
                        <span style="color: var(--text-primary); font-size: 0.85rem;">{{ $res['input'] }}</span>
                    </div>
                    <div style="text-align: right;">
                        <small style="color: var(--accent-primary); font-weight: bold; display: block; margin-bottom: 2px;">CODE 2FA:</small>
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--accent-primary); letter-spacing: 2px; font-family: monospace;">{{ $res['code'] }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <div style="margin-top: 20px; padding: 15px; border-left: 4px solid #cbd5e1; background: var(--bg-secondary);">
            <strong style="color: var(--text-secondary)">Hướng dẫn:</strong>
            <p style="margin-top: 5px; color: var(--text-secondary); font-size: 0.9rem;">Dán chuỗi 2FA (có thể kèm user|pass|...) mỗi dòng một chuỗi để lấy mã hàng loạt.</p>
        </div>
        @endif
    </div>
</div>
