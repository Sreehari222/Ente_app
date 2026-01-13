@extends('layouts.admin')

@section('title', 'Company Messages')

@section('content')
<div class="container-fluid">

    {{-- Success Alert --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Message Form --}}
    <div class="card mb-4">
        <div class="card-header">
            <h5>Add Company Message</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.company.messages.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control">
                </div>

                <div class="mb-3">
                    <label class="form-label">Message <span class="text-danger">*</span></label>
                    <textarea name="message" rows="4" class="form-control" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">
                    Save Message
                </button>
            </form>
        </div>
    </div>

    {{-- Message List --}}
    <div class="card">
        <div class="card-header">
            <h5>Company Messages</h5>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $message->title }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>{{ Str::limit($message->message, 50) }}</td>
                            <td>
                                <form action="{{ route('admin.company.messages.destroy', $message->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Delete this message?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No messages found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
