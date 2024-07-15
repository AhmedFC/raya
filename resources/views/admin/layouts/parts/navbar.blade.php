<!-- start: header -->
<header class="header">
    <div class="logo-container">
        <a href="../4.1.0" class="logo">
            <img src="{{asset('admin_assets/img/logo-copart.png')}}" width="75" height="35" alt="Porto Admin" />
        </a>

        <div class="d-md-none toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
            <i class="fas fa-bars" aria-label="Toggle sidebar"></i>
        </div>

    </div>

    <!-- start: search & user box -->
    <div class="header-right">


        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">

                <div class="profile-info">
                    {{ app()->getLocale() == "en-US,en;q=0.9" || app()->getLocale() == "en" ? 'en' :'ar' }}
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    <li>
                        <a class="dropdown-item" rel="alternate" hreflang="ar" href="{{ route('admin.lang','ar') }}">AR
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" rel="alternate" hreflang="en" href="{{ route('admin.lang','en') }}">EN
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        <span class="separator"></span>

        <div id="userbox" class="userbox">
            <a href="#" data-bs-toggle="dropdown">
                <figure class="profile-picture">
                    <img src="{{asset('admin_assets/img/!logged-user.jpg')}}" alt="Joseph Doe" class="rounded-circle" data-lock-picture="img/!logged-user.jpg" />
                </figure>
                <div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
                    <span class="name">{{auth()->user()->name}}</span>
                    <span class="role">Administrator</span>
                </div>

                <i class="fa custom-caret"></i>
            </a>

            <div class="dropdown-menu">
                <ul class="list-unstyled mb-2">
                    <li class="divider"></li>
                    @auth
                    <li>
                        <a role="menuitem" tabindex="-1" href="{{route('admin.AdminLogout')}}"><i class="bx bx-power-off"></i> Logout</a>
                    </li>
                    @endauth

                </ul>
            </div>
        </div>
    </div>
    <!-- end: search & user box -->
</header>
<!-- end: header -->
