@extends('layouts.deo')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-3">Send Message</h4>

        <form action="{{ route('deo.messages.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Message</label>
                <textarea name="message" class="form-control" rows="5" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Select Vendors / Salesmen</label>
                <select name="users[]" class="form-control" multiple required>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ ucfirst($user->role) }})
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="ri-send-plane-line"></i> Send Message
            </button>
        </form>
    </div>
@endsection
