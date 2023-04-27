<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-body-tertiary sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_sistem') ? 'active' : '' }}" aria-current="page" href="/dashboard/admin_sistem">
                <span data-feather="home" class="align-text-bottom"></span>
                Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_sistem/profile*') ? 'active' : '' }}" href="/dashboard/admin_sistem/profile">
                <span data-feather="user" class="align-text-bottom"></span>
                My Profile
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/admin_sistem/register*') ? 'active' : '' }}" href="/dashboard/admin_sistem/register">
                <span data-feather="hard-drive" class="align-text-bottom"></span>
                Register Akun Admin Cafe
                </a>
            </li>
        </ul>
    </div>
</nav>