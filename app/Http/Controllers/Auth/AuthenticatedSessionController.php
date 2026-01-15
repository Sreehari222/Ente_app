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

        // Update last login time
        $user->forceFill([
            'last_login_at' => now(),
        ])->save();

        // Log login activity
        UserActivityLog::create([
            'user_id'    => $user->id,
            'action'     => 'login',
            'ip_address' => $request->ip(),
        ]);

        return match ($user->role) {
            'admin'         => redirect()->route('admin.dashboard'),
            'area_operator' => redirect()->route('area.dashboard'),
            'deo'           => redirect()->route('deo.dashboard'),
            'salesman'      => redirect()->route('salesman.dashboard'),
            'vendor'        => redirect()->route('vendor.dashboard'),
            default         => redirect()->route('login'),
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
