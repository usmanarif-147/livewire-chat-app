<div class="msg-head">
    @if ($user)
        <div class="row">
            <div class="col-8">
                <div class="d-flex align-items-center">
                    <span class="chat-icon"><img class="img-fluid"
                            src="https://mehedihtml.com/chatbox/assets/img/arroleftt.svg" alt="image title"></span>
                    <div class="flex-shrink-0">
                        <img class="img-fluid" src="https://mehedihtml.com/chatbox/assets/img/user.png" alt="user img">
                    </div>
                    <div class="flex-grow-1 ms-3">
                        <h3>{{ $user->name }}</h3>
                        <p>{{ $user->email }}</p>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <ul class="moreoption">
                    <li class="navbar nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false"><i class="fa fa-ellipsis-v" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="#">Action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">
                                    Another
                                    action
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else
                                    here</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    @else
        <h3> Start Chat With Your Friends </h3>
    @endif
</div>
