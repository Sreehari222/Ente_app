@extends('layouts.sales') {{-- or layouts.user --}}

@section('content')

    <style>
        .chat-list {
            max-height: 75vh;
            overflow-y: auto;
        }

        .unread {
            background: #eef5ff;
        }

        .bubble {
            max-width: 70%;
            padding: 10px 14px;
            border-radius: 15px;
        }

        .mine {
            background: #198754;
            color: #fff;
        }

        .theirs {
            background: #e9ecef;
        }
    </style>

    <div class="container-fluid">
        <div class="row">

            <!-- LEFT: CHAT LIST -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header fw-bold">Inbox</div>

                    <div class="list-group list-group-flush chat-list">
                        @foreach ($messages as $chat)
                            @php
                                $pivot = $chat->users->firstWhere('id', auth()->id())?->pivot;
                                $isUnread = $pivot && is_null($pivot->read_at);
                                $lastReply = $chat->replies->last();
                                $admin = $chat->sender;
                            @endphp

                            <a href="?message={{ $chat->id }}"
                                class="list-group-item {{ $isUnread ? 'unread' : '' }} {{ request('message') == $chat->id ? 'active' : '' }}">

                                <div class="d-flex justify-content-between">
                                    <strong>{{ $admin?->name ?? 'Admin' }}</strong>
                                    <small class="text-muted">
                                        {{ optional($lastReply)->created_at?->format('h:i A') }}
                                    </small>
                                </div>

                                <div class="small text-muted">
                                    {{ Str::limit(optional($lastReply)->message ?? $chat->message, 35) }}
                                </div>

                                @if ($isUnread)
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
                        $activeChat = request('message') ? $messages->firstWhere('id', request('message')) : null;

                        if ($activeChat) {
                            $activeChat->users()->updateExistingPivot(auth()->id(), [
                                'read_at' => now(),
                            ]);
                        }
                    @endphp

                    @if ($activeChat)
                        <div class="card-header fw-bold">
                            Admin
                        </div>

                        <div class="card-body" id="chatBody" style="height:55vh; overflow-y:auto">

                            <!-- Original -->
                            <div class="d-flex justify-content-start mb-3">
                                <div class="bubble theirs">
                                    {{ $activeChat->message }}
                                </div>
                            </div>

                            <!-- Replies -->
                            @foreach ($activeChat->replies as $reply)
                                @php $mine = $reply->sender_id === auth()->id(); @endphp

                                <div class="d-flex mb-2 {{ $mine ? 'justify-content-end' : 'justify-content-start' }}">
                                    <div class="bubble {{ $mine ? 'mine' : 'theirs' }}">
                                        {{ $reply->message }}
                                        <div class="small text-muted text-end mt-1">
                                            {{ $reply->created_at->format('h:i A') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Reply -->
                        <div class="card-footer">
                            <form action="{{ route('admin.messages.reply', $activeChat->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="message" class="form-control" placeholder="Type reply..."
                                        required>
                                    <button class="btn btn-success">
                                        <i class="ri-send-plane-line"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-body d-flex justify-content-center align-items-center text-muted">
                            Select a message to read
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
