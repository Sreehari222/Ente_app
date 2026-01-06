<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark"
    data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable"
    data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>DEO Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Staff Management Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />

    <link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.min.css') }}" rel="stylesheet">
</head>

<body>

<div class="auth-page-wrapper pt-5">

    <!-- Background -->
    <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
        <div class="bg-overlay"></div>
        <div class="shape">
            <svg viewBox="0 0 1440 120">
                <path d="M0,36 C144,53.6 432,123.2 720,124
                         C1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
            </svg>
        </div>
    </div>

    <!-- Page Content -->
    <div class="auth-page-content">
        <div class="container">

            <!-- Header -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                        <a href="#" class="d-inline-block auth-logo">
                            <img src="{{ asset('images/logo-light.png') }}" height="20">
                        </a>
                        <p class="mt-3 fs-15 fw-medium">Data Entry Operator Registration</p>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">
                            <div class="text-center mt-2">
                                <h5 class="text-primary">Create DEO Account</h5>
                                <p class="text-muted">Register a new Data Entry Operator</p>
                            </div>

                            <div class="p-2 mt-4">
                                <form action="{{ route('admin.deos.store') }}" method="POST">
                                    @csrf

                                    <!-- Name -->
                                    <div class="mb-3">
                                        <label class="form-label">Full Name *</label>
                                        <input type="text" class="form-control"
                                            name="name" value="{{ old('name') }}" required>
                                        @error('name') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control"
                                            name="email" value="{{ old('email') }}" required>
                                        @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <!-- Area Operator -->
                                    <div class="mb-3">
                                        <label class="form-label">Assign Area Operator *</label>
                                        <select class="form-select" name="area_operator_id" required>
                                            <option value="">Select Area Operator</option>
                                            @foreach($areaOperators as $ao)
                                                <option value="{{ $ao->id }}"
                                                    {{ old('area_operator_id') == $ao->id ? 'selected' : '' }}>
                                                    {{ $ao->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area_operator_id') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Password *</label>
                                        <input type="password" class="form-control" name="password" required>
                                        @error('password') <small class="text-danger">{{ $message }}</small> @enderror
                                    </div>

                                    <!-- Confirm Password -->
                                    <div class="mb-3">
                                        <label class="form-label">Confirm Password *</label>
                                        <input type="password" class="form-control"
                                            name="password_confirmation" required>
                                    </div>

                                    <button type="submit" class="btn btn-success w-100">
                                        Register DEO
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>

                    <!-- Login -->
                    <div class="mt-4 text-center">
                        <p class="mb-0">
                            Already have an account?
                            <a href="{{route('login')}}"
                               class="fw-semibold text-primary text-decoration-underline">
                                Sign In
                            </a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="text-center">
                <p class="mb-0 text-muted">
                    © <script>document.write(new Date().getFullYear())</script>
                </p>
            </div>
        </div>
    </footer>

</div>

<!-- JS -->
<script src="{{ asset('libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('libs/particles.js/particles.js') }}"></script>
<script src="{{ asset('js/pages/particles.app.js') }}"></script>

</body>
</html>
