@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Tableau de Bord Administrateur') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous êtes connecté en tant qu\'administrateur !') }}

                    <div class="mt-4">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Gérer les utilisateurs</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
