<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Advertisement;
use App\Models\Offer;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
    {
        $totalUsers = User::count();
        $deo = user::where('role', 'deo')->count();
        $pendingApprovals = Vendor::where('status', 'pending')->count();
        $activeAds = Advertisement::where('status', 'active')->count();
        $activeOffers = Offer::where('status', 'active')->count();
        $areaOperators = user::where('role','area_operator')->count();
        $salesman = user::where('role','salesman')->count();
        $recentVendors = Vendor::with('mainCategory')->latest()->take(5)->get();
        return view('admin.dashboard', compact(
            'totalUsers',
            'deo',
            'pendingApprovals',
            'activeAds',
            'activeOffers',
            'areaOperators',
            'salesman',
            'recentVendors',
        ));
    }

}
