<div class="py-5 bg-light" style="min-height: calc(100vh - 200px);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden chat-container-page" wire:poll.3000ms="markAsRead">
                    <div class="chat-header-page p-4 bg-primary text-white d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center gap-3">
                            <div class="status-circle online"></div>
                            <div>
                                <h4 class="m-0 fw-bold fs-5">Hỗ trợ Trực tuyến</h4>
                                <p class="m-0 opacity-75 small">Chúng tôi luôn sẵn sàng hỗ trợ bạn</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <i class="fa-solid fa-headset fs-3 opacity-25"></i>
                        </div>
                    </div>

                    <div class="chat-body-page p-4 bg-white" id="chat-body-full" style="height: 500px; overflow-y: auto; display: flex; flex-direction: column; gap: 15px;">
                        @forelse($messages as $msg)
                            <div class="chat-bubble {{ $msg->is_admin ? 'admin' : 'user' }} animate-fade-in">
                                <div class="bubble-content shadow-sm">
                                    {{ $msg->message }}
                                </div>
                                <div class="bubble-meta">
                                    <small>{{ $msg->is_admin ? 'Admin' : 'Bạn' }} • {{ $msg->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5 opacity-50">
                                <i class="fa-solid fa-comments fs-1 mb-3"></i>
                                <p>Hãy để lại tin nhắn, chúng tôi sẽ phản hồi bạn sớm nhất có thể!</p>
                            </div>
                        @endforelse
                    </div>

                    <form class="chat-footer-page p-4 bg-light border-top" wire:submit.prevent="sendMessage">
                        <div class="input-group">
                            <input type="text" wire:model.defer="message" class="form-control form-control-lg border-0 shadow-none ps-0 bg-transparent" placeholder="Nhập tin nhắn của bạn tại đây...">
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm ms-2" wire:loading.attr="disabled">
                                <span wire:loading.remove><i class="fa-solid fa-paper-plane me-2"></i> Gửi tin nhắn</span>
                                <span wire:loading class="spinner-border spinner-border-sm"></span>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="mt-4 text-center text-muted small">
                    <i class="fa-solid fa-shield-halved me-1"></i> Cuộc trò chuyện được bảo mật và riêng tư.
                </div>
            </div>
        </div>
    </div>

    <style>
        .chat-container-page {
            max-width: 1000px;
            margin: 0 auto;
        }

        .status-circle {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: #fff;
            border: 3px solid rgba(255,255,255,0.2);
        }
        .status-circle.online { background: #4dfa3c; box-shadow: 0 0 10px rgba(77, 250, 60, 0.5); }

        .chat-bubble {
            max-width: 80%;
            display: flex;
            flex-direction: column;
        }

        .chat-bubble.user {
            align-self: flex-end;
            align-items: flex-end;
        }

        .chat-bubble.admin {
            align-self: flex-start;
            align-items: flex-start;
        }

        .bubble-content {
            padding: 12px 18px;
            border-radius: 20px;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .user .bubble-content {
            background: var(--accent-primary);
            color: white;
            border-bottom-right-radius: 4px;
        }

        .admin .bubble-content {
            background: #f1f5f9;
            color: #1e293b;
            border-bottom-left-radius: 4px;
        }

        .bubble-meta {
            margin-top: 5px;
            font-size: 0.75rem;
            color: #94a3b8;
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 768px) {
            .chat-body-page { height: 400px !important; }
            .bubble-content { font-size: 0.88rem; padding: 10px 15px; }
            .chat-footer-page { padding: 15px !important; }
            .btn span i { margin-right: 0 !important; }
            .btn span span { display: none; }
        }
    </style>

    <script>
        function scrollToBottom() {
            const chatBody = document.getElementById('chat-body-full');
            if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;
        }

        window.addEventListener('messageSent', scrollToBottom);
        
        // Initial scroll
        document.addEventListener('livewire:load', scrollToBottom);
        
        // Polling scroll (optional, only if user is already at bottom)
        setInterval(() => {
            const chatBody = document.getElementById('chat-body-full');
            if (chatBody && (chatBody.scrollHeight - chatBody.scrollTop - chatBody.clientHeight < 100)) {
                scrollToBottom();
            }
        }, 3000);
    </script>
</div>
