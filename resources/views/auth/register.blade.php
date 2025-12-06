<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Inscription - Ets Modeste</title>
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/tshirt.css')}}" rel="stylesheet">
    <script defer src="https://use.fontawesome.com/releases/v5.0.9/js/all.js"></script>
    <style>
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #075e7f 0%, #0a7ba0 100%);
            padding: 40px 0;
        }
        .auth-card {
            max-width: 500px;
            width: 100%;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.2);
            padding: 40px;
        }
        .auth-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .auth-logo i {
            font-size: 60px;
            color: #075e7f;
        }
        .auth-logo h2 {
            margin-top: 15px;
            color: #075e7f;
            font-weight: bold;
        }
        .btn-auth {
            background: #075e7f;
            color: white;
            padding: 12px;
            border: none;
            font-weight: bold;
        }
        .btn-auth:hover {
            background: #0a7ba0;
            color: white;
        }
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
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
                    <label for="name">Nom complet</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                           id="name" name="name" value="{{ old('name') }}"
                           required autofocus placeholder="Jean Dupont">
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="email" name="email" value="{{ old('email') }}"
                           required placeholder="votre@email.com">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                           id="password" name="password" required placeholder="Minimum 8 caractères">
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Minimum 8 caractères</small>
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirmer le mot de passe</label>
                    <input type="password" class="form-control"
                           id="password_confirmation" name="password_confirmation"
                           required placeholder="Retapez votre mot de passe">
                </div>

                <button type="submit" class="btn btn-auth btn-block btn-lg mt-4">
                    <i class="fas fa-user-plus"></i> S'inscrire
                </button>

                <hr>

                <div class="text-center">
                    <p class="mb-2">Vous avez déjà un compte ?</p>
                    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-block">
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
            <div class="mt-4 p-3" style="background: #f8f9fa; border-radius: 10px; border-left: 4px solid #ffc107;">
                <h6 class="mb-3"><i class="fas fa-flask"></i> Mode Test - Remplissage Rapide</h6>
                <button type="button" class="btn btn-sm btn-success btn-block" onclick="fillTestUser()">
                    <i class="fas fa-user-plus"></i> Créer un Utilisateur Test
                </button>
                <small class="text-muted d-block mt-2 text-center">
                    Remplit automatiquement le formulaire avec des données de test
                </small>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
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
