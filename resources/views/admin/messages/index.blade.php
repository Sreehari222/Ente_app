@extends('layouts.admin')

@section('content')

<style>
    .chat-list {
        max-height: 75vh;
        overflow-y: auto;
    }
    .chat-item.unread {
        background: #eef5ff;
    }
    .chat-bubble {
        max-width: 70%;
        padding: 10px 14px;
        border-radius: 15px;
        word-wrap: break-word;
    }
    .mine {
        background: #0d6efd;
        color: #fff;
        border-bottom-right-radius: 3px;
    }
    .theirs {
        background: #e9ecef;
        color: #000;
        border-bottom-left-radius: 3px;
    }
</style>

<div class="container-fluid">
    <div class="row">

        <!-- LEFT: CHAT LIST -->
        <div class="col-md-4">
            <div class="card h-100">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <strong>Messages</strong>
                    <a href="{{ route('admin.messages.create') }}" class="btn btn-sm btn-primary">
                        <i class="ri-chat-new-line"></i>
                    </a>
                </div>

                <div class="list-group list-group-flush chat-list">

                    @foreach ($messages as $chat)
                        @php
                            $authId = auth()->id();
                            $pivot = $chat->users->firstWhere('id', $authId)?->pivot;
                            $isUnread = $pivot && is_null($pivot->read_at);
                            $receiver = $chat->users->firstWhere('id', '!=', $authId);
                            $lastReply = $chat->replies->last();
                        @endphp

                        <a href="?message={{ $chat->id }}"
                           class="list-group-item chat-item {{ $isUnread ? 'unread' : '' }} {{ request('message') == $chat->id ? 'active' : '' }}">

                            <div class="d-flex justify-content-between">
                                <strong class="{{ $isUnread ? 'text-primary' : '' }}">
                                    {{ $receiver?->name }}
                                </strong>
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

                </div>
            </div>
        </div>

        <!-- RIGHT: CHAT VIEW -->
        <div class="col-md-8">
            <div class="card h-100">

                @php
                    $activeChat = request('message')
                        ? $messages->firstWhere('id', request('message'))
                        : null;

                    if ($activeChat) {
                        $activeChat->users()->updateExistingPivot(auth()->id(), [
                            'read_at' => now()
                        ]);
                    }
                @endphp

                @if($activeChat)
                    @php
                        $receiver = $activeChat->users->firstWhere('id', '!=', auth()->id());
                    @endphp

                    <!-- HEADER -->
                    <div class="card-header">
                        <strong>{{ $receiver?->name }}</strong>
                        <div class="small text-muted">Chat conversation</div>
                    </div>

                    <!-- MESSAGES -->
                    <div class="card-body" id="chatBody" style="overflow-y:auto; height:55vh">

                        <!-- Original message -->
                        <div class="d-flex justify-content-end mb-3">
                            <div class="chat-bubble mine">
                                {{ $activeChat->message }}
                            </div>
                        </div>

                        <!-- Replies -->
                        @foreach($activeChat->replies as $reply)
                            @php $mine = $reply->sender_id === auth()->id(); @endphp

                            <div class="d-flex mb-2 {{ $mine ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="chat-bubble {{ $mine ? 'mine' : 'theirs' }}">
                                    {{ $reply->message }}
                                    <div class="small text-muted text-end mt-1">
                                        {{ $reply->created_at->format('h:i A') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- INPUT -->
                    <div class="card-footer">
                        <form method="POST" action="{{ route('admin.messages.reply', $activeChat->id) }}">
                            @csrf
                            <div class="input-group">
                                <input type="text"
                                       name="message"
                                       class="form-control"
                                       placeholder="Type a message..."
                                       required>
                                <button class="btn btn-primary">
                                    <i class="ri-send-plane-line"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                @else
                    <div class="card-body d-flex align-items-center justify-content-center text-muted">
                        <div class="text-center">
                            <i class="ri-chat-3-line fs-1 mb-2"></i>
                            <p>Select a chat to start messaging</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>

    </div>
</div>

<script>
    const chatBody = document.getElementById('chatBody');
    if (chatBody) chatBody.scrollTop = chatBody.scrollHeight;
</script>

@endsection
