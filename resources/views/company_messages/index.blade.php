@extends('layouts.' . auth()->user()->role)

@section('title', 'Company Messages')

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-header fw-bold">Company Messages</div>
        <div class="card-body">
            @forelse ($messages as $msg)
                <div class="card mb-2">
                    <div class="card-body">
                        <h6>{{ $msg->title }}</h6>
                        <p>{{ $msg->message }}</p>
                        <small class="text-muted">{{ $msg->created_at->format('d M Y, h:i A') }}</small>
                    </div>
                </div>
            @empty
                <p class="text-center text-muted">No company messages yet</p>
            @endforelse
        </div>
    </div>
</div>
@endsection
