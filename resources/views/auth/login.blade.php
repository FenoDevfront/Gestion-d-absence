@extends('layouts.app_blank') {{-- Using a blank layout for the login page --}}

@section('content')
<style>
    .login-wrapper {
        display: flex;
        min-height: 100vh;
        width: 100%;
    }
    .login-branding {
        width: 50%;
        background: linear-gradient(45deg, #4e73df, #1cc88a);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        padding: 2rem;
        text-align: center;
    }
    .login-branding h1 {
        font-size: 3rem;
        font-weight: 700;
    }
    .login-form-wrapper {
        width: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #f8f9fa;
    }
    .login-card {
        width: 100%;
        max-width: 400px;
        padding: 2.5rem;
        text-align: center;
        border: none;
        box-shadow: none;
        background: transparent;
    }
    .login-card .card-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        font-size: 1.75rem;
        color: #333;
    }
    .login-card .text-muted {
        margin-bottom: 2rem;
    }
    .btn-google {
        background-color: #4285F4;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        transition: background-color 0.2s;
        border-radius: 0.5rem;
        box-shadow: 0 4px 14px 0 rgba(0, 118, 255, 0.39);
    }
    .btn-google:hover {
        background-color: #357ae8;
        color: white;
    }
    .btn-google i {
        margin-right: 10px;
        font-size: 1.2rem;
    }

    @media (max-width: 768px) {
        .login-branding {
            display: none;
        }
        .login-form-wrapper {
            width: 100%;
        }
    }
</style>

<div class="login-wrapper">
    <div class="login-branding">
        <h1>{{ config('app.name', 'Laravel') }}</h1>
        <p>Simplifiez la gestion de vos absences.</p>
    </div>
    <div class="login-form-wrapper">
        <div class="login-card">
            <div class="card-body">
                <h2 class="card-title">Bienvenue</h2>
                <p class="text-muted">Connectez-vous pour accéder à votre espace</p>
                <a href="{{ route('auth.google') }}" class="btn btn-google">
                    <i class="bi bi-google"></i> Se connecter avec Google
                </a>
            </div>
        </div>
    </div>
</div>
@endsection