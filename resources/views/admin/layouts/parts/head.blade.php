<head>

    <!-- Basic -->
    <meta charset="UTF-8">

    <title>@yield('title')</title>

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">
    <meta name="csrf-token" content="{{ csrf_token() }}">

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
    <link rel="stylesheet" href=" {{asset('admin_assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/jquery-ui/jquery-ui.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/jquery-ui/jquery-ui.theme.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/morris/morris.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css')}}" />

    <link rel="stylesheet" href="{{asset('admin_assets/vendor/select2/css/select2.css')}}" />

    <link rel="stylesheet" href="{{asset('admin_assets/vendor/select2-bootstrap-theme/select2-bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/bootstrap-multiselect/css/bootstrap-multiselect.css')}}" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/theme.css')}}" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/skins/default.css')}}" />


    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{asset('admin_assets/css/custom.css')}}">

    <!-- Head Libs -->
    <script src="{{asset('admin_assets/vendor/modernizr/modernizr.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin_assets/vendor/datatables/media/css/dataTables.bootstrap5.css')}}" />
   <style>
       .preview-image {
           max-width: 100px;
           max-height: 100px;
           margin: 5px;
       }
   </style>
    @livewireStyles()

</head>
