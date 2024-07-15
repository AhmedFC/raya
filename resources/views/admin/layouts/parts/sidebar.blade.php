<!-- start: sidebar -->
<aside id="sidebar-left" class="sidebar-left">

    <div class="sidebar-header">
        <div class="sidebar-title">
            Navigation
        </div>
        <div class="sidebar-toggle d-none d-md-block" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>
    </div>

    <div class="nano">
        <div class="nano-content">
            <nav id="menu" class="nav-main" role="navigation">

                <ul class="nav nav-main">
                    <li>
                        <a class="nav-link" href="{{route('admin.home')}}">
                            <i class="bx bx-home-alt" aria-hidden="true"></i>
                            <span>@lang('admin.dashboard')</span>
                        </a>
                    </li>

                    <li class="nav-parent nav-expanded nav-active">
                        <a class="nav-link" href="#">
                            <i class="bx bx-file" aria-hidden="true"></i>
                            <span>@lang('admin.Users & Roles')</span>
                        </a>
                        <ul class="nav nav-children">

                            <li class="nav{{ Request::route()->getName() == 'admin.users.index' ? '-active' : '' }}">
                                <a class="nav-link" href="{{route('admin.users.index')}}">
                                    @lang('admin.users')
                                </a>
                            </li>

                            <li class="nav{{ Request::route()->getName() == 'admin.roles.index' ? '-active' : '' }}">
                                <a class="nav-link" href="{{route('admin.roles.index')}}">
                                    @lang('admin.roles')
                                </a>
                            </li>



                        </ul>
                    </li>

                    <li class="nav-parent nav-expanded">
                        <a class="nav-link" href="#">
                            <i class="bx bx-file" aria-hidden="true"></i>
                            <span>@lang('admin.Projects & Tasks')</span>
                        </a>
                        <ul class="nav nav-children">

                            <li class="nav{{ Request::route()->getName() == 'admin.projects.index' ? '-active' : '' }}">
                                <a class="nav-link" href="{{route('admin.projects.index')}}">
                                    @lang('admin.projects')
                                </a>
                            </li>

                            <li class="nav{{ Request::route()->getName() == 'admin.tasks.index' ? '-active' : '' }}">
                                <a class="nav-link" href="{{route('admin.tasks.index')}}">
                                    @lang('admin.tasks')
                                </a>
                            </li>



                        </ul>
                    </li>


                </ul>
            </nav>

        </div>

        <script>
            // Maintain Scroll Position
            if (typeof localStorage !== 'undefined') {
                if (localStorage.getItem('sidebar-left-position') !== null) {
                    var initialPosition = localStorage.getItem('sidebar-left-position'),
                        sidebarLeft = document.querySelector('#sidebar-left .nano-content');

                    sidebarLeft.scrollTop = initialPosition;
                }
            }
        </script>

    </div>

</aside>
<!-- end: sidebar -->
