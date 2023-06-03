<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse mt-3" style="background-color: #E9C094;">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin_cafe/dashboard') ? 'active' : '' }}" aria-current="page" href="{{ route('admin_cafe.dashboard.index') }}">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin_cafe/profile*') ? 'active' : '' }}" href="{{ route('admin_cafe.profile.index') }}">
                <span data-feather="user" class="align-text-bottom"></span>
                My Profile
                </a>
            </li>   
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin_cafe/stok*') ? 'active' : '' }}" href="{{ route('admin_cafe.stok.index') }}">
                <span data-feather="truck" class="align-text-bottom"></span>
                Stok
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin_cafe/keuangan*') ? 'active' : '' }}" href="{{ route('admin_cafe.keuangan.index') }}">
                <span data-feather="dollar-sign" class="align-text-bottom"></span>
                Keuangan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin_cafe/katalog*') ? 'active' : '' }}" href="{{ route('admin_cafe.katalog.index') }}">
                <span data-feather="book-open" class="align-text-bottom"></span>
                Katalog Fasilitas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('admin_cafe/reservation*') ? 'active' : '' }}" href="{{ route('admin_cafe.reservation.index') }}">
                <span data-feather="list" class="align-text-bottom"></span>
                Daftar Reservasi
                </a>
            </li>
            
        </ul>
    </div>
</nav>


