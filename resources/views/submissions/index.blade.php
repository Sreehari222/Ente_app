@extends(auth()->user()->role === 'salesman' ? 'layouts.salesman' : (auth()->user()->role === 'deo' ? 'layouts.deo' : 'layouts.area_operator'))

@section('title', 'Submissions')

@section('content')
    <div class="container-fluid">

        {{-- Upload --}}
        <div class="card mb-3">
            <div class="card-header fw-bold">Upload Submission</div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <form method="POST"
                    action="
                {{ route(auth()->user()->role . '.submissions.store') }}"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <input type="text" name="title" class="form-control" placeholder="Title" required>
                    </div>

                    <div class="mb-3">
                        <input type="file" name="file" class="form-control" required>
                    </div>

                    <button class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

        {{-- Cards --}}
        <div class="row g-3">
            @forelse($submissions as $submission)
                <div class="col-md-4 col-lg-3">
                    <div class="card shadow-sm">

                        {{-- Preview --}}
                        <div class="bg-light d-flex align-items-center justify-content-center"
                            style="height:130px; overflow:hidden;">

                            @if (Str::endsWith($submission->file_path, ['jpg', 'jpeg', 'png']))
                                <img src="{{ asset('storage/' . $submission->file_path) }}" class="img-fluid">
                            @else
                                <i class="ri-file-pdf-line text-danger fs-1"></i>
                            @endif
                        </div>

                        {{-- Body --}}
                        <div class="card-body p-2">
                            <div class="fw-semibold text-truncate">
                                {{ $submission->title }}
                            </div>
                            <small class="text-muted">
                                {{ $submission->created_at->format('d M Y') }}
                            </small>
                        </div>

                        {{-- Footer --}}
                        <div class="card-footer p-2 text-end bg-white border-0">
                            @if (Str::endsWith($submission->file_path, ['jpg', 'jpeg', 'png']))
                                <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#viewModal{{ $submission->id }}">
                                    View
                                </button>
                            @else
                                <a href="{{ asset('storage/' . $submission->file_path) }}" target="_blank"
                                    class="btn btn-sm btn-primary">
                                    View
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Image Modal --}}
                @if (Str::endsWith($submission->file_path, ['jpg', 'jpeg', 'png']))
                    <div class="modal fade" id="viewModal{{ $submission->id }}" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title">{{ $submission->title }}</h6>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <img src="{{ asset('storage/' . $submission->file_path) }}" class="img-fluid rounded">
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-12 text-center text-muted">
                    No submissions found
                </div>
            @endforelse
        </div>


    </div>
@endsection
