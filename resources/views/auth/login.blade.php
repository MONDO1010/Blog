<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Connexion - Ets Modeste</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/neumorphism.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-main);
        }
        .auth-card {
            max-width: 450px;
            width: 100%;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-logo i {
            font-size: 60px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        .auth-logo h2 {
            margin-top: 15px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: bold;
        }
        .form-group label {
            font-weight: 600;
            color: var(--text-primary);
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="neu-card">
                <div class="auth-logo">
                    <i class="fas fa-motorcycle"></i>
                    <h2>Ets Modeste</h2>
                    <p class="text-muted">Connexion à votre compte</p>
                </div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope mr-2"></i>Email</label>
                        <input type="email" class="neu-input w-100 @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               required autofocus placeholder="votre@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock mr-2"></i>Mot de passe</label>
                        <input type="password" class="neu-input w-100 @error('password') is-invalid @enderror"
                               id="password" name="password" required placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Se souvenir de moi
                        </label>
                    </div>

                    <button type="submit" class="neu-btn-primary neu-btn btn-block py-3">
                        <i class="fas fa-sign-in-alt"></i> Se Connecter
                    </button>

                    <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                    <div class="text-center">
                        <p class="mb-2 text-muted">Vous n'avez pas de compte ?</p>
                        <a href="{{ route('register') }}" class="neu-btn btn-block">
                            <i class="fas fa-user-plus"></i> Créer un compte
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="text-muted">
                            <i class="fas fa-arrow-left"></i> Retour à l'accueil
                        </a>
                    </div>
                </form>

                <!-- Test Credentials -->
                <div class="neu-card-sm mt-4">
                    <h6 class="mb-3 text-gradient"><i class="fas fa-flask"></i> Mode Test - Remplissage Rapide</h6>
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="neu-btn-accent neu-btn btn-block" onclick="fillAdmin()" style="padding: 10px;">
                                <i class="fas fa-user-shield"></i> Admin
                            </button>
                            <small class="text-muted d-block mt-1 text-center">admin@zute.com</small>
                        </div>
                        <div class="col-6">
                            <button type="button" class="neu-btn btn-block" onclick="fillUser()" style="padding: 10px;">
                                <i class="fas fa-user"></i> Utilisateur
                            </button>
                            <small class="text-muted d-block mt-1 text-center">user@zute.com</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
        function fillAdmin() {
            document.getElementById('email').value = 'admin@zute.com';
            document.getElementById('password').value = 'password';
            document.getElementById('remember').checked = true;
        }

        function fillUser() {
            document.getElementById('email').value = 'user@zute.com';
            document.getElementById('password').value = 'password';
            document.getElementById('remember').checked = true;
        }
    </script>
</body>
</html>
