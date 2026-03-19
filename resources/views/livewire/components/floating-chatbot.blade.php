<div class="ai-chat-container" wire:key="ai-chatbot-app">
    <!-- Chat Window -->
    <div class="ai-chat-window {{ $isOpen ? 'active' : '' }}" aria-hidden="{{ $isOpen ? 'false' : 'true' }}">
        
        <!-- Header -->
        <div class="ai-chat-header">
            <div class="ai-header-profile">
                <div class="ai-avatar-wrapper">
                    <img src="https://ui-avatars.com/api/?name=AI&background=ffffff&color=0084ff&rounded=true&bold=true" alt="AI">
                    <span class="ai-status-indicator"></span>
                </div>
                <div class="ai-header-info">
                    <h3 class="ai-header-title">Trợ lý AI</h3>
                    <p class="ai-header-subtitle">Thường trả lời ngay lập tức</p>
                </div>
            </div>
            <div class="ai-header-actions">
                <button type="button" wire:click="clearChat" title="Xóa cuộc trò chuyện">
                    <i class="fa-solid fa-trash-can"></i>
                </button>
                <button type="button" wire:click="close" title="Thu nhỏ">
                    <i class="fa-solid fa-minus"></i>
                </button>
            </div>
        </div>

        <!-- Quick Suggestions -->
        <div class="ai-chat-suggestions">
            <button type="button" class="ai-suggestion-btn" data-prompt="Xin chào, bạn có thể giúp gì cho tôi?">
                👋 Chào hỏi
            </button>
            <button type="button" class="ai-suggestion-btn" data-prompt="Tóm tắt nội dung chính trên trang này">
                ✨ Tóm tắt
            </button>
            <button type="button" class="ai-suggestion-btn" data-prompt="Gợi ý một số cách kiếm tiền online">
                💰 MMO
            </button>
            <button type="button" class="ai-suggestion-btn" data-prompt="Tôi muốn tạo tài khoản AI Premium">
                👑 Mua tài khoản
            </button>
        </div>

        <!-- Chat Body -->
        <div class="ai-chat-body" id="aiChatBody">
            <div class="ai-chat-timestamp">Hôm nay</div>
            
            @foreach($messages as $msg)
                @php $isUser = ($msg['role'] ?? '') === 'user'; @endphp
                
                <div class="ai-message-row {{ $isUser ? 'ai-user-row' : 'ai-bot-row' }}">
                    @if(!$isUser)
                        <div class="ai-msg-avatar">
                            <i class="fa-solid fa-robot"></i>
                        </div>
                    @endif
                    
                    <div class="ai-message-content">
                        <div class="ai-bubble {{ $isUser ? 'ai-bubble-user' : 'ai-bubble-bot' }}">
                            {!! nl2br(e($msg['content'] ?? '')) !!}
                        </div>
                        <div class="ai-time">{{ $msg['time'] ?? now()->format('H:i') }}</div>
                    </div>
                </div>
            @endforeach

            <!-- Typing Indicator -->
            @if($isSending)
                <div class="ai-message-row ai-bot-row">
                    <div class="ai-msg-avatar">
                        <i class="fa-solid fa-robot"></i>
                    </div>
                    <div class="ai-message-content">
                        <div class="ai-bubble ai-bubble-bot ai-typing-indicator">
                            <span class="dot"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Input Area -->
        <div class="ai-chat-footer">
            <form wire:submit.prevent="sendMessage" class="ai-input-form">
                <div class="ai-input-wrapper">
                    <textarea 
                        wire:model.defer="prompt" 
                        id="aiChatInput"
                        placeholder="Hỏi trợ lý AI điều gì đó..."
                        rows="1"
                        @disabled($isSending)
                    ></textarea>
                    
                    <button type="submit" class="ai-send-button" @disabled($isSending) title="Gửi (Enter)">
                        <span wire:loading.remove wire:target="sendMessage">
                            <i class="fa-solid fa-paper-plane"></i>
                        </span>
                        <span wire:loading wire:target="sendMessage">
                            <i class="fa-solid fa-circle-notch fa-spin"></i>
                        </span>
                    </button>
                </div>
            </form>
            @error('prompt')
                <div class="ai-error-text">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <!-- Floating Bubble Trigger -->
    <button class="ai-trigger-btn {{ $isOpen ? 'active' : '' }}" wire:click="toggle" title="Chat với AI">
        <div class="ai-trigger-icon ai-icon-chat">
            <i class="fa-brands fa-bots"></i>
        </div>
        <div class="ai-trigger-icon ai-icon-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
        @if(!$isOpen && count($messages) > 1)
            <span class="ai-badge">1</span>
        @endif
    </button>
</div>

<!-- ======================= CSS ======================= -->
<style>
.ai-chat-container {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 1050;
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
}

/* WINDOW */
.ai-chat-window {
    position: absolute;
    bottom: 80px;
    right: 0;
    width: 380px;
    height: 600px;
    max-height: calc(100vh - 120px);
    background-color: #ffffff;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15), 0 2px 10px rgba(0, 0, 0, 0.05);
    display: flex;
    flex-direction: column;
    overflow: hidden;
    
    /* Animation hidden state */
    opacity: 0;
    pointer-events: none;
    transform: translateY(20px) scale(0.95);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    transform-origin: bottom right;
}

.ai-chat-window.active {
    opacity: 1;
    pointer-events: all;
    transform: translateY(0) scale(1);
}

/* HEADER */
.ai-chat-header {
    background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
    padding: 16px 20px;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    z-index: 2;
}

.ai-header-profile {
    display: flex;
    align-items: center;
    gap: 14px;
}

.ai-avatar-wrapper {
    position: relative;
    width: 44px;
    height: 44px;
}

.ai-avatar-wrapper img {
    width: 100%;
    height: 100%;
    border-radius: 50%;
    border: 2px solid rgba(255,255,255,0.8);
    background: white;
    object-fit: cover;
}

.ai-status-indicator {
    position: absolute;
    bottom: 0px;
    right: 2px;
    width: 12px;
    height: 12px;
    background-color: #31a24c;
    border: 2px solid #ffffff;
    border-radius: 50%;
}

.ai-header-title {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
    line-height: 1.2;
    letter-spacing: 0.2px;
}

.ai-header-subtitle {
    margin: 4px 0 0 0;
    font-size: 12px;
    color: rgba(255,255,255,0.9);
    font-weight: 400;
}

.ai-header-actions {
    display: flex;
    gap: 8px;
}

.ai-header-actions button {
    background: rgba(255,255,255,0.15);
    border: none;
    color: white;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: background 0.2s;
    font-size: 14px;
}

.ai-header-actions button:hover {
    background: rgba(255,255,255,0.3);
}

/* SUGGESTIONS */
.ai-chat-suggestions {
    display: flex;
    gap: 8px;
    padding: 12px 16px;
    background-color: #fcfcfc;
    border-bottom: 1px solid #f0f0f0;
    overflow-x: auto;
    white-space: nowrap;
    scrollbar-width: none;
}

.ai-chat-suggestions::-webkit-scrollbar {
    display: none;
}

.ai-suggestion-btn {
    background: #ffffff;
    border: 1px solid #e4e6eb;
    color: #1c1e21;
    padding: 7px 14px;
    border-radius: 18px;
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s ease;
}

.ai-suggestion-btn:hover {
    background: #f0f2f5;
    border-color: var(--accent-primary);
    color: var(--accent-primary);
}

/* CHAT BODY */
.ai-chat-body {
    flex: 1;
    background-image: linear-gradient(to bottom, #f0f2f5, #f5f7fa);
    padding: 20px 16px;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    gap: 16px;
    scroll-behavior: smooth;
}

.ai-chat-body::-webkit-scrollbar {
    width: 5px;
}

.ai-chat-body::-webkit-scrollbar-thumb {
    background-color: #bcc0c4;
    border-radius: 10px;
}

.ai-chat-timestamp {
    text-align: center;
    font-size: 12px;
    color: #8a8d91;
    margin-bottom: 8px;
    font-weight: 500;
}

.ai-message-row {
    display: flex;
    width: 100%;
    animation: fadeUpRow 0.3s ease forwards;
}

@keyframes fadeUpRow {
    0% { opacity: 0; transform: translateY(8px); }
    100% { opacity: 1; transform: translateY(0); }
}

.ai-bot-row {
    justify-content: flex-start;
}

.ai-user-row {
    justify-content: flex-end;
}

.ai-msg-avatar {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 13px;
    margin-right: 12px;
    flex-shrink: 0;
    align-self: flex-end;
    margin-bottom: 18px; /* align with bubble */
}

.ai-message-content {
    display: flex;
    flex-direction: column;
    max-width: 75%;
}

.ai-bot-row .ai-message-content {
    align-items: flex-start;
}

.ai-user-row .ai-message-content {
    align-items: flex-end;
}

.ai-bubble {
    padding: 10px 16px;
    font-size: 14px;
    line-height: 1.5;
    word-wrap: break-word;
}

.ai-bubble-bot {
    background-color: #ffffff;
    color: #1c1e21;
    border-radius: 18px 18px 18px 4px; /* Messenger Bot Bubble */
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.ai-bubble-user {
    background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
    color: #ffffff;
    border-radius: 18px 18px 4px 18px; /* Messenger User Bubble */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.ai-time {
    font-size: 11px;
    color: #8a8d91;
    margin-top: 4px;
    padding: 0 4px;
}

/* TYPING INDICATOR */
.ai-typing-indicator {
    display: flex;
    align-items: center;
    gap: 4px;
    padding: 12px 18px;
}

.ai-typing-indicator .dot {
    width: 6px;
    height: 6px;
    background-color: #8a8d91;
    border-radius: 50%;
    animation: typingBounce 1.4s infinite ease-in-out both;
}

.ai-typing-indicator .dot:nth-child(1) { animation-delay: -0.32s; }
.ai-typing-indicator .dot:nth-child(2) { animation-delay: -0.16s; }

@keyframes typingBounce {
    0%, 80%, 100% { transform: scale(0); opacity: 0.5; }
    40% { transform: scale(1); opacity: 1; }
}

/* FOOTER / INPUT */
.ai-chat-footer {
    background-color: #ffffff;
    padding: 14px 16px;
    border-top: 1px solid #e4e6eb;
    z-index: 2;
}

.ai-input-form {
    display: flex;
    flex-direction: column;
    width: 100%;
}

.ai-input-wrapper {
    display: flex;
    align-items: flex-end;
    background-color: #f0f2f5;
    border-radius: 24px;
    padding: 6px 14px;
    border: 1px solid transparent;
    transition: all 0.2s;
}

.ai-input-wrapper:focus-within {
    background-color: #ffffff;
    border-color: var(--accent-primary);
    box-shadow: 0 0 0 2px rgba(0,0,0,0.05);
}

#aiChatInput {
    flex: 1;
    border: none;
    background: transparent;
    padding: 8px 0;
    font-size: 14px;
    color: #1c1e21;
    resize: none;
    max-height: 120px;
    outline: none;
    line-height: 1.4;
    font-family: inherit;
}

#aiChatInput::placeholder {
    color: #8a8d91;
}

.ai-send-button {
    background: transparent;
    border: none;
    color: var(--accent-primary);
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    font-size: 18px;
    margin-left: 8px;
    flex-shrink: 0;
    transition: all 0.2s;
}

.ai-send-button:not(:disabled):hover {
    background-color: #e6f2ff;
    transform: scale(1.1);
}

.ai-send-button:disabled {
    color: #bcc0c4;
    cursor: not-allowed;
}

.ai-error-text {
    color: #e53e3e;
    font-size: 12px;
    margin-top: 8px;
    padding: 0 4px;
}

/* FLOATING TRIGGER BUTTON */
.ai-trigger-btn {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
    border: none;
    color: white;
    cursor: pointer;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 26px;
    transition: transform 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.3s;
    position: relative;
    float: right; /* To keep it aligned right */
}

.ai-trigger-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0,132,255,0.6);
}

.ai-trigger-btn.active {
    background: #e4e6eb; /* Gray like messenger close */
    color: #1c1e21;
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    transform: scale(0.9);
}

.ai-trigger-btn.active:hover {
    transform: scale(1);
}

.ai-trigger-icon {
    position: absolute;
    transition: opacity 0.3s, transform 0.3s;
    display: flex;
    justify-content: center;
    align-items: center;
}

.ai-icon-close {
    opacity: 0;
    transform: rotate(-90deg) scale(0);
}

.ai-trigger-btn.active .ai-icon-chat {
    opacity: 0;
    transform: rotate(90deg) scale(0);
}

.ai-trigger-btn.active .ai-icon-close {
    opacity: 1;
    transform: rotate(0) scale(1);
    font-size: 22px;
}

.ai-badge {
    position: absolute;
    top: -2px;
    right: -2px;
    background-color: #ff3b30;
    color: white;
    font-size: 11px;
    font-weight: bold;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    border: 2px solid #ffffff;
}

/* RESPONSIVE FOR MOBILE */
@media (max-width: 480px) {
    .ai-chat-window {
        width: calc(100vw - 32px);
        height: calc(100vh - 120px);
        bottom: 80px;
        right: -8px; 
    }
    .ai-chat-container {
        bottom: 16px;
        right: 16px;
    }
}
</style>

<!-- ======================= JS ======================= -->
<script>
document.addEventListener('livewire:init', function () {

    const scrollToBottom = () => {
        const chatBody = document.getElementById('aiChatBody');
        if (chatBody) {
            chatBody.scrollTop = chatBody.scrollHeight;
        }
    };

    const setupInteractiveElements = () => {
        const input = document.getElementById('aiChatInput');
        const chips = document.querySelectorAll('.ai-suggestion-btn');

        // Handle suggestion clicks
        chips.forEach(chip => {
            chip.onclick = () => {
                if (input) {
                    input.value = chip.getAttribute('data-prompt');
                    input.dispatchEvent(new Event('input', { bubbles: true })); 
                    input.focus();
                }
            };
        });

        // Handle text area auto-resize and Enter to send
        if (input) {
            input.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });

            input.addEventListener('keydown', function(e) {
                // Enter without shift = send
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    if (this.value.trim() !== '') {
                        @this.set('prompt', this.value);
                        @this.call('sendMessage');
                        
                        // Reset design
                        this.style.height = 'auto';
                        this.value = '';
                    }
                }
            });
        }
    };

    // Livewire specific hooks
    Livewire.on('floating-chat-updated', () => {
        setTimeout(scrollToBottom, 50);
        const input = document.getElementById('aiChatInput');
        if(input) {
            input.style.height = 'auto';
        }
    });

    Livewire.hook('commit', ({ component, commit, respond, succeed, fail }) => {
        succeed(({ snapshot, effect }) => {
            setTimeout(scrollToBottom, 50);
            setTimeout(setupInteractiveElements, 50);
        });
    });

    // Run on initial load
    setTimeout(scrollToBottom, 100);
    setTimeout(setupInteractiveElements, 100);
});
</script>