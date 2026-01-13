@extends('layouts.admin')
@section('title','Local Announcements')

@section('content')
<div class="container-fluid">
    <h4>Local Announcements</h4>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <form action="{{ route('admin.announcements.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
        <div class="mb-3"><label>Area</label><input type="text" name="area" class="form-control" required></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="2" required></textarea></div>
        <button class="btn btn-primary mb-3">Add Announcement</button>
    </form>

    <table class="table table-bordered">
        <thead><tr><th>Title</th><th>Area</th><th>Description</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($announcements as $announcement)
            <tr>
                <td>{{ $announcement->title }}</td>
                <td>{{ $announcement->area }}</td>
                <td>{{ $announcement->description }}</td>
                <td>
                    <a href="{{ route('admin.announcements.edit',$announcement->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.announcements.destroy',$announcement->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No announcements found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
