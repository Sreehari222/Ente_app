@extends('layouts.admin')

@php
    // Dummy data for Local Announcements
    $announcements = collect([
        (object) [
            'id' => 1,
            'title' => 'Weekly Market Day Reminder',
            'message' => 'Don\'t forget the weekly market on Sunday at the village square. Fresh produce and local goods available from 7 AM to 2 PM. Vendors are encouraged to set up early. For any queries, contact the market committee at the Panchayath office.',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'publish_date' => '05 Dec, 2025',
            'reach' => '1,245 views',
        ],
        (object) [
            'id' => 2,
            'title' => 'Community Clean-Up Drive',
            'message' => 'Join us for the monthly clean-up drive on December 10, 2025, starting at 8 AM from the community hall. Gloves and bags will be provided. All residents are welcome to participate in keeping our locality clean and green. Volunteers will receive certificates of appreciation.',
            'status' => 'Scheduled',
            'status_badge' => 'bg-info-subtle text-info',
            'publish_date' => '10 Dec, 2025',
            'reach' => '892 views',
        ],
        (object) [
            'id' => 3,
            'title' => 'Electricity Bill Payment Alert',
            'message' => 'Reminder: Electricity bills for November are due by December 15, 2025. Pay at the local office or online via the Panchayath portal to avoid late fees of 2% per month. For payment assistance, visit the office during business hours.',
            'status' => 'Pending Review',
            'status_badge' => 'bg-warning-subtle text-warning',
            'publish_date' => '05 Dec, 2025',
            'reach' => '567 views',
        ],
        (object) [
            'id' => 4,
            'title' => 'Youth Sports Tournament Update',
            'message' => 'Exciting updates on the upcoming youth sports tournament on December 20, 2025. Registrations are closing soon—last date is December 10. Contact the sports committee at the community center for forms and details. Prizes for winners in cricket, football, and badminton categories.',
            'status' => 'Active',
            'status_badge' => 'bg-success-subtle text-success',
            'publish_date' => '01 Dec, 2025',
            'reach' => '2,134 views',
        ],
    ]);
@endphp

@section('content')
    {{-- Page Title --}}
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Local Announcements</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="">Information & Notices</a></li>
                        <li class="breadcrumb-item active">Local Announcements</li>
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

    {{-- Controls --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="d-flex align-items-center">
                <div class="position-relative me-3">
                    <input type="text" class="form-control" placeholder="Search announcements..." id="announcementSearch">
                    <span class="mdi mdi-magnify position-absolute end-0 top-50 translate-middle-y pe-3 text-muted"></span>
                </div>
                <select class="form-select w-auto" id="statusFilter">
                    <option>All Status</option>
                    <option>Active</option>
                    <option>Pending</option>
                    <option>Scheduled</option>
                    <option>Archived</option>
                </select>
            </div>
        </div>
        <div class="col-md-6 text-md-end">
            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#addAnnouncementModal">
                <i class="ri-add-line me-1"></i> New Announcement
            </button>
            <a href="#" class="btn btn-outline-secondary">
                <i class="ri-download-line me-1"></i> Export
            </a>
        </div>
    </div>

    {{-- Announcements List --}}
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1">General Public Updates and Messages</h4>
                    <div class="flex-shrink-0">
                        <a href="" class="btn btn-soft-primary btn-sm material-shadow-none">
                            <i class="ri-file-list-3-line align-middle"></i> View All
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="announcements-list">
                        @forelse($announcements as $announcement)
                            <div class="announcement-card mb-4 p-4 border rounded-3 shadow-sm">
                                <div class="d-flex justify-content-between align-items-start mb-3">
                                    <h5 class="fw-semibold mb-0">{{ $announcement->title }}</h5>
                                    <div class="text-end">
                                        <span class="badge {{ $announcement->status_badge }}">{{ $announcement->status }}</span>
                                        <small class="d-block text-muted mt-1">{{ $announcement->status == 'Scheduled' ? 'Scheduled: ' : 'Published: ' }}{{ $announcement->publish_date }}</small>
                                    </div>
                                </div>
                                <p class="text-muted mb-3">{{ $announcement->message }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-info">{{ $announcement->reach }}</small>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="" class="btn btn-outline-info">View</a>
                                        <a href="" class="btn btn-outline-warning">Edit</a>
                                        <form action="" method="POST" style="display: inline;" onsubmit="return confirm('Delete this announcement?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="text-center py-5">
                                <i class="ri-volume-up-line fs-1 text-muted mb-3 d-block"></i>
                                <h5 class="text-muted">No announcements found.</h5>
                                <p class="text-muted">Create your first announcement to update the community.</p>
                            </div>
                        @endforelse
                    </div>
                    {{-- Pagination --}}
                    <nav aria-label="Announcements pagination">
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

    {{-- Add New Announcement Modal --}}
    <div class="modal fade" id="addAnnouncementModal" tabindex="-1" aria-labelledby="addAnnouncementModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addAnnouncementModalLabel">Create New Local Announcement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="announcementTitle" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="announcementTitle" name="title" placeholder="Enter announcement title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="announcementMessage" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" id="announcementMessage" name="message" rows="5" placeholder="Enter the full message for the general public update">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label for="publishDate" class="form-label">Publish Date</label>
                                <input type="date" class="form-control @error('publish_date') is-invalid @enderror" id="publishDate" name="publish_date" value="{{ old('publish_date') }}" required>
                                @error('publish_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="announcementStatus" class="form-label">Status</label>
                                <select class="form-select @error('status') is-invalid @enderror" id="announcementStatus" name="status" required>
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="scheduled" {{ old('status') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                    <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                                @error('status')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="announcementImage" class="form-label">Image (Optional)</label>
                            <input type="file" class="form-control @error('image') is-invalid @enderror" id="announcementImage" name="image" accept="image/*">
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Publish Announcement</button>
                </div>
            </div>
        </div>
    </div>
@endsection