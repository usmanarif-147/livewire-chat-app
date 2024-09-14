<div class="chatlist">
    <div class="modal-dialog-scrollable">
        <div class="modal-content">
            <div class="chat-header">
                <div class="msg-search">

                    <input type="text" class="form-control {{ $searchList && $searchList->count() > 0 ? 'show' : '' }}"
                        placeholder="Search" wire:model.live="search"
                        aria-expanded="{{ $searchList && $searchList->count() > 0 ? 'true' : 'false' }}">

                    <ul class="dropdown-menu w-100 {{ $searchList && $searchList->count() > 0 ? 'show' : '' }}"
                        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 40px);">
                        @foreach ($searchList as $person)
                            <li>
                                <button class="dropdown-item" type="button"
                                    wire:click="makeConnection('{{ $person->id }}', '{{ $person->name }}')">
                                    {{ $person->name }}
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <br>
            <div class="modal-body">
                <div class="chat-lists">
                    <div class="chat-list">
                        @foreach ($connections as $connection)
                            <a href="javascript:void(0)" wire:click="openChat('{{ $connection['id'] }}')"
                                class="d-flex align-items-center mb-1 p-2"
                                style="background: {{ $selectedId == $connection['id'] ? 'rgb(202, 229, 238)' : '' }}; ">
                                <div class="flex-shrink-0">
                                    <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png"
                                        alt="user img">
                                    <span class="active"></span>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h3>{{ $connection['name'] }}</h3>
                                    <p>{{ $connection['email'] }}</p>
                                    <p>front end developer</p>
                                </div>
                                <div>
                                    <span class="text-dark">5</span>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- chat-list -->
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('click', function(event) {
            Livewire.dispatch('clear-search');
        });
    </script>
</div>
