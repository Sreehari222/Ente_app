@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit User: {{ $user->name }}</h4>
        <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-sm">← Back to Users</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="card mb-3">
            <div class="card-header"><h5>Basic Information</h5></div>
            <div class="card-body row g-3">
                <div class="col-md-3">
                    <label class="form-label">User ID</label>
                    <input type="text" class="form-control" value="{{ $user->id }}" disabled>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Email Verified At</label>
                    <input type="datetime-local" name="email_verified_at" class="form-control"
                           value="{{ old('email_verified_at', $user->email_verified_at ? $user->email_verified_at->format('Y-m-d\TH:i') : '') }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Role</label>
                    <select name="role" class="form-control">
                        <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>User</option>
                        <option value="salesman" {{ $user->role === 'salesman' ? 'selected' : '' }}>Salesman</option>
                        <option value="deo" {{ $user->role === 'deo' ? 'selected' : '' }}>DEO</option>
                        <option value="area_operator" {{ $user->role === 'area_operator' ? 'selected' : '' }}>Area Operator</option>
                        <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Area Operator</label>
                    <select name="area_operator_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($areaOperators as $ao)
                            <option value="{{ $ao->id }}" {{ $user->area_operator_id == $ao->id ? 'selected' : '' }}>
                                {{ $ao->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">DEO</label>
                    <select name="deo_id" class="form-control">
                        <option value="">— None —</option>
                        @foreach($deos as $deo)
                            <option value="{{ $deo->id }}" {{ $user->deo_id == $deo->id ? 'selected' : '' }}>
                                {{ $deo->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Created At</label>
                    <input type="text" class="form-control" value="{{ $user->created_at }}" disabled>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Updated At</label>
                    <input type="text" class="form-control" value="{{ $user->updated_at }}" disabled>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Update User</button>
    </form>
</div>
@endsection
