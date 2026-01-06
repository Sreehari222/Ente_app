<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>DEO Panel</title>
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
                                        src="{{ Auth::user()->profile_image
                                            ? asset('storage/' . Auth::user()->profile_image)
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
                                <a class="dropdown-item" href=""><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href=""><i
                                        class="mdi mdi-message-text-outline text-muted fs-16 align-middle me-1"></i>
                                    <span class="align-middle">Messages</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href=""><i
                                        class="mdi mdi-cog-outline text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Settings</span></a>
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

                        {{-- MAIN --}}
                        <li class="menu-title"><span>Menu</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.dashboard') ? 'active' : '' }}"
                                href="{{ route('deo.dashboard') }}">
                                <i class="ri-dashboard-2-line"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        {{-- SALESMAN MANAGEMENT --}}
                        <li class="menu-title"><span>Salesman Management</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.salesmen.index') ? 'active' : '' }}"
                                href="{{ route('salesmen.index') }}">
                                <i class="ri-team-line"></i>
                                <span>My Salesmen</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.salesmen.performance') ? 'active' : '' }}"
                                href="{{ route('deo.salesmen.performance') }}">
                                <i class="ri-bar-chart-box-line"></i>
                                <span>Salesman Performance</span>
                            </a>
                        </li>

                        {{-- VENDOR MONITORING --}}
                        <li class="menu-title"><span>Vendor Monitoring</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.vendors.index') ? 'active' : '' }}"
                                href="">
                                <i class="ri-store-2-line"></i>
                                <span>All Vendors</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.vendors.pending') ? 'active' : '' }}"
                                href="">
                                <i class="ri-time-line"></i>
                                <span>Pending Vendors</span>
                            </a>
                        </li>

                        {{-- REPORTS --}}
                        <li class="menu-title"><span>Reports & Submissions</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.reports.daily') ? 'active' : '' }}"
                                href="">
                                <i class="ri-file-list-3-line"></i>
                                <span>Daily Reports</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.reports.monthly') ? 'active' : '' }}"
                                href="">
                                <i class="ri-calendar-check-line"></i>
                                <span>Monthly Reports</span>
                            </a>
                        </li>

                        {{-- COMMUNICATION --}}
                        <li class="menu-title"><span>Communication</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.messages') ? 'active' : '' }}"
                                href="">
                                <i class="ri-message-3-line"></i>
                                <span>Admin Messages</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.notifications') ? 'active' : '' }}"
                                href="">
                                <i class="ri-notification-3-line"></i>
                                <span>Notifications</span>
                            </a>
                        </li>

                        {{-- ACCOUNT --}}
                        <li class="menu-title"><span>Account</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('deo.profile') ? 'active' : '' }}"
                                href="">
                                <i class="ri-user-settings-line"></i>
                                <span>My Profile</span>
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
