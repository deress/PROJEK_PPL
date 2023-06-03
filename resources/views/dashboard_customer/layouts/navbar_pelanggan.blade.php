

<header>
    <nav class="navbar sticky-top navbar-expand-lg navbar-dark" style="background-color: #794028;">
        <div class="container-fluid mx-5">
            <a class="navbar-brand" href="/"><img src="/image/logo-2-white-2.png" height="45px" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse pt-3" id="navbarNav">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('customer/home*', 'customer/katalog*') ? 'active' : '' }}" href="{{ route('cust.home.index') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('customer/profile*') ? 'active' : '' }}" href="{{ route('cust.profile.index') }}">Profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('customer/reservation*', 'customer/review*') ? 'active' : '' }}" href="{{ route('cust.reservation.index') }}">Riwayat Reservasi</a>
                    </li>
                </ul>

                <ul class="navbar-nav mb-2 mb-lg-0 ms-auto"> 
                    <li class="nav-item dropdown">
                        @auth
                            <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Selamat datang, {{ auth()->user()->name }}
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

            
        
        </div>
    </nav>
</header>