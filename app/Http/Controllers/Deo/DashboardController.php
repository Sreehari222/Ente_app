<?php

namespace App\Http\Controllers\Deo;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $deoId = Auth::id();

        $totalSalesmen = User::where('role', 'salesman')
            ->where('deo_id', $deoId)
            ->count();

        $totalVendors = Vendor::whereIn(
            'created_by',
            User::where('deo_id', $deoId)->pluck('id')
        )->count();

        $pendingVendors = Vendor::where('status', 'pending')
            ->whereIn(
                'created_by',
                User::where('deo_id', $deoId)->pluck('id')
            )->count();

        $approvedVendors = Vendor::where('status', 'approved')
            ->whereIn(
                'created_by',
                User::where('deo_id', $deoId)->pluck('id')
            )->count();

        return view('deo.dashboard', compact(
            'totalSalesmen',
            'totalVendors',
            'pendingVendors',
            'approvedVendors'
        ));
    }
}
