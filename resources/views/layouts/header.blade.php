<header class="neu-header">
    <!-- Top Bar with Search and User Info -->
    <div class="top-bar py-2">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-4">
                    <div class="top-bar-left">
                        <span class="text-white"><i class="fas fa-phone"></i> +237 XXX XXX XXX</span>
                    </div>
                </div>
                <div class="col-md-8 text-right">
                    <div class="top-bar-right">
                        @auth
                            <span class="text-white mr-3"><i class="fas fa-user"></i> {{ auth()->user()->name }}</span>
                            @if(auth()->user()->is_admin)
                                <a class="btn btn-sm btn-warning mr-2" href="{{ route('admin.dashboard') }}" style="border-radius: 12px;">
                                    <i class="fas fa-tachometer-alt"></i> Admin
                                </a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-light" style="border-radius: 12px;">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </button>
                            </form>
                        @else
                            <a class="btn btn-sm btn-outline-light mr-2" href="{{ route('login') }}" style="border-radius: 12px;">
                                <i class="fas fa-sign-in-alt"></i> Connexion
                            </a>
                            <a class="btn btn-sm btn-light" href="{{ route('register') }}" style="border-radius: 12px;">
                                <i class="fas fa-user-plus"></i> Inscription
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navbar Neumorphic -->
    <nav class="neu-navbar">
        <div class="container">
            <div class="row align-items-center w-100">
                <div class="col-lg-3">
                    <a href="{{route('home')}}" class="navbar-brand">
                        <i class="fas fa-motorcycle mr-2"></i>
                        <strong>Ets Modeste</strong>
                    </a>
                </div>

                <!-- Search Bar Neumorphic -->
                <div class="col-lg-6">
                    <div class="neu-search w-100">
                        <form action="#" method="GET" class="d-flex align-items-center">
                            <input type="text" name="q" class="form-control border-0 flex-grow-1" placeholder="Rechercher des motos..." aria-label="Search">
                            <button class="neu-btn-primary" type="submit">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="col-lg-3 text-right">
                    <a href="{{ route('cart.index') }}" class="neu-cart-btn d-inline-flex">
                        <i class="fas fa-shopping-cart"></i>
                        <span class="neu-cart-badge">{{ \App\Models\Cart::where(auth()->check() ? 'user_id' : 'session_id', auth()->check() ? auth()->id() : session('cart_session_id'))->count() }}</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Category Navigation Neumorphic -->
    <div class="container">
        <nav class="neu-category-nav">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#categoryNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="categoryNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{route('home')}}">
                            <i class="fas fa-home"></i> Accueil
                        </a>
                    </li>
                    @foreach($categories as $Category)
                        <li class="nav-item">
                            <a class="nav-link {{ request('id') == $Category->id ? 'active' : '' }}"
                               href="{{route('voir_produit_par_cat', ['id' => $Category->id])}}">
                                {{$Category->nom}}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </nav>
    </div>

</header>