@extends('layouts.admin')
@section('title','Panchayath Notices')

@section('content')
<div class="container-fluid">
    <h4>Panchayath Notices</h4>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <form action="{{ route('admin.notices.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Title</label><input type="text" name="title" class="form-control" required></div>
        <div class="mb-3"><label>Area</label><input type="text" name="area" class="form-control" required></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="2" required></textarea></div>
        <button class="btn btn-primary mb-3">Add Notice</button>
    </form>

    <table class="table table-bordered">
        <thead><tr><th>Title</th><th>Area</th><th>Description</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($notices as $notice)
            <tr>
                <td>{{ $notice->title }}</td>
                <td>{{ $notice->area }}</td>
                <td>{{ $notice->description }}</td>
                <td>
                    <a href="{{ route('admin.notices.edit',$notice->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.notices.destroy',$notice->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No notices found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
