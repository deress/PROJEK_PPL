<header>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #C8B6A6;">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="/">Reserv.in</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link link-dark text-decoration-none" href="/#home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-dark text-decoration-none" href="/#about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link link-dark text-decoration-none" href="/#faq">FAQ</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                    <li class="nav-item dropdown">
                        @auth
                            <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Welcome back, {{ auth()->user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                            
                            @can('customer')
                                <li><a class="dropdown-item" href="{{ route('cust.home.index') }}"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard Customer</a></li>
                            @endcan    
                            
                            @can('admin_cafe')
                                <li><a class="dropdown-item" href="/dashboard/admin_cafe"><i class="bi bi-layout-text-sidebar-reverse"></i> Dashboard Admin Cafe</a></li>
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