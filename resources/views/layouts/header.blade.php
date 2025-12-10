<header class="neu-header-modern">
    <!-- Top Bar Minimal -->
    <div class="neu-top-bar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-2">
                <div class="top-bar-left">
                    <span class="text-muted small">
                        <i class="fas fa-phone mr-1"></i> 90 90 85 85
                    </span>
                    <span class="text-muted small ml-3">
                        <i class="fas fa-envelope mr-1"></i> etsmodeste@gmail.com
                    </span>
                </div>
                <div class="top-bar-right">
                    @auth
                        <span class="text-muted small mr-3">
                            <i class="fas fa-user mr-1"></i> {{ auth()->user()->name }}
                        </span>
                        @if(auth()->user()->is_admin)
                            <a class="neu-link-sm mr-2" href="{{ route('admin.dashboard') }}">
                                <i class="fas fa-tachometer-alt"></i> Admin
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="neu-link-sm btn-link">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </button>
                        </form>
                    @else
                        <a class="neu-link-sm mr-2" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i> Connexion
                        </a>
                        <a class="neu-link-sm" href="{{ route('register') }}">
                            <i class="fas fa-user-plus"></i> Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar Neumorphic -->
    <nav class="neu-main-navbar">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center py-3">
                <!-- Logo -->
                <div class="neu-logo">
                    <a href="{{route('home')}}" class="navbar-brand d-flex align-items-center">
                        <i class="fas fa-motorcycle mr-2"></i>
                        <span class="brand-text">Ets Modeste</span>
                    </a>
                </div>

                <!-- Search Bar Compact -->
                <div class="neu-search-compact flex-grow-1 mx-4">
                    <form action="#" method="GET" class="search-form">
                        <input type="text" name="q" class="neu-input-search" placeholder="Rechercher des motos...">
                        <button class="neu-search-btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Cart -->
                <div class="neu-cart-container">
                    <a href="{{ route('cart.index') }}" class="neu-cart-link">
                        <div class="neu-cart-icon">
                            <i class="fas fa-shopping-cart"></i>
                            @if($cartCount > 0)
                                <span class="neu-cart-count">{{ $cartCount }}</span>
                            @endif
                        </div>
                        <span class="cart-text ml-2">Panier</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Category Navigation -->
    <div class="neu-category-bar">
        <div class="container">
            <nav class="category-nav-wrapper">
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#categoryNav">
                    <i class="fas fa-bars"></i> Menu
                </button>
                <div class="collapse navbar-collapse" id="categoryNav">
                    <ul class="category-nav-list">
                        <li class="category-nav-item">
                            <a class="category-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">
                                <i class="fas fa-home"></i>
                                <span>Accueil</span>
                            </a>
                        </li>
                        @foreach($categories as $Category)
                            <li class="category-nav-item">
                                <a class="category-link {{ request('id') == $Category->id ? 'active' : '' }}"
                                   href="{{route('voir_produit_par_cat', ['id' => $Category->id])}}">
                                    <span>{{$Category->nom}}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</header>