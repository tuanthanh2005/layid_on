<div wire:poll.3s>
    @if($unreadCount > 0)
        <span class="ms-auto badge bg-danger text-white rounded-pill" style="font-size: 0.7rem; padding: 2px 6px; position:absolute; right:15px; top: 14px;">
            {{ $unreadCount }}
        </span>
    @endif
    
    <audio id="sidebar-chat-ping" preload="auto">
        <source src="https://assets.mixkit.co/active_storage/sfx/2869/2869-preview.mp3" type="audio/mpeg">
    </audio>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            let lastUnreadCount = 0;
            const ping = document.getElementById('sidebar-chat-ping');
            
            Livewire.on('chat-counter-updated', (data) => {
                const currentCount = data[0].count; // Extract from event data
                if (currentCount > lastUnreadCount && lastUnreadCount !== 0) {
                    ping.play().catch(e => {}); // Silent fail if browser blocks autoplay
                }
                lastUnreadCount = currentCount;
            });
        });
    </script>
</div>
