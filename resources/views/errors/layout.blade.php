<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Ets Modeste</title>
    <link rel="icon" href="{{ asset('img/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        :root {
            --primary-color: #667eea;
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --bg-color: #e0e5ec;
            --text-dark: #2c3e50;
            --text-muted: #7f8c8d;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: var(--bg-color);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .error-container {
            text-align: center;
            max-width: 600px;
            width: 100%;
        }

        .error-card {
            background: var(--bg-color);
            border-radius: 30px;
            padding: 50px 40px;
            box-shadow: 20px 20px 60px #bec3c9, -20px -20px 60px #ffffff;
        }

        .error-icon {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 50px;
            margin-bottom: 30px;
            box-shadow: inset 8px 8px 16px #bec3c9, inset -8px -8px 16px #ffffff;
        }

        .error-icon.warning {
            color: #f39c12;
        }

        .error-icon.danger {
            color: #e74c3c;
        }

        .error-icon.info {
            color: #3498db;
        }

        .error-icon.purple {
            color: #667eea;
        }

        .error-code {
            font-size: 80px;
            font-weight: 700;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            line-height: 1;
            margin-bottom: 15px;
        }

        .error-title {
            font-size: 24px;
            font-weight: 600;
            color: var(--text-dark);
            margin-bottom: 15px;
        }

        .error-message {
            font-size: 16px;
            color: var(--text-muted);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .error-actions {
            display: flex;
            gap: 15px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: 15px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            border: none;
        }

        .btn-primary {
            background: var(--primary-gradient);
            color: white;
            box-shadow: 5px 5px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 8px 8px 20px rgba(102, 126, 234, 0.5);
        }

        .btn-secondary {
            background: var(--bg-color);
            color: var(--text-dark);
            box-shadow: 5px 5px 15px #bec3c9, -5px -5px 15px #ffffff;
        }

        .btn-secondary:hover {
            box-shadow: inset 3px 3px 6px #bec3c9, inset -3px -3px 6px #ffffff;
        }

        .error-details {
            margin-top: 30px;
            padding-top: 30px;
            border-top: 1px solid #d0d5dc;
        }

        .error-details p {
            font-size: 13px;
            color: var(--text-muted);
        }

        .error-details a {
            color: var(--primary-color);
            text-decoration: none;
        }

        .error-details a:hover {
            text-decoration: underline;
        }

        /* Animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .error-icon {
            animation: float 3s ease-in-out infinite;
        }

        /* Responsive */
        @media (max-width: 576px) {
            .error-card {
                padding: 40px 25px;
            }

            .error-code {
                font-size: 60px;
            }

            .error-title {
                font-size: 20px;
            }

            .error-icon {
                width: 100px;
                height: 100px;
                font-size: 40px;
            }

            .error-actions {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <div class="error-card">
            @yield('content')
        </div>
    </div>
</body>
</html>
