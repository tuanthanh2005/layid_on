<div class="container-fluid py-4 h-100" style="min-height: calc(100vh - 80px);">
    <div class="row g-0 h-100 border rounded-4 shadow-sm bg-white overflow-hidden" style="max-height: 85vh;">
        
        <!-- Sidebar Danh sách Chat -->
        <div class="col-md-4 col-lg-3 border-end h-100 d-flex flex-column" style="background:#f8fafc;">
            <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-white shadow-sm" style="z-index:10;">
                <h5 class="m-0 fw-bold text-dark"><i class="fa-solid fa-headset text-primary me-2"></i> Hỗ trợ trực tuyến</h5>
                <button wire:click="$refresh" class="btn btn-sm btn-light border" title="Làm mới">
                    <i class="fa-solid fa-rotate-right"></i>
                </button>
            </div>
            
            <div class="overflow-auto flex-grow-1" wire:poll.3s="loadLatestData">
                @forelse($chats as $chat)
                <div class="p-3 border-bottom {{ $activeSessionId === $chat->session_id ? 'bg-primary-subtle border-primary border-start border-4' : 'hover-bg-light transition-all cursor-pointer' }}"
                     wire:click="selectSession('{{ $chat->session_id }}')" style="cursor: pointer;">
                     <div class="d-flex justify-content-between align-items-start mb-1">
                         <div class="fw-bold text-dark text-truncate" style="max-width: 70%; font-size:0.95rem;" title="{{ $chat->session_id }}">
                             <i class="fa-solid fa-user-circle text-secondary me-1"></i> 
                             @if($chat->user)
                                 {{ $chat->user->name }}
                             @elseif(str_starts_with($chat->session_id, 'ip_'))
                                 Khách IP: {{ explode('_', $chat->session_id)[1] ?? 'Ẩn' }}
                             @else
                                 Khách vãng lai
                             @endif
                         </div>
                         <div class="small text-muted" style="font-size:0.75rem;">
                             {{ $chat->created_at->diffForHumans(null, true, true) }}
                         </div>
                     </div>
                     <div class="d-flex justify-content-between align-items-center">
                         <div class="text-muted text-truncate small flex-grow-1" style="{{ $chat->unread_count > 0 ? 'font-weight: 600; color: #1e293b;' : '' }}">
                             {{ $chat->is_admin ? 'Bạn: ' : '' }}{{ $chat->message }}
                         </div>
                         @if($chat->unread_count > 0)
                            <span class="badge bg-danger rounded-pill ms-2 shadow-sm">{{ $chat->unread_count }}</span>
                         @endif
                     </div>
                </div>
                @empty
                <div class="p-5 text-center text-muted">
                    <i class="fa-regular fa-comments fa-3x mb-3 opacity-25"></i>
                    <p class="small">Chưa có tin nhắn nào từ người dùng.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Khung Chat Chính -->
        <div class="col-md-8 col-lg-9 h-100 d-flex flex-column bg-white position-relative">
            @if($activeSessionId)
                <!-- Chat Header -->
                <div class="p-3 border-bottom bg-white shadow-sm d-flex justify-content-between align-items-center" style="z-index:10;">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary-subtle text-primary d-flex align-items-center justify-content-center" style="width:45px; height:45px;">
                            <i class="fa-solid fa-user fa-lg"></i>
                        </div>
                        <div>
                            <h5 class="m-0 fw-bold">ID Phiên: {{ Str::limit($activeSessionId, 10) }}</h5>
                            <span class="small text-success"><i class="fa-solid fa-circle" style="font-size:8px;"></i> Đang hoạt động</span>
                        </div>
                    </div>
                </div>

                <!-- Chat Messages Body -->
                <div class="flex-grow-1 p-4 overflow-auto bg-light" id="admin-chat-messages" wire:poll.2s="loadLatestData" style="background-image: radial-gradient(circle, #e2e8f0 1px, transparent 1px); background-size: 20px 20px;">
                    <div class="d-flex flex-column gap-3">
                        <div class="text-center my-3">
                            <span class="badge bg-secondary-subtle text-secondary px-3 py-1 fw-normal rounded-pill">Bắt đầu phiên hỗ trợ</span>
                        </div>
                        
                        @foreach($this->activeMessages as $msg)
                            @if($msg->is_admin)
                                <!-- Tin nhắn Admin (Bên Phải) -->
                                <div class="align-self-end text-end" style="max-width: 75%;">
                                    <div class="d-inline-block bg-primary text-white p-3 rounded-4 shadow-sm text-start" style="border-bottom-right-radius: 4px;">
                                        {!! nl2br(e($msg->message)) !!}
                                    </div>
                                    <div class="small text-muted mt-1 px-1" style="font-size: 0.7rem;">
                                        {{ $msg->created_at->format('H:i, d/m') }}
                                        @if($msg->is_read) <i class="fa-solid fa-check-double text-primary ms-1"></i> @endif
                                    </div>
                                </div>
                            @else
                                <!-- Tin nhắn User (Bên Trái) -->
                                <div class="align-self-start" style="max-width: 75%;">
                                    <div class="d-inline-block bg-white text-dark p-3 rounded-4 shadow-sm border" style="border-bottom-left-radius: 4px;">
                                        {!! nl2br(e($msg->message)) !!}
                                    </div>
                                    <div class="small text-muted mt-1 px-1" style="font-size: 0.7rem;">
                                        {{ $msg->created_at->format('H:i, d/m') }}
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Chat Input Box -->
                <div class="p-3 border-top bg-white">
                    <form wire:submit.prevent="sendReply" class="d-flex gap-2 align-items-end">
                        <textarea 
                            wire:model.defer="replyMessage" 
                            wire:keydown.enter.prevent="sendReply"
                            class="form-control rounded-4 bg-light border-0 px-4 py-3 shadow-none" 
                            rows="2" 
                            placeholder="Nhập tin nhắn để trả lời (Enter để gửi)..."
                            style="resize: none;"></textarea>
                        <button type="submit" class="btn btn-primary rounded-circle shadow d-flex align-items-center justify-content-center" style="width:55px; height:55px; flex-shrink:0;">
                            <i class="fa-solid fa-paper-plane fa-lg"></i>
                        </button>
                    </form>
                </div>
            @else
                <div class="h-100 d-flex flex-column align-items-center justify-content-center text-muted bg-light">
                    <div class="bg-white p-4 rounded-circle shadow-sm mb-3">
                        <i class="fa-brands fa-rocketchat fa-4x text-primary opacity-50"></i>
                    </div>
                    <h4>Layid Support Center</h4>
                    <p>Chọn một đoạn chat bên trái để bắt đầu trả lời khách hàng</p>
                </div>
            @endif
        </div>
    </div>
    
    <audio id="chat-notification-sound" preload="auto">
        <source src="https://assets.mixkit.co/active_storage/sfx/2358/2358-preview.mp3" type="audio/mpeg">
    </audio>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            const audio = document.getElementById('chat-notification-sound');
            let lastMessageCount = 0;

            const scrollToBottom = () => {
                let chatBox = document.getElementById('admin-chat-messages');
                if (chatBox) chatBox.scrollTop = chatBox.scrollHeight;
            };
            
            Livewire.on('chatSessionSelected', () => setTimeout(scrollToBottom, 50));
            Livewire.on('replySent', () => setTimeout(scrollToBottom, 50));
            
            // Observe message changes to scroll and play sound
            let observer = new MutationObserver((mutations) => {
                let chatBox = document.getElementById('admin-chat-messages');
                if(chatBox) {
                    // Play sound if new message from user (left side)
                    const currentMessages = chatBox.querySelectorAll('.align-self-start').length;
                    if (currentMessages > lastMessageCount && lastMessageCount !== 0) {
                        audio.play().catch(e => console.log('Audio play failed:', e));
                    }
                    lastMessageCount = currentMessages;

                    // Auto scroll
                    if(chatBox.scrollHeight - chatBox.scrollTop - chatBox.clientHeight < 150) {
                        chatBox.scrollTop = chatBox.scrollHeight;
                    }
                }
            });

            let box = document.getElementById('admin-chat-messages');
            if(box) {
                lastMessageCount = box.querySelectorAll('.align-self-start').length;
                observer.observe(box, { childList: true, subtree: true });
            }
        });
    </script>
    
    <style>
        .hover-bg-light:hover { background-color: #f8fafc !important; }
        ::-webkit-scrollbar { width: 6px; height: 6px; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        ::-webkit-scrollbar-track { background: transparent; }
    </style>
</div>
