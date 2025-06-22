<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion du Personnel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="https://tsarajoro.dev/wp-content/uploads/2024/09/cropped-Logo-270x270.png" type="image/png">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}" style="width: 20%;"><img src="https://tsarajoro.dev/wp-content/uploads/2024/09/Logo.png" alt="Tsarajoro" style="width: 100%; height: auto;"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
    
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('absences.index') }}">Absences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('conges.index') }}">Congés</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('retards.index') }}">Retards</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('logout') }}" class="btn btn-outline-secondary">Se déconnecter</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @include('flash-message')
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
