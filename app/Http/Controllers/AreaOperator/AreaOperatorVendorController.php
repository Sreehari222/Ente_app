<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Plan;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaOperatorVendorController extends Controller
{
    public function index()
    {
        $areaOperatorId = Auth::id();

        $deoIds = User::where('role', 'deo')
            ->where('area_operator_id', $areaOperatorId)
            ->pluck('id');

        $salesmanIds = User::where('role', 'salesman')
            ->whereIn('deo_id', $deoIds)
            ->pluck('id');

        $vendors = Vendor::whereIn('created_by', $salesmanIds)
            ->latest()
            ->get();

        return view('area_operator.vendors.index', compact('vendors'));
    }
    public function edit($id)
    {
        $vendor = Vendor::findOrFail($id);

        $mainCategories = Category::whereNull('parent_id')->get();

        $subCategories = Category::where('parent_id', $vendor->main_category_id)->get();

        $plans = Plan::all();

        return view('area_operator.vendors.edit', compact(
            'vendor',
            'mainCategories',
            'subCategories',
            'plans'
        ));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name'        => 'required|string|max:255',
            'owner_name'       => 'nullable|string|max:255',
            'mobile'           => 'required|string|max:20',
            'email'            => 'nullable|email|max:255',
            'service_area'     => 'nullable|string|max:255',
            'main_category_id' => 'required|exists:categories,id',
            'category_id'      => 'required|exists:categories,id',
            'plan_id'          => 'required|exists:plans,id',
        ]);

        $vendor = Vendor::findOrFail($id);

        $vendor->update($request->only([
            'shop_name',
            'owner_name',
            'mobile',
            'email',
            'service_area',
            'main_category_id',
            'category_id',
            'plan_id',
        ]));

        return redirect()
            ->route('area.vendors.show', $vendor->id)
            ->with('success', 'Vendor updated successfully.');
    }

    public function show(Vendor $vendor)
    {
        $areaOperatorId = Auth::id();

        $deoIds = User::where('role', 'deo')
            ->where('area_operator_id', $areaOperatorId)
            ->pluck('id');

        $salesmanIds = User::where('role', 'salesman')
            ->whereIn('deo_id', $deoIds)
            ->pluck('id');

        if (! in_array($vendor->created_by, $salesmanIds->toArray())) {
            abort(403, 'Unauthorized access to vendor');
        }

        $vendor->load('salesman');

        return view('area_operator.vendors.show', compact('vendor'));
    }
}
