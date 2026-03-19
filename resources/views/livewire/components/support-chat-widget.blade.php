<div class="support-chat-container">
    <div class="support-fab" wire:click="toggleChat" style="background: {{ $isOpen ? '#64748b' : 'linear-gradient(135deg, var(--accent-primary), var(--accent-secondary))' }}; box-shadow: 0 4px 15px rgba(0,0,0,0.2);">
        @if($isOpen)
            <i class="fa-solid fa-times" style="font-size: 1.5rem; color: #fff;"></i>
        @else
            <i class="fa-solid fa-headset" style="font-size: 1.5rem; color: #fff;"></i>
            @if($this->unreadCount > 0)
                <div class="unread-badge">{{ $this->unreadCount }}</div>
            @endif
        @endif
    </div>

    @if($isOpen)
    <div class="support-panel shadow-lg">
        <div class="support-header">
            <div style="display:flex; align-items:center; gap:10px;">
                <div class="support-avatar">
                   <i class="fa-solid fa-user-shield text-white" style="font-size: 1.2rem;"></i>
                   <div class="online-indicator"></div>
                </div>
                <div>
                    <h4 style="margin:0; font-size:1rem; color:white; font-weight:700;">Hỗ trợ trực tuyến</h4>
                    <span style="font-size:0.75rem; color:#d1d5db;">Admin sẽ phản hồi sớm nhất</span>
                </div>
            </div>
        </div>
        
        <div class="support-messages" id="support-messages" wire:poll.2s="loadMessages">
            <div class="msg-bubble admin">
                Xin chào! Tôi có thể giúp gì được cho bạn?
            </div>
            
            @foreach($messages as $msg)
                @if($msg['is_admin'])
                    <div class="msg-bubble admin">
                        {{ $msg['message'] }}
                        <div class="msg-time">{{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}</div>
                    </div>
                @else
                    <div class="msg-bubble user">
                        {{ $msg['message'] }}
                        <div class="msg-time">{{ \Carbon\Carbon::parse($msg['created_at'])->format('H:i') }}</div>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="support-input-area">
            <form wire:submit.prevent="sendMessage" style="display:flex; gap:10px; width:100%; align-items:flex-end;">
                <textarea 
                    wire:model.defer="message" 
                    wire:keydown.enter.prevent="sendMessage"
                    placeholder="Nhập câu hỏi của bạn..." 
                    class="support-input"
                    rows="1"></textarea>
                <button type="submit" class="support-send-btn" @if(empty($message)) disabled @endif>
                    <i class="fa-solid fa-paper-plane"></i>
                </button>
            </form>
        </div>
    </div>
    @endif

    <style>
        .support-chat-container {
            position: fixed;
            bottom: 25px;
            left: 25px;
            z-index: 9999;
            font-family: var(--font-main);
        }

        .support-fab {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
            transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
        }

        .support-fab:hover {
            transform: scale(1.05);
        }

        .unread-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #ef4444;
            color: #fff;
            border-radius: 50%;
            min-width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: bold;
            border: 2px solid white;
        }

        .support-panel {
            position: absolute;
            bottom: 80px;
            left: 0;
            width: 350px;
            height: 500px;
            max-height: 75vh;
            background: #fff;
            border-radius: 16px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 480px) {
            .support-chat-container {
                left: 15px;
                bottom: 15px;
            }
            .support-panel {
                width: calc(100vw - 30px);
                max-height: 80vh;
            }
        }

        .support-header {
            background: linear-gradient(135deg, #10b981, #059669);
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .support-avatar {
            width: 42px;
            height: 42px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .online-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            background: #10b981;
            border: 2px solid white;
            border-radius: 50%;
        }

        .support-messages {
            flex: 1;
            background: #f8fafc;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        
        .support-messages::-webkit-scrollbar {
            width: 6px;
        }
        
        .support-messages::-webkit-scrollbar-thumb {
            background: rgba(0,0,0,0.1);
            border-radius: 3px;
        }

        .msg-bubble {
            max-width: 80%;
            padding: 12px 16px;
            border-radius: 18px;
            font-size: 0.95rem;
            line-height: 1.4;
            position: relative;
            word-wrap: break-word;
        }

        .msg-bubble.admin {
            align-self: flex-start;
            background: #fff;
            color: #1e293b;
            border-bottom-left-radius: 4px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .msg-bubble.user {
            align-self: flex-end;
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            color: #fff;
            border-bottom-right-radius: 4px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .msg-time {
            font-size: 0.65rem;
            margin-top: 5px;
            opacity: 0.7;
            text-align: right;
        }

        .support-input-area {
            padding: 15px;
            background: #fff;
            border-top: 1px solid #f1f5f9;
        }

        .support-input {
            width: 100%;
            background: #f1f5f9;
            border: none;
            padding: 12px 16px;
            border-radius: 20px;
            font-size: 0.95rem;
            resize: none;
            outline: none;
            font-family: inherit;
        }
        
        .support-send-btn {
            background: var(--accent-primary);
            color: #fff;
            width: 42px;
            height: 42px;
            border-radius: 50%;
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s;
            flex-shrink: 0;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
        
        .support-send-btn:disabled {
            background: #cbd5e1;
            cursor: not-allowed;
            box-shadow: none;
        }

        .support-send-btn:hover:not(:disabled) {
            transform: scale(1.05);
            background: var(--accent-secondary);
        }

        .support-header {
            background: linear-gradient(135deg, var(--accent-primary), var(--accent-secondary));
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .online-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            background: #10b981;
            border: 2px solid white;
            border-radius: 50%;
        }

        .support-input:focus {
            box-shadow: inset 0 0 0 1px var(--accent-primary);
        }
    </style>
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            let scrollBot = () => {
                let box = document.getElementById('support-messages');
                if(box) {
                    box.scrollTop = box.scrollHeight;
                }
            };
            Livewire.on('chatOpened', () => setTimeout(scrollBot, 50));
            Livewire.on('messageSent', () => setTimeout(scrollBot, 50));
            // Add listen to any event for messages to auto scroll
        });
    </script>
</div>
