<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;
use Exception;

class GoogleController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('google.login');
        }
    
        return view('home');
    }

}
