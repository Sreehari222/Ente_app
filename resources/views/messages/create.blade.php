@extends('layouts.sales')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Send Message</h4>
        <a href="{{ route('salesman.messages.index') }}" class="btn btn-secondary mb-3">
            <i class="ri-arrow-left-line"></i> Back
        </a>

        <form action="{{ route('admin.messages.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Users</label>
                <select name="users[]" class="form-control" multiple required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ $user->role }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button class="btn btn-success">
                <i class="ri-send-plane-line"></i> Send Message
            </button>
        </form>
    </div>
@endsection
