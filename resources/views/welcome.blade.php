<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Gestion d\'Absence') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <!-- Styles -->
        <style>
            body {
                font-family: 'Figtree', sans-serif;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f3f4f6;
            }
            .container {
                text-align: center;
            }
            .title {
                font-size: 2rem;
                font-weight: 600;
                margin-bottom: 1rem;
            }
            .links > a {
                color: #4b5563;
                padding: 0 25px;
                font-size: 1rem;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="title">
                Bienvenue sur la {{ config('app.name', 'Gestion d\'Absence') }}
            </div>

            <div class="links">
                @auth
                    <a href="{{ url('/home') }}">Tableau de bord</a>
                @else
                    <a href="{{ route('login') }}">Se connecter</a>
                @endauth
            </div>
        </div>
    </body>
</html>