<div class="container" wire:poll>
    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card chat-app">
                <div id="plist" class="people-list">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <ul class="list-unstyled chat-list mt-2 mb-0 scrollbar-style">
                        @foreach ($users as $item)
                        <li class="clearfix" type="button" wire:click="startChat({{ $item->id }})">
                            <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="avatar">
                            <div class="about">
                                <div class="name">
                                    {{ $item->username }}
                                    @php
                                        // get notifcations/un read messages
                                        $notifications = App\Models\Message::where('is_read', '0')->where('sender_id', $item->id)->get();
                                    @endphp
                                    @if ($notifications->count() > 0)
                                        <small><span class="badge badge-danger text-light">{{ $notifications->count() }}</span></small>
                                    @endif
                                </div>
                                <div class="status">
                                    @if (Cache::has('is_online' . $item->id))
                                    <i class="fa fa-circle online"></i> Online
                                    @else
                                    <i class="fa fa-circle offline"></i>last {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="chat">
                    <div class="chat-header clearfix">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                                </a>
                                <div class="chat-about">
                                    @if ($noChat)
                                    <h6 class="m-b-0" style="text-transform: capitalize">{{ 'You are chatting with ' . $current->username}}</h6>

                                        @if (Cache::has('is_online' . $current->id))
                                        <i class="fa fa-circle online"></i> <small>Online</small>
                                        @else
                                        <i class="fa fa-circle offline"></i><small>Last seen: {{ \Carbon\Carbon::parse($current->last_seen)->diffForHumans() }} </small>
                                        @endif

                                    @else
                                        <h6 class="m-b-0">{{ Auth::user()->username }}</h6>
                                        <small>Select User to chat with!</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-lg-6 hidden-sm text-right">
                                <a href="javascript:void(0);" class="btn btn-outline-secondary"><i class="fa fa-camera"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-primary"><i class="fa fa-image"></i></a>
                                <a href="javascript:void(0);" class="btn btn-outline-info"><i class="fa fa-cogs"></i></a>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                 class="btn btn-outline-warning"><i class="fa fa-sign-out"></i></a>
                                 <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    @if($noChat)
                    <div class="chat-history">
                        <ul class="m-b-0 p-3 scrollbar-style" id="content_to_scroll">
                           @if ($messages->count())
                            @foreach ($messages as $chat)
                                @if ($chat->sender_id == Auth::user()->id && $chat->receiver_id == $receiver)
                                    <li class="clearfix">
                                        <div class="message my-message float-right"> {{ $chat->message }} </div>
                                        <div class="message-data text-right">
                                            <span class="message-data-time"><small>{{ $chat->created_at->diffForHumans() }}</small></span>
                                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="avatar">
                                        </div>
                                    </li>
                                @elseif($chat->sender_id == $receiver && $chat->receiver_id == Auth::user()->id)
                                    <li class="clearfix">
                                        <div class="message-data">
                                            <span class="message-data-time"><small>{{ $chat->created_at->diffForHumans() }}</small></span>
                                        </div>
                                        <div class="message my-message">{{ $chat->message }}</div>
                                    </li>
                                @endif
                            @endforeach
                           @else
                           <div style="min-height: auto">
                                <p class="no-chat-yet">No chats yet!</p>
                            </div>
                           @endif
                        </ul>
                    </div>
                    <div class="chat-message clearfix">
                        <form wire:submit.prevent="sendChat">
                            <div class="input-group mb-0">

                                <input onkeypress="Javascript: if (event.keyCode==13) myFunction();" type="text" class="form-control @error('message') is-invalid @enderror" placeholder="Enter text here..." wire:model.defer="message">
                                <input type="hidden" value="{{ $receiver }}" wire:model.defer="receiver_id">

                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-send"></i></span>
                                </div>
                                @error('message')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    @else
                    <div style="min-height: auto">
                        <p class="no-chat-yet">Select user from the left panel to chat with!</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
