<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion Google</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex align-items-center justify-content-center vh-100 bg-light">
    <div class="text-center">
        <h1 class="mb-4">Se connecter</h1>
        <p>Accédez à la plateforme en vous connectant avec votre compte Google :</p>
        <a href="{{ url('/auth/google') }}" class="btn btn-danger btn-lg">
            🔐 Connexion avec Google
        </a>
    </div>
</body>
</html>
