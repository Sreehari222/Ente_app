@extends('layouts.sales')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Message from {{ $message->sender->name ?? 'Unknown' }}</h4>

        <div class="card">
            <div class="card-body" style="max-height: 60vh; overflow-y:auto">
                <!-- Original message -->
                <div class="mb-3">
                    <div class="bg-primary text-white p-3 rounded">
                        {{ $message->message }}
                    </div>
                    <small class="text-muted">Sent on {{ $message->created_at->format('d M Y, h:i A') }}</small>
                </div>

                <hr>

                <!-- Replies -->
                <div class="replies">
                    @foreach ($message->replies as $reply)
                        <div class="mb-2">
                            <strong>{{ $reply->sender->name ?? 'Unknown' }}</strong>
                            <span class="text-muted small">{{ $reply->created_at->format('d M Y, h:i A') }}</span>
                            <div class="p-2 border rounded">
                                {{ $reply->message }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Reply form -->
            <div class="card-footer">
                <form action="{{ route('admin.messages.reply', $activeChat->id) }}" method="POST">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="message" class="form-control" placeholder="Type a reply..." required>
                        <button class="btn btn-success" type="submit">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
