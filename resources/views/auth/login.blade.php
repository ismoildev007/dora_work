<!DOCTYPE html>
<html lang="en" data-bs-theme="light" data-menu-color="brand" data-topbar-color="light">

<head>
    <meta charset="utf-8" />
    <title>Log In | Dashtrap - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Myra Studio" name="author"/>

    <!-- App favicon -->
    <link rel="apple-touch-icon" sizes="76x76" href="/public/assets/images/fav/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/fav/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/fav/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/fav/favicon-16x16.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/fav/favicon-16x16.png">

    <!-- App css -->
    <link href="/admin-panel/assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="/admin-panel/assets/css/icons.min.css" rel="stylesheet" type="text/css">
    <script src="/admin-panel/assets/js/config.js"></script>
</head>

<body class="bg-primary d-flex justify-content-center align-items-center min-vh-100 p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-5">
                <div class="card">
                    <div class="card-body p-4">

                        <div class="text-center w-75 mx-auto auth-logo mb-4">
                            <a href="/" class="logo-dark">
                                <span><img src="/assets/images/logo/dora-logo-color.png" alt="" height="22"></span>
                            </a>

                            <a href="/" class="logo-light">
                                <span><img src="/admin-panel/assets/images/logo-light.png" alt="" height="22"></span>
                            </a>
                        </div>
                        @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        <form action="{{ route('login.post')}}" method="post">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label" for="emailaddress">Email address</label>
                                <input class="form-control" name="email" type="email" id="emailaddress" required="" placeholder="Enter your email">
                            </div>

                            <div class="form-group mb-3">
                                <a href="pages-recoverpw.html" class="text-muted float-end"><small></small></a>
                                <label class="form-label" for="password">Password</label>
                                <input class="form-control" name="password" type="password" required="" id="password" placeholder="Enter your password">
                            </div>

                            <div class="form-group mb-0 text-center">
                                <button class="btn btn-primary w-100" type="submit"> Log In </button>
                            </div>

                        </form>
                    </div> <!-- end card-body -->
                </div>
                <!-- end card -->


            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>

    <!-- App js -->
    <script src="/admin-panel/assets/js/vendor.min.js"></script>
    <script src="/admin-panel/assets/js/app.js"></script>

</body>

</html>
