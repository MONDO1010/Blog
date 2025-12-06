<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - Ets Modeste</title>

    <!-- Google Fonts - Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Admin Flat CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin-flat.css') }}">

    @yield('styles')
</head>
<body class="admin-body">
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="admin-sidebar">
            <div class="admin-sidebar-header">
                <a href="{{ route('admin.dashboard') }}" class="admin-logo">
                    <i class="fas fa-store"></i>
                    <span>Ets Modeste</span>
                </a>
            </div>

            <nav class="admin-nav">
                <div class="admin-nav-label">Principal</div>

                <div class="admin-nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="admin-nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-th-large"></i>
                        <span>Dashboard</span>
                    </a>
                </div>

                <div class="admin-nav-divider"></div>
                <div class="admin-nav-label">Gestion</div>

                <div class="admin-nav-item">
                    <a href="{{ route('admin.products.index') }}" class="admin-nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                        <i class="fas fa-motorcycle"></i>
                        <span>Produits</span>
                    </a>
                </div>

                <div class="admin-nav-item">
                    <a href="{{ route('admin.categories.index') }}" class="admin-nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open"></i>
                        <span>Catégories</span>
                    </a>
                </div>

                <div class="admin-nav-item">
                    <a href="{{ route('admin.tags.index') }}" class="admin-nav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                        <i class="fas fa-tags"></i>
                        <span>Tags</span>
                    </a>
                </div>

                <div class="admin-nav-divider"></div>
                <div class="admin-nav-label">Ventes</div>

                <div class="admin-nav-item">
                    <a href="{{ route('admin.orders.index') }}" class="admin-nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                        <i class="fas fa-shopping-bag"></i>
                        <span>Commandes</span>
                    </a>
                </div>

                <div class="admin-nav-divider"></div>
                <div class="admin-nav-label">Système</div>

                <div class="admin-nav-item">
                    <a href="{{ route('admin.users.index') }}" class="admin-nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Utilisateurs</span>
                    </a>
                </div>

                <div class="admin-nav-divider"></div>

                <div class="admin-nav-item">
                    <a href="{{ route('home') }}" class="admin-nav-link">
                        <i class="fas fa-external-link-alt"></i>
                        <span>Voir la boutique</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="admin-content">
            <!-- Header -->
            <header class="admin-header">
                <div class="admin-header-left">
                    <h1>@yield('page-title', 'Dashboard')</h1>
                    <p>@yield('page-description', 'Bienvenue dans votre espace d\'administration')</p>
                </div>

                <div class="admin-header-right">
                    <div class="admin-user-info">
                        <div class="admin-user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                        </div>
                        <span class="admin-user-name">{{ auth()->user()->name }}</span>
                    </div>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="flat-btn flat-btn-danger flat-btn-sm">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </header>

            <!-- Main Area -->
            <main class="admin-main fade-in">
                <!-- Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong><i class="fas fa-exclamation-triangle mr-2"></i>Erreurs de validation:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
