<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $roleFilter = $request->get('role');

        // Fetch users, optionally filtered by role
        $users = User::when($roleFilter, function($q) use ($roleFilter) {
                $q->where('role', $roleFilter);
            })
            ->orderBy('name')
            ->get();

        // Add last login / logout to each user
        $users->map(function($user) {
            $user->last_login_at = UserActivityLog::where('user_id', $user->id)
                                        ->where('action', 'login')
                                        ->latest('created_at')
                                        ->value('created_at');

            $user->last_logout_at = UserActivityLog::where('user_id', $user->id)
                                        ->where('action', 'logout')
                                        ->latest('created_at')
                                        ->value('created_at');

            return $user;
        });

        // Stats
        $totalUsers = User::count();

        $weeklyLogins = UserActivityLog::where('action', 'login')
            ->whereBetween('created_at', [
                Carbon::now()->startOfWeek(),
                Carbon::now()->endOfWeek()
            ])
            ->count();

        $monthlyLogins = UserActivityLog::where('action', 'login')
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        // Last 50 activities
        $activities = UserActivityLog::with('user')
            ->latest()
            ->limit(50)
            ->get();

        // Role-wise user count for chart
        $roleCounts = User::select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total','role'); // key=role, value=count

        $roles = $roleCounts->keys(); // ['admin','deo','salesman',...]
        $roleCounts = $roleCounts->values(); // [5,12,8,...]

        return view('admin.reports.index', compact(
            'users',
            'totalUsers',
            'weeklyLogins',
            'monthlyLogins',
            'activities',
            'roles',
            'roleCounts',
            'roleFilter'
        ));
    }
}
