@extends('layouts.admin')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4>Admin Messages</h4>

            <a href="{{ route('admin.messages.create') }}" class="btn btn-primary">
                <i class="ri-send-plane-line"></i> New Message
            </a>
        </div>

        <div class="row">

            <!-- LEFT: MESSAGE LIST -->
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <strong>Sent Messages</strong>
                    </div>

                    <div class="list-group list-group-flush" style="max-height:70vh; overflow-y:auto">
                        @forelse($messages as $msg)
                            @php
                                $isUnread = isset($msg->pivot) && !$msg->pivot->is_read;
                            @endphp

                            <a href="?message={{ $msg->id }}"
                                class="list-group-item list-group-item-action
          {{ request('message') == $msg->id ? 'active' : '' }}
          {{ $isUnread ? 'bg-soft-primary' : '' }}">

                                <div class="d-flex justify-content-between">
                                    <strong class="{{ $isUnread ? 'fw-bold text-primary' : '' }}">
                                        {{ $msg->sender->name }}
                                    </strong>

                                    <small>
                                        {{ $msg->created_at->format('d M') }}
                                        @if ($isUnread)
                                            <span class="ms-1 badge rounded-pill bg-primary">●</span>
                                        @endif
                                    </small>
                                </div>

                                <div class="text-muted small">
                                    {{ Str::limit($msg->message, 40) }}
                                </div>

                            </a>

                        @empty
                            <div class="p-3 text-center text-muted">
                                No messages yet
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>

            <!-- RIGHT: CHAT VIEW -->
            <div class="col-md-8">
                <div class="card h-100">

                    @php
                        $activeMessage = request('message')
                            ? $messages->where('id', request('message'))->first()
                            : null;
                    @endphp

                    @if ($activeMessage)
                        <div class="card-header">
                            <strong>{{ $msg->sender->name }}</strong>
                            <div class="small text-muted">
                                Sent on {{ $activeMessage->created_at->format('d M Y, h:i A') }}
                            </div>
                        </div>

                        <div class="card-body" style="height:45vh; overflow-y:auto">

                            <!-- ORIGINAL MESSAGE (Admin always RIGHT) -->
                            <div class="d-flex justify-content-end mb-3">
                                <div class="bg-primary text-white p-3 rounded" style="max-width:75%">
                                    {{ $activeMessage->message }}
                                </div>
                            </div>

                            <!-- REPLIES -->
                            @foreach ($activeMessage->replies as $reply)
                                @php
                                    $isMine = $reply->sender_id === auth()->id();
                                @endphp

                                <div class="d-flex {{ $isMine ? 'justify-content-end' : 'justify-content-start' }} mb-2">

                                    <div class="{{ $isMine ? 'bg-primary text-white' : 'bg-success text-white' }} p-2 rounded"
                                        style="max-width:75%">

                                        {{ $reply->message }}

                                        <div class="small text-light mt-1 text-end">
                                            {{ $reply->created_at->format('d M Y, h:i A') }}
                                        </div>
                                    </div>

                                </div>
                            @endforeach
                        </div>

                        <!-- REPLY FORM -->
                        <div class="card-footer">
                            <form action="{{ route('admin.messages.reply', $activeMessage->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="text" name="message" class="form-control"
                                        placeholder="Type your reply..." required>
                                    <button class="btn btn-primary">
                                        <i class="ri-send-plane-line"></i> Send
                                    </button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card-body d-flex align-items-center justify-content-center text-muted">
                            <div class="text-center">
                                <i class="ri-chat-3-line fs-1 mb-2"></i>
                                <p>Select a message to view conversation</p>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
@endsection
