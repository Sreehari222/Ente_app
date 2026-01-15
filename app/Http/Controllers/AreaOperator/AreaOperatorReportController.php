<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AreaOperatorReportController extends Controller
{
   public function index(Request $request)
    {
        $areaOperator = auth()->user();

        $salesmanId = $request->salesman_id;
        $startDate  = $request->start_date;
        $endDate    = $request->end_date;

        $salesmen = User::where('role', 'salesman')
                        ->where('area_operator_id', $areaOperator->id)
                        ->get();

        $vendorQuery = Vendor::whereIn('created_by', $salesmen->pluck('id'));

        if ($salesmanId) {
            $vendorQuery->where('created_by', $salesmanId);
        }

        if ($startDate) {
            $vendorQuery->whereDate('created_at', '>=', Carbon::parse($startDate));
        }

        if ($endDate) {
            $vendorQuery->whereDate('created_at', '<=', Carbon::parse($endDate));
        }

        $vendors = $vendorQuery->get();

        $totalRevenue = Vendor::whereIn('created_by', $salesmen->pluck('id'))->sum('total_amount');

        $salesmanPerformance = $salesmen->map(function ($salesman) use ($vendors) {
            $salesmanVendors = $vendors->where('created_by', $salesman->id);
            return [
                'name' => $salesman->name,
                'vendor_count' => $salesmanVendors->count(),
            ];
        });

        $salesmanRevenue = $salesmen->map(function ($salesman) use ($vendors) {
            $salesmanVendors = $vendors->where('created_by', $salesman->id);
            return [
                'name' => $salesman->name,
                'revenue' => $salesmanVendors->sum('total_amount') ?? 0,
            ];
        });

        return view('area_operator.reports.index', compact(
            'vendors',
            'salesmen',
            'salesmanPerformance',
            'salesmanRevenue',
            'totalRevenue',
            'salesmanId',
            'startDate',
            'endDate'
        ));
    }
}
