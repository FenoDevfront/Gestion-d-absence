<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - Gestion d'Absence</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .login-container {
            background: #fff;
            padding: 3rem;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 450px;
            width: 100%;
            text-align: center;
        }
        .login-logo {
            max-width: 150px;
            margin-bottom: 1.5rem;
        }
        .google-btn {
            background-color: #4285F4;
            border: none;
            color: white;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 500;
            border-radius: 8px;
            transition: background-color 0.3s;
        }
        .google-btn:hover {
            background-color: #357ae8;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <img src="https://tsarajoro.dev/wp-content/uploads/2024/09/Logo.png" alt="Logo" class="login-logo">
        <h1 class="h3 mb-3 fw-normal">Accès à la plateforme</h1>
        <p class="text-muted mb-4">Veuillez vous connecter avec votre compte Google pour continuer.</p>
        <a href="{{ url('/auth/google') }}" class="btn google-btn">
            <i class="bi bi-google me-2"></i>
            Se connecter avec Google
        </a>
    </div>
</body>
</html>
