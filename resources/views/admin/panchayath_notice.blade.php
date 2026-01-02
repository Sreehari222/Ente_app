{{-- resources/views/admin/notices/index.blade.php --}}
@extends('layouts.admin')

@php
    // Dummy data for Panchayath Notices
    $notices = collect([
        (object) [
            'id' => 1,
            'title' => 'Water Supply Maintenance Schedule',
            'description' => 'Scheduled maintenance for the village water supply system on December 10, 2025. Residents are advised to store adequate water during this period. For more details, contact the Panchayath office.',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'posted_date' => '04 Dec, 2025',
        ],
        (object) [
            'id' => 2,
            'title' => 'Community Health Camp Announcement',
            'description' => 'Free health check-up camp organized by the Panchayath at the community hall on December 15, 2025. All residents are welcome to attend.',
            'status' => 'Draft',
            'status_badge' => 'bg-warning-subtle text-warning',
            'posted_date' => '02 Dec, 2025',
        ],
        (object) [
            'id' => 3,
            'title' => 'Road Repair Updates',
            'description' => 'Progress report on the ongoing road repair works in Sector 3. Expected completion by end of December. Traffic diversions in place.',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'posted_date' => '01 Dec, 2025',
        ],
        (object) [
            'id' => 4,
            'title' => 'Tax Collection Reminder',
            'description' => 'Reminder for property tax payments due by December 15, 2025. Late payments will attract penalties. Pay online or at the office.',
            'status' => 'Archived',
            'status_badge' => 'bg-secondary-subtle text-secondary',
            'posted_date' => '30 Nov, 2025',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Panchayath Notices</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Information & Notices</a></li>
                        <li class="breadcrumb-item active">Panchayath Notices</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    {{-- Notices Controls --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <input type="text" class="form-control" placeholder="Search notices..." id="noticeSearch">
                    <span class="mdi mdi-magnify position-absolute end-0 top-50 translate-middle-y pe-3 text-muted"></span>
                </div>
                <select class="form-select w-auto" id="statusFilter">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Draft</option>
                    <option>Archived</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addNoticeModal">
                <i class="ri-add-line me-1"></i> Add New Notice
            </button>
            <a href="#" class="btn btn-outline-secondary">
                <i class="ri-download-line me-1"></i> Export
            </a>
        </div>
    </div>

    {{-- Notices List --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="notices-list">
                        @forelse($notices as $notice)
                            <div class="notice-card mb-4 p-4 border rounded-3 shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="fw-semibold mb-0">{{ $notice->title }}</h5>
                                    <div class="text-end">
                                        <span class="badge {{ $notice->status_badge }}">{{ $notice->status }}</span>
                                        <small class="d-block text-muted mt-1">Posted: {{ $notice->posted_date }}</small>
                                    </div>
                                </div>
                                <p class="text-muted mb-3">{{ $notice->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a href="" class="btn btn-sm btn-outline-info">View Full Notice</a>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="" class="btn btn-outline-warning">Edit</a>
                                        <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this notice?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="ri-notification-3-line fs-1 text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">No notices found.</h5>
                                <p class="text-muted">Create your first notice to inform the community.</p>
                            </div>
                        @endforelse
                    </div>
                    {{-- Pagination --}}
                    <nav aria-label="Notices pagination">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Add New Notice Modal --}}
    <div class="modal fade" id="addNoticeModal" tabindex="-1" aria-labelledby="addNoticeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addNoticeModalLabel">Add New Panchayath Notice</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="noticeTitle" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="noticeTitle" name="title" placeholder="Enter notice title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="noticeDescription" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="noticeDescription" name="description" rows="5" placeholder="Enter detailed notice description">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="noticeDate" class="form-label">Post Date</label>
                                <input type="date" class="form-control @error('post_date') is-invalid @enderror" id="noticeDate" name="post_date" value="{{ old('post_date') }}" required>
                                @error('post_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="noticeStatus" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="noticeStatus" name="status" required>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="noticeAttachment" class="form-label">Attachment (Optional)</label>
                            <input type="file" class="form-control @error('attachment') is-invalid @enderror" id="noticeAttachment" name="attachment" accept="image/*,.pdf">
                            @error('attachment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" form="addNoticeForm" class="btn btn-primary">Publish Notice</button>
                </div>
            </div>
        </div>
    </div>
@endsection