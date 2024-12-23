<div class="scrollbar-inner sidebar-wrapper">
    <div class="user">
        <div class="photo">
            <img src="assets/img/profile.jpg">
        </div>
        <div class="info">
            <a class="" data-toggle="collapse" aria-expanded="true">
                <span>
                    Admin
                    <span class="user-level">Muhammad Rizky Cavendio</span>
                </span>
            </a>
            <div class="clearfix"></div>
        </div>
    </div>
    <ul class="nav">
        <li class="nav-item {{ Route::is('keluhan-dashboard') ? 'active' : '' }}">
            <a href="{{ route('keluhan-dashboard') }}">
                <i class="la la-dashboard"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item {{ Route::is('keluhan-form') ? 'active' : '' }}">
            <a href="{{ route('keluhan-form') }}">
                <i class="la la-keyboard-o"></i>
                <p>Form Keluhan</p>
            </a>
        </li>
    </ul>
</div>
