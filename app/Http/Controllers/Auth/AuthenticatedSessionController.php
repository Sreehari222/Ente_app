<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\UserActivityLog;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        $user = Auth::user();

        // ✅ Update last login time (NO Intelephense warning)
        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        // ✅ Log LOGIN activity
        UserActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'login',
            'ip_address' => $request->ip(),
        ]);

        return match ($user->role) {
            'admin'         => redirect()->intended('/admin/dashboard'),
            'area_operator' => redirect()->intended('/area/dashboard'),
            'deo'           => redirect()->intended('/deo/dashboard'),
            'salesman'      => redirect()->intended('/salesman/dashboard'),
            default         => redirect()->intended('/user/dashboard'),
        };
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $user = Auth::user();

        if ($user) {
            // ✅ Update last logout time
            $user->forceFill([
                'last_logout_at' => now(),
            ])->save();

            // ✅ Log LOGOUT activity
            UserActivityLog::create([
                'user_id'    => $user->id,
                'action'     => 'logout',
                'ip_address' => $request->ip(),
            ]);
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
