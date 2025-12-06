<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Zute Admin</title>

    <!-- Bootstrap 4 CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background: #2c3e50;
            padding-top: 20px;
            z-index: 100;
        }
        .admin-sidebar .logo {
            padding: 15px 20px;
            color: #fff;
            font-size: 20px;
            font-weight: bold;
            border-bottom: 1px solid #34495e;
            margin-bottom: 10px;
        }
        .admin-sidebar .nav-link {
            color: #ecf0f1;
            padding: 12px 20px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        .admin-sidebar .nav-link i {
            margin-right: 10px;
            width: 20px;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: #34495e;
            color: #fff;
            text-decoration: none;
        }
        .admin-content {
            margin-left: 250px;
            min-height: 100vh;
            background: #ecf0f1;
        }
        .admin-navbar {
            background: #fff;
            padding: 15px 30px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .page-header {
            background: #fff;
            padding: 20px 30px;
            margin-bottom: 20px;
            border-bottom: 2px solid #3498db;
        }
        .page-header h1 {
            margin: 0;
            font-size: 24px;
            color: #2c3e50;
        }
        .content-wrapper {
            padding: 20px 30px;
        }
        .stat-card {
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .stat-card h3 {
            margin: 0;
            font-size: 32px;
            color: #2c3e50;
        }
        .stat-card p {
            margin: 5px 0 0 0;
            color: #7f8c8d;
            font-size: 14px;
        }
        .stat-card .icon {
            font-size: 40px;
            opacity: 0.3;
        }
    </style>

    @yield('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <div class="logo">
            <i class="fas fa-motorcycle"></i> Zute Admin
        </div>

        <nav class="nav flex-column">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                <i class="fas fa-motorcycle"></i>
                <span>Produits</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                <i class="fas fa-folder"></i>
                <span>Catégories</span>
            </a>

            <a href="{{ route('admin.tags.index') }}" class="nav-link {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                <i class="fas fa-tags"></i>
                <span>Tags</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="fas fa-users"></i>
                <span>Utilisateurs</span>
            </a>

            <hr style="border-color: #34495e; margin: 10px 20px;">

            <a href="{{ route('home') }}" class="nav-link">
                <i class="fas fa-arrow-left"></i>
                <span>Retour à la boutique</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Top Navbar -->
        <div class="admin-navbar">
            <div>
                <span class="text-muted">Bienvenue, </span>
                <strong>{{ auth()->user()->name }}</strong>
            </div>
            <div>
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger">
                        <i class="fas fa-sign-out-alt"></i> Déconnexion
                    </button>
                </form>
            </div>
        </div>

        <!-- Page Header -->
        <div class="page-header">
            <h1>@yield('page-title', 'Dashboard')</h1>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Erreurs de validation:</strong>
                    <ul class="mb-0">
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
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    @yield('scripts')
</body>
</html>
