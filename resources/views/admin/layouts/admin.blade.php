<!DOCTYPE html>
<html class="fixed">

@include('admin.layouts.parts.head')

<body>
<section class="body">

    <!-- start: header -->
    @include('admin.layouts.parts.navbar')
    <!-- end: header -->

    <div class="inner-wrapper">
        <!-- start: sidebar -->
        @include('admin.layouts.parts.sidebar')
        <!-- end: sidebar -->

     <!--  content  -->
         @yield('content')
        <!-- end content -->
    </div>

<!-- start aside -->
    @include('admin.layouts.parts.sidebar-right')
    <!-- end aside  -->
</section>

<!-- Start Js  -->
@include('admin.layouts.parts.footer')
<!-- End Js  -->

</body>

</html>
