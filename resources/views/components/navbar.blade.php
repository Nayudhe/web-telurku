<header>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #508bfc">
        <div class="container-fluid px-4 py-3">
            <a class="navbar-brand fw-bold h1 mb-0" style="letter-spacing: 1px; text-transform: uppercase"
                href="#">Telurku</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'Home' ? 'active fw-semibold' : '' }}"
                            href="{{ route('Home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'Product.All' ? 'active fw-semibold' : '' }}"
                            href="{{ route('Product.All') }}">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'About' ? 'active fw-semibold' : '' }}"
                            href="{{ route('About') }}">Tentang Kami</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ Route::current()->getName() == 'Contact' ? 'active fw-semibold' : '' }}"
                            href="{{ route('Contact') }}">Kontak</a>
                    </li>

                </ul>
                @auth
                    <div>
                        <ul class="navbar-nav mb-lg-0">
                            <li class="nav-item me-2">
                                <a class="nav-link text-light" href="{{ route('Cart') }}"><i class="bi bi-cart h3"></i></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link text-light" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <i class="bi bi-person-circle h3"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('Profile') }}">My Profile</a></li>
                                    <li><a class="dropdown-item" href="{{ route('Orders') }}">My Order</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <div class="ms-3">
                                            <form action="{{ route('Auth.Logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Logout</button>
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @endauth

                @guest
                    <div>
                        <a href="{{ route('Auth.LoginView') }}" class="btn btn-light rounded-pill px-3">Login</a>
                    </div>
                @endguest

            </div>
        </div>
    </nav>
</header>
