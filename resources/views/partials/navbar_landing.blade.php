<header>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #794028;">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="/"><img src="/image/logo-2-white-2.png" height="45px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pt-3" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link  text-decoration-none" href="/#home">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-decoration-none" href="/#about">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-decoration-none" href="/#faq">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  {{ Request::is('feedback*') ? 'active' : '' }}" href="{{ route('feedback.index') }}">Umpan Balik</a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item dropdown" >
                        @auth
                            <a class="nav-link dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Selamat datang, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu" >
                            
                            @can('customer')
                                <li><a class="dropdown-item" href="{{ route('cust.home.index') }}"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard Customer</a></li>
                            @endcan    
                            
                            @can('admin_cafe')
                                <li><a class="dropdown-item" href="{{ route('admin_cafe.dashboard.index') }}"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard Admin Cafe</a></li>
                            @endcan

                            @can('admin_sistem')
                                <li><a class="dropdown-item" href="/dashboard/admin_sistem"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard Admin Sistem</a></li>
                                <li><a class="dropdown-item" href="{{ route('cust.home.index') }}"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard Customer</a></li>
                            @endcan
                            
                            <li><hr class="dropwdown-divider"></li>
                            <li>
                                <form action="/logout" method="post">
                                    @csrf
                                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right"></i> Logout</button>
                                </form>
                            </li>
                            </ul>
                        @else
                            <li class="nav-item">
                                <a class="nav-link link-dark text-decoration-none" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
                            </li>
                        @endauth
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>
</header>