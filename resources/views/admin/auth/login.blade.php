<!doctype html>
<html class="fixed">
<head>

    <!-- Basic -->
    <meta charset="UTF-8">
    <title>Admin Login</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap/css/bootstrap.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/animate/animate.compat.css')}}">
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/font-awesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/boxicons/css/boxicons.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/magnific-popup/magnific-popup.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/theme.css')}}" />
    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/skins/default.css')}}" />
    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/custom.css')}}">
    <!-- Head Libs -->
    <script src="{{asset('admin_assets/vendor/modernizr/modernizr.js')}}"></script>

</head>
<body>
<!-- start: page -->
<section class="body-sign">
    <div class="center-sign">
        <a href="/" class="logo float-start">
            <img src="{{asset('admin_assets/img/logo-copart.png')}}" height="70" alt="Saudi Part" />
        </a>

        <div class="panel card-sign">
            <div class="card-title-sign mt-3 text-end">
                <h2 class="title text-uppercase font-weight-bold m-0"><i class="bx bx-user-circle me-1 text-6 position-relative top-5"></i> Sign In</h2>
            </div>
            <div class="card-body">
                <form action="{{route('admin.login.post')}}" method="post">
                    @csrf
                    <div class="form-group mb-3">
                        <label>Email</label>
                        <div class="input-group">
                            <input name="email" type="text" class="form-control form-control-lg" />
                            <span class="input-group-text">
										<i class="bx bx-user text-4"></i>
									</span>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="clearfix">
                            <label class="float-start">Password</label>
                        </div>
                        <div class="input-group">
                            <input name="password" type="password" class="form-control form-control-lg" />
                            <span class="input-group-text">
										<i class="bx bx-lock text-4"></i>
									</span>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 text-end">
                            <button type="submit" class="btn btn-primary mt-2">Sign In</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

        <p class="text-center text-muted mt-3 mb-3">&copy; Copyright {{date('Y')}}. All Rights Reserved.</p>
    </div>
</section>
<!-- end: page -->

<!-- Vendor -->
<script src="{{asset('admin_assets/vendor/jquery/jquery.js')}}"></script>
<script src="{{asset('admin_assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js')}}"></script>
<script src="{{asset('admin_assets/vendor/popper/umd/popper.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('admin_assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
<script src="{{asset('admin_assets/vendor/common/common.js')}}"></script>
<script src="{{asset('admin_assets/vendor/nanoscroller/nanoscroller.js')}}"></script>
<script src="{{asset('admin_assets/vendor/magnific-popup/jquery.magnific-popup.js')}}"></script>
<script src="{{asset('admin_assets/vendor/jquery-placeholder/jquery.placeholder.js')}}"></script>

<!-- Specific Page Vendor -->

<!-- Theme Base, Components and Settings -->
<script src="{{asset('admin_assets/js/theme.js')}}"></script>

<!-- Theme Custom -->
<script src="{{asset('admin_assets/js/custom.js')}}"></script>

<!-- Theme Initialization Files -->
<script src="{{asset('admin_assets/js/theme.init.js')}}"></script>


</body>
</html>
