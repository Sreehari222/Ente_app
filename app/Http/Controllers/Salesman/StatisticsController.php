<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{

    public function index(Request $request)
    {
        $salesmanId = Auth::id(); // assuming vendors have created_by = salesman id

        // ================== FILTER PERIOD ==================
        $period = $request->get('period', 'daily'); // daily/weekly/monthly/yearly

        $start = match($period) {
            'weekly' => Carbon::now()->startOfWeek(),
            'monthly' => Carbon::now()->startOfMonth(),
            'yearly' => Carbon::now()->startOfYear(),
            default => Carbon::now()->startOfDay(), // daily
        };

        // ================== VENDOR STATUS ==================
        $approvedVendors = Vendor::where('created_by', $salesmanId)->where('status','approved')->count();
        $pendingVendors  = Vendor::where('created_by', $salesmanId)->where('status','pending')->count();
        $rejectedVendors = Vendor::where('created_by', $salesmanId)->where('status','rejected')->count();

        // ================== VENDORS ADDED PER DAY ==================
        $vendorsAdded = Vendor::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('count(*) as total')
            )
            ->where('created_by', $salesmanId)
            ->where('created_at', '>=', $start)
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->get();

        $totalAmountCollected = Vendor::where('created_by', $salesmanId)->sum('total_amount');
        $totalVendors = Vendor::where('created_by', $salesmanId)->count();
        $vendorsAddedLabels = $vendorsAdded->pluck('date')->map(fn($d) => \Carbon\Carbon::parse($d)->format('Y-m-d'));
        $vendorsAddedData = $vendorsAdded->pluck('total');

        // ================== TOP CATEGORIES ==================
        $topCategories = Vendor::select('category_id', DB::raw('count(*) as total'))
            ->where('created_by', $salesmanId)
            ->groupBy('category_id')
            ->get();

        $topCategoriesLabels = $topCategories->map(function($c) {
            return optional($c->category)->name ?? 'Unknown';
        });

        $topCategoriesData = $topCategories->pluck('total');

        return view('salesman.statistics.index', compact(
            'approvedVendors',
            'pendingVendors',
            'rejectedVendors',
            'vendorsAddedLabels',
            'vendorsAddedData',
            'topCategoriesLabels',
            'topCategoriesData',
            'totalAmountCollected',
            'totalVendors'
        ));
    }
}
