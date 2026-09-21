<div x-data="chatbot()" class="chatbot-wrapper" style="z-index: 9999;">
    {{-- Floating Button --}}
    <button @click="toggleChat" class="chatbot-toggle" :class="isOpen ? 'is-active' : ''" aria-label="المساعد الذكي">
        <i class="fa-solid fa-robot" x-show="!isOpen"></i>
        <i class="fa-solid fa-xmark" x-show="isOpen" style="display: none;"></i>
    </button>

    {{-- Chat Window --}}
    <div x-show="isOpen" 
         x-transition:enter="chat-enter"
         x-transition:enter-start="chat-enter-start"
         x-transition:enter-end="chat-enter-end"
         x-transition:leave="chat-leave"
         x-transition:leave-start="chat-leave-start"
         x-transition:leave-end="chat-leave-end"
         class="chatbot-window" style="display: none;">
        
        {{-- Header --}}
        <div class="chatbot-header">
            <div class="chatbot-header-info">
                <div class="chatbot-avatar">
                    <i class="fa-solid fa-robot"></i>
                </div>
                <div>
                    <h4>واحة بوت</h4>
                    <p>متصل الآن</p>
                </div>
            </div>
            <button @click="toggleChat" class="chatbot-close"><i class="fa-solid fa-chevron-down"></i></button>
        </div>

        {{-- Messages Area --}}
        <div class="chatbot-messages" x-ref="messagesBox">
            <template x-for="(msg, index) in messages" :key="index">
                <div :class="['chat-message', msg.sender === 'bot' ? 'msg-bot' : 'msg-user']">
                    <div class="msg-bubble" x-html="msg.text"></div>
                </div>
            </template>
            
            <div x-show="isTyping" class="chat-message msg-bot">
                <div class="msg-bubble typing-indicator">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        {{-- Suggestions --}}
        <div class="chatbot-suggestions" x-show="showSuggestions && suggestions.length > 0">
            <template x-for="(sugg, index) in suggestions" :key="index">
                <button @click="sendSuggestion(sugg)" x-text="sugg" class="suggestion-chip"></button>
            </template>
        </div>

        {{-- Input Area --}}
        <div class="chatbot-input-area">
            <input type="text" 
                   x-model="userInput" 
                   @keydown.enter="sendMessage" 
                   placeholder="اكتب رسالتك هنا..." 
                   class="chatbot-input">
            <button @click="sendMessage" class="chatbot-send" :disabled="userInput.trim() === ''">
                <i class="fa-solid fa-paper-plane"></i>
            </button>
        </div>
    </div>
</div>

<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('chatbot', () => ({
        isOpen: false,
        isTyping: false,
        userInput: '',
        showSuggestions: true,
        suggestions: [
            'من أنتم؟',
            'منتجاتكم',
            'خدماتكم',
            'مشاريعكم',
            'رقم التواصل'
        ],
        messages: [
            { sender: 'bot', text: 'أهلاً بك في شركة واحة إنرجي ☀️<br>أنا المساعد الذكي، كيف يمكنني مساعدتك اليوم؟' }
        ],
        faqs: [
            {
                keywords: ['من أنتم', 'تعريف', 'الشركة', 'عنكم', 'معلومات', 'واحة'],
                answer: 'نحن شركة <strong>واحة إنرجي</strong>، شركة رائدة متخصصة في حلول الطاقة الشمسية المتكاملة في المملكة العربية السعودية واليمن. نقدم خدمات التصميم، التوريد، التركيب والصيانة بأنظمة تتوافق مع أعلى المعايير العالمية.'
            },
            {
                keywords: ['منتجات', 'المنتجات', 'الواح', 'ألواح', 'بطاريات', 'محولات', 'انفرتر'],
                answer: 'نوفر أفضل منتجات الطاقة الشمسية من علامات تجارية عالمية مثل (Jinko, Longi, Trina, Deye, Pylontech).<br><a href="/products" class="chat-link">تصفح منتجاتنا من هنا</a>'
            },
            {
                keywords: ['خدمات', 'الخدمات', 'تركيب', 'صيانة', 'دراسة'],
                answer: 'تشمل خدماتنا:<br>- الدراسات والتصاميم الفنية<br>- التوريد والتركيب<br>- الدعم الفني والصيانة<br><a href="/services" class="chat-link">تعرف على خدماتنا بالكامل</a>'
            },
            {
                keywords: ['مشاريع', 'المشاريع', 'اعمالكم', 'أعمالكم', 'انجازات'],
                answer: 'نفذنا العديد من المشاريع الناجحة للمصانع، المؤسسات، والمنازل في مجالات الطاقة الشمسية المرتبطة والمستقلة عن الشبكة.<br><a href="/projects" class="chat-link">شاهد مشاريعنا السابقة</a>'
            },
            {
                keywords: ['تواصل', 'رقم', 'واتساب', 'موقع', 'عنوان', 'تلفون', 'هاتف', 'اتصال'],
                answer: 'يمكنك التواصل معنا عبر:<br>📞 هاتف: 0509977409<br>✉️ إيميل: info@wahatenergy.com<br>📍 الموقع: الرياض - العقيق<br>أو عبر <a href="/contact" class="chat-link">صفحة اتصل بنا</a>'
            },
            {
                keywords: ['سلام', 'مرحبا', 'أهلا', 'اهلا', 'السلام عليكم', 'هلا'],
                answer: 'وعليكم السلام ورحمة الله! أهلاً بك. تفضل، كيف يمكنني مساعدتك في مجال الطاقة الشمسية؟'
            },
            {
                keywords: ['سعر', 'اسعار', 'أسعار', 'تكلفة', 'حساب'],
                answer: 'تختلف الأسعار حسب حجم النظام والمنتجات المستخدمة. يمكنك استخدام <a href="/calculator" class="chat-link">حاسبة الطاقة الشمسية</a> للحصول على تقدير فوري، أو طلب عرض سعر مفصل.'
            }
        ],

        toggleChat() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.scrollToBottom();
            }
        },

        sendSuggestion(text) {
            this.userInput = text;
            this.showSuggestions = false;
            this.sendMessage();
        },

        sendMessage() {
            const text = this.userInput.trim();
            if (text === '') return;

            // Add user message
            this.messages.push({ sender: 'user', text: text });
            this.userInput = '';
            this.scrollToBottom();

            // Simulate typing and reply
            this.isTyping = true;
            
            setTimeout(() => {
                this.isTyping = false;
                const reply = this.getBotReply(text);
                this.messages.push({ sender: 'bot', text: reply });
                this.scrollToBottom();
            }, 800); // 800ms delay for natural feel
        },

        getBotReply(text) {
            const query = text.toLowerCase();
            
            // Search in FAQs
            for (let faq of this.faqs) {
                if (faq.keywords.some(keyword => query.includes(keyword.toLowerCase()))) {
                    return faq.answer;
                }
            }

            // Fallback
            return 'عذراً، لم أتمكن من فهم سؤالك بشكل كامل. يمكنك صياغة السؤال بطريقة أخرى أو <a href="/contact" class="chat-link">التواصل مع فريق الدعم الفني مباشرة</a>.';
        },

        scrollToBottom() {
            setTimeout(() => {
                const box = this.$refs.messagesBox;
                if(box) box.scrollTop = box.scrollHeight;
            }, 50);
        }
    }));
});
</script>
