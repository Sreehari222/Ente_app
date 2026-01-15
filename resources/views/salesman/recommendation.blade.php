@extends('layouts.salesman')

@section('title', 'Recommendations')

@section('content')

@php
    $receivedMessages = $receivedMessages ?? collect();
    $sentMessages = $sentMessages ?? collect();
@endphp

<div class="chat-wrapper d-lg-flex gap-1 mx-n4 mt-n4 p-1">

    <!-- ================= LEFT SIDE ================= -->
    <div class="chat-leftsidebar minimal-border">
        <div class="px-4 pt-4">
            <h5 class="mb-3">Recommendations</h5>
        </div>

        <div class="chat-room-list pt-2" data-simplebar>

            <!-- RECEIVED -->
            <div class="px-3 mb-2">
                <small class="text-uppercase text-muted fw-semibold">
                    Received
                </small>
            </div>

            <ul class="list-unstyled chat-list chat-user-list px-3 mb-3">
                @forelse($receivedMessages as $msg)
                    <li class="mb-2">
                        <div class="p-2 rounded border">
                            <p class="mb-1 text-wrap">
                                {{ $msg->description }}
                            </p>
                            <small class="text-muted">
                                From: {{ $msg->user->name ?? 'User' }}
                                · {{ $msg->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </li>
                @empty
                    <li class="text-muted text-center py-2">
                        No received recommendations
                    </li>
                @endforelse
            </ul>

            <!-- SENT -->
            <div class="px-3 mb-2">
                <small class="text-uppercase text-muted fw-semibold">
                    Sent
                </small>
            </div>

            <ul class="list-unstyled chat-list chat-user-list px-3">
                @forelse($sentMessages as $msg)
                    <li class="mb-2">
                        <div class="p-2 rounded border bg-light">
                            <p class="mb-1 text-wrap">
                                {{ $msg->description }}
                            </p>
                            <small class="text-muted">
                                To: {{ $msg->toUser->name ?? 'User' }}
                                · {{ $msg->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </li>
                @empty
                    <li class="text-muted text-center py-2">
                        No sent recommendations
                    </li>
                @endforelse
            </ul>

        </div>
    </div>
    <!-- ================= END LEFT SIDE ================= -->


    <!-- ================= RIGHT SIDE ================= -->
    <div class="user-chat w-100 minimal-border">
        <div class="chat-content d-lg-flex">
            <div class="w-100 position-relative">

                <div class="p-3 border-bottom">
                    <h5 class="mb-0">Send Recommendation</h5>
                </div>

                @if(session('success'))
                    <div class="alert alert-success m-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger m-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="p-4">
                    <form method="POST" action="{{ route('salesman.recommendations.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Send To
                            </label>
                            <select name="to_id" class="form-select" required>
                                <option value="">Select User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->role }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">
                                Recommendation
                            </label>
                            <textarea
                                name="description"
                                class="form-control"
                                rows="5"
                                required
                            ></textarea>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                Submit Recommendation
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <!-- ================= END RIGHT SIDE ================= -->

</div>

@endsection
