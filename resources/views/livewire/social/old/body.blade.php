<div class="modal-body">
    <div class="msg-body">
        <ul>
            @foreach ($messages as $message)
                @if ($message->message)
                    <li class="sender">
                        <p> {{ $message->message }} </p>
                        <span class="time">{{ $message->created_at }}</span>
                    </li>
                @else
                    <p> No Message Available </p>
                @endif
            @endforeach
        </ul>
    </div>
</div>
