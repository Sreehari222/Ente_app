@extends('layouts.admin')

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Verification Requests</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Verification Requests</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Verification Requests Table --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Users Awaiting Verification Approval</h5>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0 align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Requested Role</th>
                                    <th>ID Proof</th>
                                    <th>Submitted On</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($requests as $req)
                                    <tr>
                                        {{-- User Name + Avatar --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 me-2">
                                                    <img src="{{ $req->user->avatar ? Storage::url($req->user->avatar) : asset('assets/images/users/avatar-1.jpg') }}"
                                                         alt="{{ $req->user->name }}"
                                                         class="avatar-xs rounded-circle">
                                                </div>
                                                <div class="flex-grow-1">{{ $req->user->name }}</div>
                                            </div>
                                        </td>

                                        {{-- Email --}}
                                        <td>{{ $req->user->email }}</td>

                                        {{-- Role they want (Service Provider / Shop Owner) --}}
                                        <td>{{ ucfirst($req->requested_role) }}</td>

                                        {{-- ID Proof File --}}
                                        <td>
                                            @if($req->document_path)
                                                <a href="{{ Storage::url($req->document_path) }}"
                                                   class="btn btn-sm btn-info"
                                                   target="_blank">
                                                    View Document
                                                </a>
                                            @else
                                                <span class="text-muted">No File</span>
                                            @endif
                                        </td>

                                        {{-- Submission Date --}}
                                        <td>{{ $req->created_at->format('Y-m-d') }}</td>

                                        {{-- Status Badge --}}
                                        <td>
                                            @if ($req->status === 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($req->status === 'approved')
                                                <span class="badge bg-success">Approved</span>
                                            @elseif($req->status === 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>

                                        {{-- Actions --}}
                                        <td>
                                            {{-- Approve --}}
                                            <form action="{{ route('admin.verification.approve', $req->id) }}"
                                                  method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-success me-1"
                                                        onclick="return confirm('Approve this verification request?')">
                                                    Approve
                                                </button>
                                            </form>

                                            {{-- Reject --}}
                                            <form action="{{ route('admin.verification.reject', $req->id) }}"
                                                  method="POST" style="display:inline;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Reject this verification request?')">
                                                    Reject
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No verification requests found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination --}}
                    <div class="d-flex justify-content-end mt-3">
                        {{ $requests->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
