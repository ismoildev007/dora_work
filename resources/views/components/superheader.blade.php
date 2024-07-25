<?php
$notifications = auth()->user()->notifications()->limit(10)->get();

?>



<div class="main-menu">



    <!-- Brand Logo -->
    <div class="logo-box">
        <!-- Brand Logo Light -->
        <a href="index.html" class="logo-light">
            <img src="/admin-panel/assets/images/logo-light.png" alt="logo" class="logo-lg" height="28">
            <img src="/admin-panel/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>

        <!-- Brand Logo Dark -->
        <a href="index.html" class="logo-dark">
            <img src="/admin-panel/assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="28">
            <img src="/admin-panel/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="28">
        </a>
    </div>

    <!--- Menu -->
    <div data-simplebar>
        <ul class="app-menu">

            <li class="menu-title">Menu</li>
            <li class="menu-item">
                <a
                       @if( auth()->user()->role == 'admin')
                           href="{{ route('admin.dashboard') }}"
                       @elseif( auth()->user()->role == 'manager')
                           href="{{ route('manager.dashboard') }}"
                       @elseif (auth()->user()->role == 'staff')
                           href="{{ route('staff.dashboard') }}"
                       @endif
                        class="menu-link waves-effect waves-light">

                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                    <span class="badge bg-primary rounded ms-auto">01</span>
                </a>
            </li>
            @can('view-user')
                <li class="menu-item">
                    <a href="{{ route('users.index') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-user"></i></span>
                        <span class="menu-text"> Users </span>
                    </a>
                </li>
            @endcan
            @can('view-activity')
                <li class="menu-item">
                    <a href="{{ route('activities.index') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bxl-wordpress"></i></span>
                        <span class="menu-text"> Activity </span>
                    </a>
                </li>
            @endcan
            @can('view-client')
                <li class="menu-item">
                    <a href="{{ route('clients.index') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-clipboard"></i></span>
                        <span class="menu-text"> Client </span>
                    </a>
                </li>
            @endcan

            <li class="menu-item">
                <a href="{{ route('messages.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bx bx-message"></i></span>

                    <span class="menu-text">Message</span>
                </a>
            </li>
            @can('view-project')
            <li class="menu-item">
                <a href="{{ route('projects.index') }}" class="menu-link">
                    <span class="menu-icon"><i class="bx bxl-product-hunt"></i></span>

                    <span class="menu-text">Projects</span>
                </a>
            </li>
            @endcan
            @can('view-department')
                <li class="menu-item">
                    <a href="{{ route('departments.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="bx bx-detail"></i></span>

                        <span class="menu-text">Department</span>
                    </a>
                </li>
            @endcan
            @can('view-report')
                <li class="menu-item">
                    <a href="{{ route('reports.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="bx bxs-report"></i></span>

                        <span class="menu-text">Report</span>
                    </a>
                </li>
            @endcan
            @can('view-staff')
                <li class="menu-item">
                    <a href="{{ route('staffs.index') }}" class="menu-link">
                        <span class="menu-icon"><i class="bx bx-star"></i></span>

                        <span class="menu-text">Staff</span>
                    </a>
                </li>
            @endcan
            <form method="post" action="{{ route('logout') }}">
                <i class="fe-log-out"></i>
                <span>
                    @csrf
                    <button class="btn text-danger" style="font-weight: 900">Chiqish</button>
                </span>
            </form>
        </ul>
    </div>
</div>



<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->

<div class="page-content">

    <!-- ========== Topbar Start ========== -->
    <div class="navbar-custom">
        <div class="topbar">
            <div class="topbar-menu d-flex align-items-center gap-lg-2 gap-1">

                <!-- Brand Logo -->
                <div class="logo-box">
                    <!-- Brand Logo Light -->
                    <a href="index.html" class="logo-light">
                        <img src="/admin-panel/assets/images/logo-light.png" alt="logo" class="logo-lg" height="22">
                        <img src="/admin-panel/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                    </a>

                    <!-- Brand Logo Dark -->
                    <a href="index.html" class="logo-dark">
                        <img src="/admin-panel/assets/images/logo-dark.png" alt="dark logo" class="logo-lg" height="22">
                        <img src="/admin-panel/assets/images/logo-sm.png" alt="small logo" class="logo-sm" height="22">
                    </a>
                </div>

                <!-- Sidebar Menu Toggle Button -->
                <button class="button-toggle-menu">
                    <i class="mdi mdi-menu"></i>
                </button>
            </div>

            <ul class="topbar-menu d-flex align-items-center gap-4">

                <li class="d-none d-md-inline-block">
                    <a class="nav-link" href="" data-bs-toggle="fullscreen">
                        <i class="mdi mdi-fullscreen font-size-24"></i>
                    </a>
                </li>

                <li class="dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-magnify font-size-24"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-animated dropdown-menu-end dropdown-lg p-0">
                        <form class="p-3">
                            <input type="search" class="form-control" placeholder="Search ..." aria-label="Recipient's username">
                        </form>
                    </div>
                </li>


                <li class="dropdown d-none d-md-inline-block">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="/admin-panel/assets/images/flags/us.jpg" alt="user-image" class="me-0 me-sm-1" height="18">
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated">

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/admin-panel/assets/images/flags/germany.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">German</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/admin-panel/assets/images/flags/italy.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Italian</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/admin-panel/assets/images/flags/spain.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Spanish</span>
                        </a>

                        <!-- item-->
                        <a href="javascript:void(0);" class="dropdown-item">
                            <img src="/admin-panel/assets/images/flags/russia.jpg" alt="user-image" class="me-1" height="12"> <span class="align-middle">Russian</span>
                        </a>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a class="nav-link dropdown-toggle waves-effect waves-light arrow-none" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="mdi mdi-bell font-size-24"></i>
                        <span class="badge bg-danger rounded-circle noti-icon-badge">{{ auth()->user()->unreadNotifications->count() }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('notifications.clear') }}" class="text-dark text-decoration-underline">
                                        <small>Clear All</small>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="px-1" style="max-height: 300px;" data-simplebar>
                            @forelse($notifications as $notification)
                                <a href="{{ route('notifications.read', $notification->id) }}" class="dropdown-item p-0 notify-item card {{ $notification->read_at ? 'read-noti' : 'unread-noti' }} shadow-none mb-1">
                                    <div class="card-body">
                                        <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0">
                                                <div class="notify-icon bg-primary">
                                                    <i class="mdi mdi-comment-account-outline"></i>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1 text-truncate ms-2">
                                                <h5 class="noti-item-title fw-semibold font-size-14">{{ $notification->data['title'] ?? 'Notification' }}
                                                    <small class="fw-normal text-muted ms-1">{{ $notification->created_at->diffForHumans() }}</small>
                                                </h5>
                                                <small class="noti-item-subtitle text-muted">{{ $notification->data['message'] ?? '' }}</small>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="text-center text-muted mt-3">No notifications</div>
                            @endforelse

                            <div class="text-center">
                                <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                            </div>
                        </div>

                        <!-- All-->
                        <a href="{{ route('notifications.all') }}" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                            View All
                        </a>
                    </div>
                </li>



                <li class="nav-link" id="theme-mode">
                    <i class="bx bx-moon font-size-24"></i>
                </li>
                <span class="text-danger" style="font-weight: 900">
                    @auth
                        <i class="bx bx-user"></i> {{ auth()->user()->name }}
                    @endauth
                </span>

            </ul>
        </div>
    </div>
    <!-- ========== Topbar End ========== -->