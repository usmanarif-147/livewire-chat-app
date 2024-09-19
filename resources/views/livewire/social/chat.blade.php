<div>
    <section class="message-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="chat-area">
                        <!-- chatlist -->
                        <livewire:social.people />
                        <!-- chatlist -->

                        @if ($selectedId)
                            <livewire:social.chat-box :id="$selectedId" key="{{ $selectedId }}" />
                        @endif

                    </div>
                    <!-- chatbox -->
                </div>
            </div>
        </div>
    </section>

    <script>
        window.addEventListener('chat-box-rendered', event => {
            scrollToBottom();
        });

        function scrollToBottom() {
            var lastMessage = document.getElementById('last-message');;
            if (lastMessage) {
                lastMessage.scrollIntoView({
                    behavior: 'smooth'
                });
            }
        }
    </script>
</div>
