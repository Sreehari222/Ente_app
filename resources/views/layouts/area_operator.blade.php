<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Area OPerator Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Staff Management Dashboard" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('../images/favicon.ico') }}">
    <link href="{{ asset('../libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('../js/layout.js') }}"></script>
    <link href="{{ asset('../css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('../css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('../css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('../css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    @yield('styles')
</head>

<body>
    <div id="layout-wrapper">
        {{-- Header --}}
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        {{-- LOGO --}}
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="{{ route('salesman.dashboard') }}" class="logo logo">
                                <span class="logo-sm">
                                    <img src="{{ asset('../images/logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('../images/logo.png') }}" alt="" height="17">
                                </span>
                            </a>
                            <a href="{{ route('salesman.dashboard') }}" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="{{ asset('../images/logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('../images/logo.png') }}" alt="" height="17">
                                </span>
                            </a>
                        </div>
                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger material-shadow-none"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>
                        {{-- App Search --}}
                        <form class="app-search d-none d-md-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                                    id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center">
                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar material-shadow-none btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn material-shadow-none" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ Auth::user()->profile_photo
                                            ? asset('storage/' . Auth::user()->profile_photo)
                                            : asset('../images/users/avatar-1.jpg') }}"
                                        alt="Header Avatar">

                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">
                                            {{ Auth::user()->name }}
                                        </span>

                                        <span class="d-none d-xl-block ms-1 fs-12 user-name-sub-text">

                                        </span>

                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Welcome {{ Auth::user()->name }}</h6>
                                <a class="dropdown-item" href="{{ route('area.profile.index') }}"><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="{{ route(auth()->user()->role . '.messages.index') }}"><i
                                        class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Messages</span></a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i>
                                        <span class="align-middle" data-key="t-logout">Logout</span>
                                    </button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        {{-- ========== App Menu ========== --}}
        <div class="app-menu navbar-menu">
            {{-- LOGO --}}
            <div class="navbar-brand-box">
                <a href="{{ route('salesman.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('../images/logo.png') }}" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('../images/logo.png') }}" alt="" height="35">
                    </span>
                </a>
                <a href="{{ route('salesman.dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('../images/logo.png') }}" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('../images/logo.png') }}" alt="" height="35">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>
            <div id="scrollbar">
                <div class="container-fluid">
                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">

                        {{-- PANEL TITLE --}}
                        <li class="menu-title">
                            <span>Area Operator Panel</span>
                        </li>

                        {{-- ================= OVERVIEW ================= --}}
                        <li class="menu-title">
                            <span>Overview</span>
                        </li>

                        {{-- Dashboard --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.dashboard') ? 'active' : '' }}"
                                href="{{ route('area.dashboard') }}">
                                <i class="ri-dashboard-2-line"></i>
                                Dashboard
                            </a>
                        </li>

                        {{-- ================= USER MANAGEMENT ================= --}}
                        <li class="menu-title">
                            <span>User Management</span>
                        </li>

                        {{-- DEOs --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.deo.*') ? 'active' : '' }}"
                                href="{{ route('area.deo.index') }}">
                                <i class="ri-team-line"></i>
                                DEOs
                            </a>
                        </li>

                        {{-- Salesmen --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.salesmen.*') ? 'active' : '' }}"
                                href="{{ route('area.salesmen.index') }}">
                                <i class="ri-user-3-line"></i>
                                Salesmen
                            </a>
                        </li>

                        {{-- Vendors --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.vendors.*') ? 'active' : '' }}"
                                href="{{ route('area.vendors.index') }}">
                                <i class="ri-store-2-line"></i>
                                Vendors
                            </a>
                        </li>

                        {{-- ================= COMMUNICATION ================= --}}
                        <li class="menu-title">
                            <span>Communication</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link
                            {{ request()->routeIs('salesman.company.messages.index') ? 'active' : '' }}
                            {{ request()->routeIs('deo.company.messages.index') ? 'active' : '' }}
                            {{ request()->routeIs('area_operator.company.messages.index') ? 'active' : '' }}
                                "
                                href="{{ route(auth()->user()->role . '.company.messages.index') }}">
                                <i class="ri-message-3-line"></i>
                                <span>Company Messages</span>
                            </a>
                        </li>

                        {{-- Messages --}}
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs(auth()->user()->role . '.messages.*') ? 'active' : '' }}"
                                href="{{ route(auth()->user()->role . '.messages.index') }}">
                                <i class="ri-message-3-line"></i>
                                <span>Messages</span>
                            </a>
                        </li>


                        {{-- Submissions --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link
                            {{ request()->routeIs('salesman.submissions.*', 'deo.submissions.*', 'area.submissions.*') ? 'active' : '' }}"
                                href="
                                @if (auth()->user()->role === 'salesman') {{ route('salesman.submissions.index') }}
                                @elseif(auth()->user()->role === 'deo')
                                {{ route('deo.submissions.index') }}
                                @else
                                {{ route('area.submissions.index') }} @endif
                                ">
                                <i class="ri-file-list-3-line"></i>
                                <span>Submissions</span>
                            </a>
                        </li>

                        {{-- ================= OPERATIONS ================= --}}
                        <li class="menu-title">
                            <span>Operations</span>
                        </li>

                        {{-- Reports --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.reports.*') ? 'active' : '' }}"
                                href="{{ route('area.reports.index') }}">
                                <i class="ri-bar-chart-line"></i>
                                Reports
                            </a>
                        </li>

                        {{-- Attendance
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.attendance.*') ? 'active' : '' }}"
                                href="{{ route('area.attendance.index') }}">
                                <i class="ri-calendar-check-line"></i>
                                Attendance
                            </a>
                        </li> --}}

                        {{-- Tasks --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('tasks.index*') ? 'active' : '' }}"
                                href="{{ route('tasks.index') }}">
                                <i class="ri-todo-line"></i>
                                Tasks
                            </a>
                        </li>

                        {{-- ================= SYSTEM ================= --}}
                        <li class="menu-title">
                            <span>System</span>
                        </li>

                        {{-- Notifications --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.notifications.*') ? 'active' : '' }}"
                                href="{{ route('area.notifications.index') }}">
                                <i class="ri-notification-line"></i>
                                Notifications
                            </a>
                        </li>

                        {{-- Profile --}}
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('area.profile.index') ? 'active' : '' }}"
                                href="{{ route('area.profile.index') }}">
                                <i class="ri-user-settings-line"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link menu-link logout-btn">
                                    <i class="ri-logout-box-r-line"></i>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>

                    </ul>





                </div>
            </div>
            <div class="sidebar-background"></div>
        </div>
        {{-- Left Sidebar End --}}
        <div class="vertical-overlay"></div>
        {{-- Main Content --}}
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © salesman Panel.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    {{-- JAVASCRIPT --}}
    <script src="{{ asset('../libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('../libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('../libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('../libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('../js/plugins.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Counter Up --}}
    <script>
        // Counter animation
        document.addEventListener('DOMContentLoaded', function() {
            const counters = document.querySelectorAll('.counter-value');
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target').replace(/,/g, ''));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;
                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        counter.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        counter.textContent = target.toLocaleString();
                    }
                };
                updateCounter();
            });
        });
    </script>
    <script src="{{ asset('../js/app.js') }}"></script>
    @yield('scripts')
    @stack('scripts')
</body>

</html>
