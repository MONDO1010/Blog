<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription - Ets Modeste</title>
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
            padding: 40px 0;
        }
        .auth-card {
            max-width: 500px;
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
                    <p class="text-muted">Créez votre compte</p>
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

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-group">
                        <label for="name"><i class="fas fa-user mr-2"></i>Nom complet</label>
                        <input type="text" class="neu-input w-100 @error('name') is-invalid @enderror"
                               id="name" name="name" value="{{ old('name') }}"
                               required autofocus placeholder="Jean Dupont">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email"><i class="fas fa-envelope mr-2"></i>Email</label>
                        <input type="email" class="neu-input w-100 @error('email') is-invalid @enderror"
                               id="email" name="email" value="{{ old('email') }}"
                               required placeholder="votre@email.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="fas fa-lock mr-2"></i>Mot de passe</label>
                        <input type="password" class="neu-input w-100 @error('password') is-invalid @enderror"
                               id="password" name="password" required placeholder="Minimum 8 caractères">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Minimum 8 caractères</small>
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation"><i class="fas fa-lock mr-2"></i>Confirmer le mot de passe</label>
                        <input type="password" class="neu-input w-100"
                               id="password_confirmation" name="password_confirmation"
                               required placeholder="Retapez votre mot de passe">
                    </div>

                    <button type="submit" class="neu-btn-primary neu-btn btn-block py-3 mt-4">
                        <i class="fas fa-user-plus"></i> S'inscrire
                    </button>

                    <hr style="border-color: var(--shadow-dark); opacity: 0.2;">

                    <div class="text-center">
                        <p class="mb-2 text-muted">Vous avez déjà un compte ?</p>
                        <a href="{{ route('login') }}" class="neu-btn btn-block">
                            <i class="fas fa-sign-in-alt"></i> Se connecter
                        </a>
                    </div>

                    <div class="text-center mt-3">
                        <a href="{{ route('home') }}" class="text-muted">
                            <i class="fas fa-arrow-left"></i> Retour à l'accueil
                        </a>
                    </div>
                </form>

                <!-- Test Data -->
                <div class="neu-card-sm mt-4">
                    <h6 class="mb-3 text-gradient"><i class="fas fa-flask"></i> Mode Test - Remplissage Rapide</h6>
                    <button type="button" class="neu-btn-accent neu-btn btn-block" onclick="fillTestUser()">
                        <i class="fas fa-user-plus"></i> Créer un Utilisateur Test
                    </button>
                    <small class="text-muted d-block mt-2 text-center">
                        Remplit automatiquement le formulaire avec des données de test
                    </small>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script>
        function fillTestUser() {
            const timestamp = Date.now();
            document.getElementById('name').value = 'Test User ' + timestamp;
            document.getElementById('email').value = 'test' + timestamp + '@zute.com';
            document.getElementById('password').value = 'password123';
            document.getElementById('password_confirmation').value = 'password123';
        }
    </script>
</body>
</html>
