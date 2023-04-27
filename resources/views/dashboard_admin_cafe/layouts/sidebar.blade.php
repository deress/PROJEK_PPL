<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_cafe') ? 'active' : '' }}" aria-current="page" href="/dashboard/admin_cafe">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_cafe/profile*') ? 'active' : '' }}" href="/dashboard/admin_cafe/profile">
                <span data-feather="user" class="align-text-bottom"></span>
                My Profile
                </a>
            </li>   
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_cafe/stok*') ? 'active' : '' }}" href="/dashboard/admin_cafe/stok">
                <span data-feather="truck" class="align-text-bottom"></span>
                Stok
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_cafe/katalog*') ? 'active' : '' }}" href="/dashboard/admin_cafe/katalog">
                <span data-feather="book-open" class="align-text-bottom"></span>
                Katalog Fasilitas
                </a>
            </li>
        </ul>
    </div>
</nav>