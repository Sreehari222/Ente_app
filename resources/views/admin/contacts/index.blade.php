@extends('layouts.admin')
@section('title','Emergency Contacts')

@section('content')
<div class="container-fluid">
    <h4>Emergency Contacts</h4>
    @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif

    <form action="{{ route('admin.contacts.store') }}" method="POST">
        @csrf
        <div class="mb-3"><label>Name</label><input type="text" name="name" class="form-control" required></div>
        <div class="mb-3"><label>Contact Number</label><input type="text" name="contact_number" class="form-control" required></div>
        <div class="mb-3"><label>Area</label><input type="text" name="area" class="form-control" required></div>
        <div class="mb-3"><label>Description</label><textarea name="description" class="form-control" rows="2"></textarea></div>
        <button class="btn btn-primary mb-3">Add Contact</button>
    </form>

    <table class="table table-bordered">
        <thead><tr><th>Name</th><th>Contact</th><th>Area</th><th>Description</th><th>Action</th></tr></thead>
        <tbody>
            @forelse($contacts as $contact)
            <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->contact_number }}</td>
                <td>{{ $contact->area }}</td>
                <td>{{ $contact->description }}</td>
                <td>
                    <a href="{{ route('admin.contacts.edit',$contact->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('admin.contacts.destroy',$contact->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="5" class="text-center">No contacts found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
