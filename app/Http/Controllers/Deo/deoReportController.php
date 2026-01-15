<?php

namespace App\Http\Controllers\deo;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class deoReportController extends Controller
{
    public function monthly(Request $request)
    {
        $deoId = Auth::id();

        // Get all salesmen under this DEO
        $salesmen = User::where('role', 'salesman')
                        ->where('deo_id', $deoId)
                        ->with(['vendors' => function($query) {
                            $query->whereNotNull('id'); // all vendors, you can filter by month if needed
                        }])
                        ->get();

        // Prepare salesman-wise vendor totals
        $salesmanReports = $salesmen->map(function ($salesman) {
            $totalVendors = $salesman->vendors->count();
            $totalCash = $salesman->vendors->sum('total_amount');

            return [
                'salesman' => $salesman,
                'total_vendors' => $totalVendors,
                'total_cash' => $totalCash,
                'vendors' => $salesman->vendors
            ];
        });

        // Category-wise report
        $categoryReports = Vendor::whereIn('created_by', $salesmen->pluck('id'))
                                ->selectRaw('main_category_id, category_id, COUNT(*) as vendor_count, SUM(total_amount) as total_cash')
                                ->groupBy('main_category_id', 'category_id')
                                ->with(['mainCategory', 'category'])
                                ->get();

        return view('deo.reports.report', compact('salesmanReports', 'categoryReports'));
    }
}
