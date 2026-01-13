@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">

        {{-- PAGE HEADER --}}
        <div class="card mb-3">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="mb-1">Edit User</h4>
                    <span class="badge bg-primary">{{ strtoupper($user->role) }}</span>
                </div>

                <a href="{{ route('admin.users') }}" class="btn btn-outline-secondary btn-sm">
                    ← Back to Users
                </a>
            </div>
        </div>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- BASIC INFORMATION --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Basic Information</h5>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">User ID</label>
                            <input type="text" class="form-control" value="{{ $user->id }}" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name"
                                   value="{{ old('name', $user->name) }}"
                                   class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $user->email) }}"
                                   class="form-control" required>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Role</label>
                            <select name="role" class="form-select">
                                @foreach(['admin','area_operator','deo','salesman','user'] as $role)
                                    <option value="{{ $role }}"
                                        {{ $user->role === $role ? 'selected' : '' }}>
                                        {{ ucfirst(str_replace('_',' ', $role)) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Email Verification</label>
                            <select name="email_verified_at" class="form-select">
                                <option value="">Not Verified</option>
                                <option value="{{ now() }}"
                                    {{ $user->email_verified_at ? 'selected' : '' }}>
                                    Verified
                                </option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            {{-- HIERARCHY INFORMATION --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Hierarchy Information</h5>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-6">
                            <label class="form-label">Area Operator</label>
                            <select name="area_operator_id" class="form-select">
                                <option value="">— None —</option>
                                @foreach($areaOperators as $ao)
                                    <option value="{{ $ao->id }}"
                                        {{ $user->area_operator_id == $ao->id ? 'selected' : '' }}>
                                        {{ $ao->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">DEO</label>
                            <select name="deo_id" class="form-select">
                                <option value="">— None —</option>
                                @foreach($deos as $deo)
                                    <option value="{{ $deo->id }}"
                                        {{ $user->deo_id == $deo->id ? 'selected' : '' }}>
                                        {{ $deo->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            {{-- META INFORMATION --}}
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="mb-0">Meta Information</h5>
                </div>

                <div class="card-body">
                    <div class="row g-3">

                        <div class="col-md-4">
                            <label class="form-label">Created At</label>
                            <input type="text" class="form-control"
                                   value="{{ $user->created_at }}" disabled>
                        </div>

                        <div class="col-md-4">
                            <label class="form-label">Updated At</label>
                            <input type="text" class="form-control"
                                   value="{{ $user->updated_at }}" disabled>
                        </div>

                    </div>
                </div>
            </div>

            {{-- ACTIONS --}}
            <div class="card">
                <div class="card-body text-end">
                    <button type="submit" class="btn btn-primary">
                        Update User
                    </button>
                </div>
            </div>

        </form>
    </div>
</div>
@endsection
