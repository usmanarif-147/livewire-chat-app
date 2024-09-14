<div class="send-box">
    @if ($messageInput)
        <form wire:submit.prevent="sendMessage">
            <input type="text" class="form-control" wire:model.live="messageText" placeholder="Write message…">

            <button class="{{ $messageText ? '' : 'btn-secondary' }}" type="submit" {{ $messageText ? '' : 'disabled' }}
                style="cursor: {{ $messageText ? 'pointer' : '' }}">
                <i class="fa fa-paper-plane" aria-hidden="true"></i>
                Send
            </button>
        </form>
    @endif

    {{-- <div class="send-btns">
        <div class="attach">
            <div class="button-wrapper">
                <span class="label">
                    <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/upload.svg" alt="image title">
                    attached file
                </span><input type="file" name="upload" id="upload" class="upload-box" placeholder="Upload File"
                    aria-label="Upload File">
            </div>

            <select class="form-control" id="exampleFormControlSelect1">
                <option>Select template</option>
                <option>Template 1</option>
                <option>Template 2</option>
            </select>

            <div class="add-apoint">
                <a href="#" data-toggle="modal" data-target="#exampleModal4"><svg
                        xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewbox="0 0 16 16"
                        fill="none">
                        <path
                            d="M8 16C3.58862 16 0 12.4114 0 8C0 3.58862 3.58862 0 8 0C12.4114 0 16 3.58862 16 8C16 12.4114 12.4114 16 8 16ZM8 1C4.14001 1 1 4.14001 1 8C1 11.86 4.14001 15 8 15C11.86 15 15 11.86 15 8C15 4.14001 11.86 1 8 1Z"
                            fill="#7D7D7D" />
                        <path
                            d="M11.5 8.5H4.5C4.224 8.5 4 8.276 4 8C4 7.724 4.224 7.5 4.5 7.5H11.5C11.776 7.5 12 7.724 12 8C12 8.276 11.776 8.5 11.5 8.5Z"
                            fill="#7D7D7D" />
                        <path
                            d="M8 12C7.724 12 7.5 11.776 7.5 11.5V4.5C7.5 4.224 7.724 4 8 4C8.276 4 8.5 4.224 8.5 4.5V11.5C8.5 11.776 8.276 12 8 12Z"
                            fill="#7D7D7D" />
                    </svg> Appoinment</a>
            </div>
        </div>
    </div> --}}

</div>
