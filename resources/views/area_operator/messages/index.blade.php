@extends('layouts.area_operator')

@section('content')
<style>
    .chat-list { max-height: 70vh; overflow-y: auto; }
    .unread { background: #eef5ff; }
    .chat-body { height: 55vh; overflow-y: auto; }
</style>

<div class="container-fluid">

    <!-- HEADER: New Message -->
    <div class="d-flex justify-content-between align-items-center mb-2">
        <h5>Messages</h5>
        <a href="{{ route('deo.messages.create') }}" class="btn btn-primary btn-sm">
            <i class="ri-chat-new-line"></i> New Message
        </a>
    </div>

    <div class="row">

        <!-- LEFT: CHAT LIST -->
        <div class="col-md-4">
            <div class="card h-100">
                <div class="list-group list-group-flush chat-list">

                    @foreach ($messages as $chat)
                        @php
                            $pivot = $chat->users->firstWhere('id', auth()->id())?->pivot;
                            $isUnread = $pivot && $pivot->is_read == 0;
                            $receiver = $chat->users->firstWhere('id', '!=', auth()->id());
                            $lastReply = $chat->replies->last();
                        @endphp

                        <a href="?message={{ $chat->id }}"
                           class="list-group-item list-group-item-action
                           {{ request('message') == $chat->id ? 'active' : '' }}
                           {{ $isUnread ? 'unread' : '' }}">

                            <div class="d-flex justify-content-between">
                                <strong>{{ $receiver?->name }}</strong>
                                <small class="text-muted">
                                    {{ optional($lastReply)->created_at?->format('h:i A') }}
                                </small>
                            </div>

                            <div class="small text-muted">
                                {{ Str::limit(optional($lastReply)->message ?? $chat->message, 35) }}
                            </div>

                            @if($isUnread)
                                <span class="badge bg-primary mt-1">New</span>
                            @endif
                        </a>
                    @endforeach

                    @if($messages->isEmpty())
                        <div class="p-3 text-center text-muted">
                            No messages yet
                        </div>
                    @endif

                </div>
            </div>
        </div>

        <!-- RIGHT: CHAT VIEW -->
        <div class="col-md-8">
            <div class="card h-100">

                @if($activeChat)
                    @php
                        $receiver = $activeChat->users->firstWhere('id', '!=', auth()->id());
                    @endphp

                    <div class="card-header fw-bold">
                        {{ $receiver?->name }}
                    </div>

                    <div class="card-body chat-body" id="chatBody">

                        <!-- ORIGINAL MESSAGE -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="bg-primary text-white p-3 rounded">
                                {{ $activeChat->message }}
                            </div>
                        </div>

                        <!-- REPLIES -->
                        @foreach ($activeChat->replies as $reply)
                            @php $mine = $reply->sender_id === auth()->id(); @endphp
                            <div class="d-flex {{ $mine ? 'justify-content-end' : 'justify-content-start' }} mb-2">
                                <div class="p-2 rounded {{ $mine ? 'bg-primary text-white' : 'bg-success text-white' }}">
                                    {{ $reply->message }}
                                    <div class="small text-light text-end">
                                        {{ $reply->created_at->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- REPLY FORM -->
                    <div class="card-footer">
                        <form method="POST" action="{{ route('area_operator.messages.reply', $activeChat->id) }}">
                            @csrf
                            <div class="input-group">
                                <input type="text" name="message" class="form-control" placeholder="Type message..." required>
                                <button class="btn btn-primary">
                                    <i class="ri-send-plane-line"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                @else
                    <div class="card-body d-flex justify-content-center align-items-center text-muted">
                        Select a chat to start messaging
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

<script>
const chatBody = document.getElementById('chatBody');
if(chatBody) chatBody.scrollTop = chatBody.scrollHeight;
</script>
@endsection
