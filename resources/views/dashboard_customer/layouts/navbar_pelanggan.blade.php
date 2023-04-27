<header>
    <nav class="navbar sticky-top navbar-expand-lg navbar-light" style="background-color: #C8B6A6;">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="/">Reserv.in</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('customer/home*', 'customer/katalog*') ? 'active' : '' }}" href="{{ route('cust.home.index') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('customer/profile*') ? 'active' : '' }}" href="{{ route('cust.profile.index') }}">Profile</a>
                    </li>
                </ul>
            </div>

            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto"> 
                <li class="nav-item dropdown">
                    @auth
                        <a class="nav-link dropdown-toggle link-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome back, {{ auth()->user()->name }}
                        </a>
                        <ul class="dropdown-menu">
                            {{-- <li><hr class="dropwdown-divider"></li> --}}
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
    </nav>
</header>