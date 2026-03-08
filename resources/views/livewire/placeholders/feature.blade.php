<div class="tool-section" style="text-align: center; padding: 50px 20px;">
    <i class="fa-solid fa-gears" style="font-size: 4rem; color: var(--accent-primary); margin-bottom: 20px;"></i>
    <h2 style="margin-bottom: 15px;">{{ $title }}</h2>
    <p style="color: var(--text-secondary); max-width: 500px; margin: 0 auto;">{!! nl2br(e($desc)) !!}</p>
    <button wire:navigate href="/" class="btn btn-primary" style="margin-top: 25px;"><i class="fa-solid fa-house"></i> Về Trang chủ</button>
</div>
