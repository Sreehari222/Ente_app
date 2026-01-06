<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function logout(Request $request)
    {
        $role = auth()->user()->role;

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return match ($role) {
            'salesman' => redirect('/salesman/login'),
            'deo'      => redirect('/deo/login'),
            default    => redirect('/login'),
        };
    }
}
