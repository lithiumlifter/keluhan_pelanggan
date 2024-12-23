<div class="scrollbar-inner sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <img src="assets/img/profile.jpg">
        </div>
        <div class="info">
            <a class="" data-toggle="collapse" aria-expanded="true">
                <span>
                    Admin
                    <span class="user-level">Administrator</span>
                </span>
            </a>
            <div class="clearfix"></div>
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item active">
            <a href="{{ route('keluhan-dashboard') }}">
                <i class="la la-dashboard"></i>
                <p>Dashboard</p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="components.html">
                <i class="la la-table"></i>
                <p>Components</p>
            </a>
        </li> --}}
        <li class="nav-item">
            <a href="{{ route('keluhan-form') }}">
                <i class="la la-keyboard-o"></i>
                <p>Form Keluhan</p>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a href="tables.html">
                <i class="la la-th"></i>
                <p>Tables</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="notifications.html">
                <i class="la la-bell"></i>
                <p>Notifications</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="typography.html">
                <i class="la la-font"></i>
                <p>Typography</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="icons.html">
                <i class="la la-fonticons"></i>
                <p>Icons</p>
            </a>
        </li> --}}
    </ul>
</div>