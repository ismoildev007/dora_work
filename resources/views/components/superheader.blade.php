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
                <a href="/dashboard" class="menu-link waves-effect waves-light">
                    <span class="menu-icon"><i class="bx bx-home-smile"></i></span>
                    <span class="menu-text"> Dashboards </span>
                    <span class="badge bg-primary rounded ms-auto">01</span>
                </a>
            </li>

{{--            @can('view-statistics')--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('statistic.index')}}" class="menu-link waves-effect waves-light">--}}
{{--                        <span class="menu-icon"><i class="bx bx-calendar"></i></span>--}}
{{--                        <span class="menu-text">Statistikalar</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            @can('view-work-category')--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('work-category.index') }}" class="menu-link waves-effect waves-light">--}}
{{--                        <span class="menu-icon"><i class="bx bx-calendar"></i></span>--}}
{{--                        <span class="menu-text">Bo'lim qo'shish</span>--}}
{{--                    </a>--}}
{{--                </li>--}}

{{--            @endcan--}}
{{--            @can('date-task')--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('date-task.index')}}" class="menu-link waves-effect waves-light">--}}
{{--                        <span class="menu-icon"><i class="bx bx-calendar"></i></span>--}}
{{--                        <span class="menu-text">Kunlik vazifalar</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}
            
{{--                <li class="menu-item">--}}
{{--                        <a href="#menuPlans" data-bs-toggle="collapse" class="menu-link waves-effect waves-light">--}}
{{--                            <span class="menu-icon"><i class="bx bx-file"></i></span>--}}
{{--                            <span class="menu-text"> Plans </span>--}}
{{--                            <span class="menu-arrow"></span>--}}
{{--                        </a>--}}
{{--                        <div class="collapse" id="menuPlans">--}}
{{--                            <ul class="sub-menu">--}}

{{--                                <li class="menu-item">--}}
{{--                                    <a href="javascript: void(0)" class="menu-link">--}}
{{--                                        <span class="menu-text">Maqsad</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                --}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                </li>--}}
            
            @can('view-client')
                <li class="menu-item">
                    <a href="{{ route('clients.index') }}" class="menu-link waves-effect waves-light">
                        <span class="menu-icon"><i class="bx bx-calendar"></i></span>
                        <span class="menu-text"> Clients </span>
                    </a>
                </li>
            @endcan
            @can('view-amount')
            <li class="menu-item">
                <a href="{{ route('amounts.index') }}" class="menu-link">
                    <span class="menu-text">Amount</span>
                </a>
            </li>
            @endcan
            @can('view-department')
                <li class="menu-item">
                    <a href="{{ route('departments.index') }}" class="menu-link">
                        <span class="menu-text">Deaprtment</span>
                    </a>
                </li>
            @endcan
            @can('view-employee')
                <li class="menu-item">
                    <a href="{{ route('employees.index') }}" class="menu-link">
                        <span class="menu-text">Employees</span>
                    </a>
                </li>
            @endcan
            @can('view-manager')
                <li class="menu-item">
                    <a href="{{ route('managers.index') }}" class="menu-link">
                        <span class="menu-text">Manager</span>
                    </a>
                </li>
            @endcan
            @can('view-notification')
            <li class="menu-item">
                <a href="{{ route('notifications.index') }}" class="menu-link">
                    <span class="menu-text">Notifications</span>
                </a>
            </li>
            @endcan
            @can('view-project')
            <li class="menu-item">
                <a href="{{ route('projects.index') }}" class="menu-link">
                    <span class="menu-text">Projects</span>
                </a>
            </li>
            @endcan
            @can('view-status')
            <li class="menu-item">
                <a href="{{ route('statuses.index') }}" class="menu-link">
                    <span class="menu-text">Status</span>
                </a>
            </li>
            @endcan
            @can('view-work')
            <li class="menu-item">
                <a href="{{ route('works.index') }}" class="menu-link">
                    <span class="menu-text">Work</span>
                </a>
            </li>
            @endcan
            <form method="post" action="{{ route('logout') }}">
                <i class="fe-log-out"></i>
                <span>
                                    @csrf
                                    <button class="btn">Chiqish</button>
                                </span>
            </form>
{{--            @can('view-work-category')--}}
{{--                <li class="menu-item">--}}
{{--                        <div class="collapse" id="menuKassa">--}}
{{--                            <ul class="sub-menu">--}}
{{--                                <li class="menu-item">--}}
{{--                                    <a href="{{ route('amounts.index') }}" class="menu-link">--}}
{{--                                        <span class="menu-text">Amount</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                                <li class="menu-item">--}}
{{--                                    <a href="{{ route('departments.index') }}" class="menu-link">--}}
{{--                                        <span class="menu-text">Deaprtment</span>--}}
{{--                                    </a>--}}
{{--                                </li>--}}
{{--                            </ul>--}}
{{--                        </div>--}}
{{--                </li>--}}
{{--            @endcan--}}
{{--            @can('view-statistics')--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('statistic.index')}}" class="menu-link waves-effect waves-light">--}}
{{--                        <span class="menu-icon"><i class="bx bx-calendar"></i></span>--}}
{{--                        <span class="menu-text">Mijozlar</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}

{{--            @can('date-task-super-admin')--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="{{ route('date-task-super-admin.index')}}" class="menu-link waves-effect waves-light">--}}
{{--                        <span class="menu-icon"><i class="bx bx-calendar"></i></span>--}}
{{--                        <span class="menu-text">Kunlik ishchilar vazifalari</span>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @endcan--}}
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
                        <span class="badge bg-danger rounded-circle noti-icon-badge">9</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animated dropdown-lg py-0">
                        <div class="p-2 border-top-0 border-start-0 border-end-0 border-dashed border">
                            <div class="row align-items-center">
                                <div class="col">
                                    <h6 class="m-0 font-size-16 fw-semibold"> Notification</h6>
                                </div>
                                <div class="col-auto">
                                    <a href="javascript: void(0);" class="text-dark text-decoration-underline">
                                        <small>Clear All</small>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="px-1" style="max-height: 300px;" data-simplebar>

                            <h5 class="text-muted font-size-13 fw-normal mt-2">Today</h5>
                            <!-- item-->

                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card unread-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Datacorp <small class="fw-normal text-muted ms-1">1 min ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-info">
                                                <i class="mdi mdi-account-plus"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Admin <small class="fw-normal text-muted ms-1">1 hours ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">New user registered</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-muted font-size-13 fw-normal mt-0">Yesterday</h5>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img src="/admin-panel/assets/images/users/avatar-2.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Cristina Pride <small class="fw-normal text-muted ms-1">1 day ago</small></h5>
                                            <small class="noti-item-subtitle text-muted">Hi, How are you? What about our next meeting</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <h5 class="text-muted font-size-13 fw-normal mt-0">30 Dec 2021</h5>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon bg-primary">
                                                <i class="mdi mdi-comment-account-outline"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Datacorp</h5>
                                            <small class="noti-item-subtitle text-muted">Caleb Flakelar commented on Admin</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <!-- item-->
                            <a href="javascript:void(0);" class="dropdown-item p-0 notify-item card read-noti shadow-none mb-1">
                                <div class="card-body">
                                    <span class="float-end noti-close-btn text-muted"><i class="mdi mdi-close"></i></span>
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon">
                                                <img src="/admin-panel/assets/images/users/avatar-4.jpg" class="img-fluid rounded-circle" alt="" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                            <h5 class="noti-item-title fw-semibold font-size-14">Karen Robinson</h5>
                                            <small class="noti-item-subtitle text-muted">Wow ! this admin looks good and awesome design</small>
                                        </div>
                                    </div>
                                </div>
                            </a>

                            <div class="text-center">
                                <i class="mdi mdi-dots-circle mdi-spin text-muted h3 mt-0"></i>
                            </div>
                        </div>

                        <!-- All-->
                        <a href="javascript:void(0);" class="dropdown-item text-center text-primary notify-item border-top border-light py-2">
                            View All
                        </a>

                    </div>
                </li>

                <li class="nav-link" id="theme-mode">
                    <i class="bx bx-moon font-size-24"></i>
                </li>

{{--                <li class="dropdown">--}}
{{--                        <span class="ms-1 d-none d-md-inline-block">--}}
{{--                            {{auth()->user()->name}}--}}
{{--                        </span>--}}
{{--                </li>--}}

{{--                <form method="post" action="{{ route('logout') }}">--}}
{{--                    @csrf--}}
{{--                    <button class="btn btn-danger">Log Out</button>--}}
{{--                </form>--}}

            </ul>
        </div>
    </div>
    <!-- ========== Topbar End ========== -->
