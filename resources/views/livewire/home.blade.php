<div wire:poll>
    <div class="container p-0">

		<div class="card">
			<div class="row g-0">
				<div class="col-12 col-lg-5 col-xl-3 border-right">

					<div class="px-4 d-none d-md-block">
						<div class="d-flex align-items-center">
							<div class="flex-grow-1">
								<input type="text" class="form-control my-3" placeholder="Search...">
							</div>
						</div>
					</div>
                    @foreach ($users as $item)
					<li type="button" wire:click="startChat({{ $item->id }})" class="chat-members list-group-item list-group-item-action border-0">

                        @php
                        // get notifcations/un read messages
                        $notifications = App\Models\Message::where('is_read', '0')->where('sender_id', $item->id)->get();
                        @endphp

						<div class="d-flex align-items-start">
							<img src="{{ asset('storage/avators/' . $item->avator) }}" class="rounded-circle mr-1" alt="{{ $item->first_name. ' ' . $item->last_name }}" width="40" height="40">
							<div class="flex-grow-1 ml-3">
								<strong style="text-transform:capitalize">{{ $item->first_name. ' ' . $item->last_name }}
                                    @if ($notifications->count() > 0)
                                    <small><span class="badge badge-danger text-light float-right mt-2">{{ $notifications->count() }}</span></small>
                                    @endif
                                </strong>
                                @if (Cache::has('is_online' . $item->id))
                                <div class="small"><span class="fa fa-circle chat-online"></span> Online</div>
                                @else
                                <div class="small">Last seen: {{ \Carbon\Carbon::parse($item->last_seen)->diffForHumans() }}</div>
                                @endif

							</div>

						</div>
					</li>
                    @endforeach
					<hr class="d-block d-lg-none mt-1 mb-0">
				</div>
				<div class="col-12 col-lg-7 col-xl-9 chat-box">
                    @if ($noChat)
					<div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="{{ asset('storage/avators/' . $current->avator) }}" class="rounded-circle mr-1" alt="{{ $current->first_name . ' ' . $current->last_name }}" width="40" height="40">
							</div>

							<div class="flex-grow-1 pl-3">
                                <div class="row" style="width: 50%">
                                    <div class="col-10">
                                        <strong style="text-transform: capitalize">{{ $current->first_name . ' ' .$current->last_name }}</strong>
                                        @if (Cache::has('is_online' . $current->id))
                                        <div class="text-muted small"><i class="fa fa-circle chat-online"></i> <small>Online</small></div>
                                        @else
                                        <div class="text-muted small"><i class="fa fa-circle chat-offline"></i> <small>Last seen: {{ \Carbon\Carbon::parse($current->last_seen)->diffForHumans() }} </div>
                                        @endif
                                    </div>
                                    <span class="btn-group-vertical">
                                        <i wire:click="viewProfile({{ $current->id }})" title="View profile" class="btn btn-sm text-dark btn-outline-light fa fa-eye"></i>
                                        @if ($current->friends == null)
                                        <i wire:click="addFriend({{ $current->id }})" title="Add to friends" class="btn btn-sm text-dark btn-outline-light fa fa-plus"></i>
                                        @else
                                        <i wire:click="removeFriend({{ $current->id }})" title="Remove to friends" class="btn btn-sm text-success btn-outline-light fa fa-check"></i>
                                        @endif
                                    </span>
                                </div>



							</div>
							<div>
                                <button wire:click="clearChats" onclick="confirm('Are you sure of clearing chats?')" class="btn btn-light border px-3" title="Clear Chats"><span class="fa fa-trash"></span></button>
								<button class="btn btn-light border px-3" title="Friends"><spanc class="fa fa-users"></span></button>
                                <button class="btn btn-light border mr-1 px-3" title="Favorites"><span class="fa fa-star text-warning"></span></button>
								<button class="btn btn-light border mr-1 px-3 d-none d-md-inline-block" title="S"><span class="fa fa-cog"></span></button>
								<a wire:click="logout" class="btn btn-light border px-3" title="Logout"><span class="fa fa-sign-out"></span></a>
							</div>
						</div>
					</div>

					<div class="position-relative">
						<div class="chat-messages p-4" id="content_to_scroll">
                            @if ($messages->count())
                             @foreach ($messages as $chat)
                                @if ($chat->sender_id == Auth::user()->id && $chat->receiver_id == $receiver)
                                <div class="chat-message-right pb-4">
                                    @if ($chat->message == '0')
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <small class="text-muted" style="font-style: italic;">Message Deleted</small>
                                    </div>
                                    @else
                                    <div>
                                        <img src="{{ asset('storage/avators/' . Auth::user()->avator) }}" class="rounded-circle mr-1" alt="{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}" width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">{{ date('h:i a', strtotime($chat->created_at)) }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3" style="min-width: 100px">
                                        {{ $chat->message }}
                                        <span class="btn-group btn-block justify-content-between mb-0">
                                            <i wire:click="addFavorite({{ $chat->id }})" type="button" class="fa fa-star @if($chat->favorite != null) text-warning @else text-secondanry @endif icon"></i>
                                            <i wire:click="deleteMessage({{ $chat->id }})" type="button" class="fa fa-trash text-danger icon"></i>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                @elseif($chat->sender_id == $receiver && $chat->receiver_id == Auth::user()->id)

                                <div class="chat-message-left pb-4">
                                    @if ($chat->message == '0')
                                    <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                                        <small class="text-muted" style="font-style: italic;">Message Deleted</small>
                                    </div>
                                    @else
                                    <div>
                                        <img src="{{ asset('storage/avators/' . $current->avator) }}" class="rounded-circle mr-1" alt="{{ $current->first_name . ' ' . $current->last_name }}" width="40" height="40">
                                        <div class="text-muted small text-nowrap mt-2">{{ date('h:i a', strtotime($chat->created_at)) }}</div>
                                    </div>
                                    <div class="flex-shrink-1 bg-light rounded py-2 pb-0 px-3 ml-3" style="min-width: 100px">
                                        {{ $chat->message }}
                                        <br>
                                        <span class="btn-group btn-block justify-content-between">
                                            <i wire:click="addFavorite({{ $chat->id }})" type="button" class="fa fa-star @if($chat->favorite != null) text-warning @else text-secondanry @endif icon"></i>
                                            <i wire:click="deleteMessage({{ $chat->id }})" type="button" class="fa fa-trash text-danger icon"></i>
                                        </span>
                                    </div>
                                    @endif
                                </div>
                                @endif
                             @endforeach
                            @else
                                <div style="min-height: auto">
                                    <p class="no-chat-yet">No chats yet!</p>
                                </div>
                            @endif
						</div>
					</div>

					<div class="flex-grow-0 py-3 px-4 border-top">
						<form wire:submit.prevent="sendChat">
                            <div class="input-group">
                                <input type="hidden" value="{{ $receiver }}" wire:model.defer="receiver_id">
                                <input onfocus="myFunction()" autofocus type="text" class="form-control @error('message') is-invalid @enderror" wire:model.defer="message" placeholder="Type your message">
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
                    <div class="py-2 px-4 border-bottom d-none d-lg-block">
						<div class="d-flex align-items-center py-1">
							<div class="position-relative">
								<img src="{{ asset('storage/avators/' . Auth::user()->avator) }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
							</div>
							<div class="flex-grow-1 pl-3">
								<strong style="text-transform: capitalize">{{ Auth::user()->first_name . ' ' . Auth::user()->last_name }}</strong>
								<div class="text-muted small"><em>Select User to Chat with</em></div>
							</div>
							<div>
								<button class="btn btn-primary btn-lg mr-1 px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone feather-lg"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg></button>
								<button class="btn btn-info btn-lg mr-1 px-3 d-none d-md-inline-block"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-video feather-lg"><polygon points="23 7 16 12 23 17 23 7"></polygon><rect x="1" y="5" width="15" height="14" rx="2" ry="2"></rect></svg></button>
								<button class="btn btn-light border btn-lg px-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal feather-lg"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg></button>
							</div>
						</div>
					</div>
                    @endif

				</div>
			</div>
		</div>
	</div>
</div>
