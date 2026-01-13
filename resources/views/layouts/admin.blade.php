<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>Admin Panel</title>
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
                            <a href="{{ route('admin.dashboard') }}" class="logo logo">
                                <span class="logo-sm">
                                    <img src="{{ asset('../images/logo.png') }}" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="{{ asset('../images/logo.png') }}" alt="" height="17">
                                </span>
                            </a>
                            <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
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
                        @php
                            $user = auth()->user();
                        @endphp

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn material-shadow-none" data-bs-toggle="dropdown">

                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user"
                                        src="{{ $user->photo ? asset('storage/' . $user->photo) : asset('images/users/avatar-1.jpg') }}"
                                        alt="{{ $user->name }}">

                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium">
                                            {{ $user->name }}
                                        </span>
                                        <span class="d-none d-xl-block ms-1 fs-12 text-muted">
                                            {{ ucfirst(str_replace('_', ' ', $user->role)) }}
                                        </span>
                                    </span>
                                </span>
                            </button>

                            <div class="dropdown-menu dropdown-menu-end">
                                <h6 class="dropdown-header">Welcome {{ $user->name }}!</h6>

                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-account-circle me-1"></i> Profile
                                </a>

                                <a class="dropdown-item d-flex justify-content-between align-items-center"
                                    href="{{ route('admin.messages.index') }}">
                                    <span>
                                        <i class="mdi mdi-message-text-outline me-1"></i> Messages
                                    </span>

                                    @if (auth()->user()->unreadNotifications->count())
                                        <span class="badge bg-danger rounded-pill">
                                            {{ auth()->user()->unreadNotifications->count() }}
                                        </span>
                                    @endif
                                </a>


                                <div class="dropdown-divider"></div>

                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-cog-outline me-1"></i> Settings
                                </a>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="mdi mdi-logout me-1"></i> Logout
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
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('../images/logo.png') }}" alt="" height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('../images/logo.png') }}" alt="" height="35">
                    </span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="logo logo-light">
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
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                                href="{{ route('admin.dashboard') }}">
                                <i class="ri-dashboard-2-line"></i> <span
                                    data-key="t-dashboards">Dashboards</span></a>
                        </li> {{-- end Dashboard Menu --}}

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">User
                                Management</span></li>
                        <li
                            class="nav-item {{ request()->routeIs('admin.verification.index') || request()->routeIs('admin.blocked-users') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.verification.index') || request()->routeIs('admin.blocked-users') ? 'active' : '' }}"
                                href="#sidebarUser" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarUser">
                                <i class="ri-account-circle-line"></i>
                                <span data-key="t-User">Users</span>
                            </a>

                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.verification.index') || request()->routeIs('admin.blocked-users') ? 'show' : '' }}"
                                id="sidebarUser">
                                <ul class="nav nav-sm flex-column">

                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-allusers">
                                            App/Web Users
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ request()->routeIs('admin.verification.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.verification.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.verification.index') ? 'active' : '' }}">
                                            Vendor Verification Requests
                                        </a>
                                    </li>

                                    <li
                                        class="nav-item {{ request()->routeIs('admin.blocked-users') ? 'active' : '' }}">
                                        <a href="{{ route('admin.blocked-users') }}"
                                            class="nav-link {{ request()->routeIs('admin.blocked-users') ? 'active' : '' }}"
                                            data-key="t-blocked-users">
                                            Blocked Users
                                        </a>
                                    </li>


                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.categories.index') ? 'active' : '' }}"
                                href="{{ route('admin.categories.index') }}">
                                <i class="ri-file-chart-line"></i> <span data-key="t-categories">
                                    Categories</span></a>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.plans.create') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.plans.create') ? 'active' : '' }}"
                                href="{{ route('admin.plans.create') }}">
                                <i class="ri-file-chart-line"></i> <span data-key="t-plans"> Plans</span></a>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Staff Management
                                Section</span>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('admin.area-operators') || request()->routeIs('admin.deos') || request()->routeIs('admin.salesmen') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.area-operators') || request()->routeIs('admin.deos') || request()->routeIs('admin.salesmen') ? 'active' : '' }}"
                                href="#sidebarStaff" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarStaff">
                                <i class="ri-team-line"></i>
                                <span data-key="t-list">Staff Management </span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.area-operators') || request()->routeIs('admin.deos') || request()->routeIs('admin.salesmen') ? 'show' : '' }}"
                                id="sidebarStaff">
                                <ul class="nav nav-sm flex-column">
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.area-operators') ? 'active' : '' }}">
                                        <a href="{{ route('admin.area-operators') }}"
                                            class="nav-link {{ request()->routeIs('admin.area-operators') ? 'active' : '' }}"
                                            data-key="t-providers">
                                            Area Operators
                                        </a>
                                    </li>

                                    <li class="nav-item {{ request()->routeIs('admin.deos') ? 'active' : '' }}">
                                        <a href="{{ route('admin.deos') }}"
                                            class="nav-link {{ request()->routeIs('admin.deos') ? 'active' : '' }}"
                                            data-key="t-shop-owners">
                                            Digital Entry Operators(DEO)
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('admin.salesmen') ? 'active' : '' }}">
                                        <a href="{{ route('admin.salesmen') }}"
                                            class="nav-link {{ request()->routeIs('admin.salesmen') ? 'active' : '' }}"
                                            data-key="t-shop-owners">
                                            Sales Man
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Pages</span>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('admin.all-ads') || request()->routeIs('admin.create-ads') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.all-ads') || request()->routeIs('admin.create-ads') ? 'active' : '' }}"
                                href="#sidebarAdvertisement" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarAdvertisement">
                                <i class="ri-megaphone-line"></i>
                                <span data-key="t-list">Advertisements </span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.all-ads') || request()->routeIs('admin.create-ads') ? 'show' : '' }}"
                                id="sidebarAdvertisement">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item {{ request()->routeIs('admin.all-ads') ? 'active' : '' }}">
                                        <a href="{{ route('admin.all-ads') }}"
                                            class="nav-link {{ request()->routeIs('admin.all-ads') ? 'active' : '' }}"
                                            data-key="t-all-ads">
                                            All Advertisements
                                        </a>
                                    </li>
                                    <li class="nav-item {{ request()->routeIs('admin.create-ads') ? 'active' : '' }}">
                                        <a href="{{ route('admin.create-ads') }}"
                                            class="nav-link {{ request()->routeIs('admin.create-ads') ? 'active' : '' }}"
                                            data-key="t-create-ad">
                                            Create New Ad </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-pending-ad">
                                            Pending Ads </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li
                            class="nav-item {{ request()->routeIs('admin.all-offers') || request()->routeIs('admin.create-offer') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.all-offers') || request()->routeIs('admin.create-offer') ? 'active' : '' }}"
                                href="#sidebarOffer" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarOffer">
                                <i class="ri-coupon-3-line"></i>
                                <span data-key="t-list">Offers & Promotions </span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.all-offers') || request()->routeIs('admin.create-offer') ? 'show' : '' }}"
                                id="sidebarOffer">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item {{ request()->routeIs('admin.all-offers') ? 'active' : '' }}">
                                        <a href="{{ route('admin.all-offers') }}"
                                            class="nav-link {{ request()->routeIs('admin.all-offers') ? 'active' : '' }}"
                                            data-key="t-all-offers">
                                            All Offers
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.create-offer') ? 'active' : '' }}">
                                        <a href="{{ route('admin.create-offer') }}"
                                            class="nav-link {{ request()->routeIs('admin.create-offer') ? 'active' : '' }}"
                                            data-key="t-create-offer">
                                            Create Offer </a>
                                    </li>
                                    <!-- <li class="nav-item">
                                        <a href="{{ route('admin.scheduled-offers') }}" class="nav-link" data-key="t-scheduled-offers">
                                            Scheduled Offers </a>
                                    </li> -->
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.daily-challenges') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.daily-challenges') ? 'active' : '' }}"
                                href="#sidebarReward" data-bs-toggle="collapse" role="button" aria-expanded="false"
                                aria-controls="sidebarReward">
                                <i class="ri-trophy-line"></i>
                                <span data-key="t-list">Rewards System </span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.daily-challenges') ? 'show' : '' }}"
                                id="sidebarReward">
                                <ul class="nav nav-sm flex-column">
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.daily-challenges') ? 'active' : '' }}">
                                        <a href="{{ route('admin.daily-challenges') }}"
                                            class="nav-link {{ request()->routeIs('admin.daily-challenges') ? 'active' : '' }}"
                                            data-key="t-challenges">
                                            Daily Challenges
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-spin">
                                            Spin & Win Setup </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-scratch-cards">
                                            Scratch Cards </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-reward-rules">
                                            Reward Rules </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarGift" data-bs-toggle="collapse"
                                role="button" aria-expanded="false" aria-controls="sidebarGift">
                                <i class="ri-gift-line"></i>
                                <span data-key="t-list"> Gift Cards & Wallet </span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarGift">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-gift-card-management">
                                            Gift Card Management
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-wallet-transactions">
                                            Wallet Transactions </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="" class="nav-link" data-key="t-redemption">
                                            Redemption Requests </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Information
                                Section</span></li>
                        <li
                            class="nav-item {{ request()->routeIs('admin.notices.index') || request()->routeIs('admin.emergency-contacts.index') || request()->routeIs('admin.announcements.index') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.notices.index') || request()->routeIs('admin.emergency-contacts.index') || request()->routeIs('admin.announcements.index') ? 'active' : '' }}"
                                href="#sidebarInfo" data-bs-toggle="collapse" role="button"
                                aria-expanded="{{ request()->routeIs('admin.notices.index') || request()->routeIs('admin.contacts.index') || request()->routeIs('admin.announcements.index') ? 'true' : 'false' }}"
                                aria-controls="sidebarInfo">
                                <i class="ri-information-line"></i>
                                <span data-key="t-list">Information & Notices </span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.notices.index') || request()->routeIs('admin.contacts.index') || request()->routeIs('admin.announcements.index') ? 'show' : '' }}"
                                id="sidebarInfo">
                                <ul class="nav nav-sm flex-column">
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.notices.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.notices.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.notices.index') ? 'active' : '' }}"
                                            data-key="t-notices">
                                            Panchayath Notices
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.contacts.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}"
                                            data-key="t-contacts">
                                            Emergency Contacts
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.announcements.index') ? 'active' : '' }}">
                                        <a href="{{ route('admin.announcements.index') }}"
                                            class="nav-link {{ request()->routeIs('admin.announcements.index') ? 'active' : '' }}"
                                            data-key="t-announcements">
                                            Local Announcements
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.reports*') ? 'active' : '' }}"
                                href="{{ route('admin.reports.index') }}">
                                <i class="ri-file-chart-line"></i>
                                <span data-key="t-report">Reports</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs(auth()->user()->role . '.messages.*') ? 'active' : '' }}"
                                href="{{ route(auth()->user()->role . '.messages.index') }}">
                                <i class="ri-message-3-line"></i>
                                <span>Messages</span>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->routeIs('admin.company.messages.index') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.company.messages.index') ? 'active' : '' }}"
                                href="{{ route('admin.company.messages.index') }}">
                                <i class="ri-building-line"></i>
                                <span data-key="t-company-messages">Company Messages</span>
                            </a>
                        </li>

                        <li class="menu-title"><i class="ri-more-fill"></i> <span data-key="t-pages">Profile &
                                Settings</span></li>
                        <li
                            class="nav-item {{ request()->routeIs('admin.settings.general') || request()->routeIs('admin.settings.app') || request()->routeIs('admin.settings.notifications') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.settings.general') || request()->routeIs('admin.settings.app') || request()->routeIs('admin.settings.notifications') ? 'active' : '' }}"
                                href="#sidebarProfile" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarProfile">
                                <i class="ri-settings-3-line"></i>
                                <span data-key="t-list">Settings</span>
                            </a>
                            <div class="collapse menu-dropdown {{ request()->routeIs('admin.settings.general') || request()->routeIs('admin.settings.app') || request()->routeIs('admin.settings.notifications') ? 'show' : '' }}"
                                id="sidebarProfile">
                                <ul class="nav nav-sm flex-column">
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                                        <a href="{{ route('admin.settings.general') }}"
                                            class="nav-link {{ request()->routeIs('admin.settings.general') ? 'active' : '' }}">
                                            General Settings
                                        </a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.settings.app') ? 'active' : '' }}">
                                        <a href="{{ route('admin.settings.app') }}"
                                            class="nav-link {{ request()->routeIs('admin.settings.app') ? 'active' : '' }}"
                                            data-key="t-emergency-contacts">
                                            App Configuration </a>
                                    </li>
                                    <li
                                        class="nav-item {{ request()->routeIs('admin.settings.notifications') ? 'active' : '' }}">
                                        <a href="{{ route('admin.settings.notifications') }}"
                                            class="nav-link {{ request()->routeIs('admin.settings.notifications') ? 'active' : '' }}"
                                            data-key="t-announcements">
                                            Notification Settings</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
                            <a class="nav-link menu-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}"
                                href="{{ route('admin.profile.show') }}">
                                <i class="ri-file-chart-line"></i>
                                <span data-key="t-profile">Profile</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="nav-link menu-link btn btn-link">
                                    <i class="ri-file-chart-line"></i>
                                    <span data-key="t-logout">Logout</span>
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
                            </script> © Admin Panel.
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
</body>

</html>
