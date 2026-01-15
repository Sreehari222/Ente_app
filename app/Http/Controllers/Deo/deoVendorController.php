<?php

namespace App\Http\Controllers\deo;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class deoVendorController extends Controller
{
    public function pending()
    {
        $deoId = auth()->id();

        $salesmenIds = User::where('role', 'salesman')
            ->where('deo_id', $deoId)
            ->pluck('id');

        $vendors = Vendor::whereIn('created_by', $salesmenIds)
            ->where('status', 'pending')
            ->latest()
            ->get();

        return view('deo.vendors.pending', compact('vendors'));
    }

    public function show($id)
    {
        $vendor = Vendor::where('id', $id)
            ->whereHas('salesman', function ($q) {
                $q->where('deo_id', Auth::id());
            })
            ->firstOrFail();

        return view('deo.vendors.show', compact('vendor'));
    }

    // Edit vendor
    public function edit($id)
    {
        $vendor = Vendor::where('id', $id)
            ->whereHas('salesman', function ($q) {
                $q->where('deo_id', Auth::id());
            })
            ->firstOrFail();

        return view('deo.vendors.edit', compact('vendor'));
    }

    // Update vendor
    public function update(Request $request, $id)
{
    $vendor = Vendor::findOrFail($id);

    $request->validate([
        'mobile' => 'required|string|max:20',
        'address' => 'nullable|string|max:255',
        'payment_mode' => 'required|string|max:50',
        'transaction_id' => 'nullable|string|max:100',
        'total_amount' => 'nullable|numeric',
        'reference_number' => 'nullable|string|max:100',
        'whatsapp' => 'nullable|string|max:20',
        'digipin' => 'nullable|string|max:50',
        'google_map' => 'nullable|string|max:255',
        'service_area' => 'nullable|string|max:255',
        'opening_time' => 'nullable',
        'closing_time' => 'nullable',
        'special_recommendation' => 'nullable|string|max:500',
        'internal_comments' => 'nullable|string|max:500',
    ]);

    $vendor->update($request->only([
        'mobile',
        'address',
        'payment_mode',
        'transaction_id',
        'total_amount',
        'reference_number',
        'whatsapp',
        'digipin',
        'google_map',
        'service_area',
        'opening_time',
        'closing_time',
        'special_recommendation',
        'internal_comments',
    ]));

    return redirect()->route('deo.vendors.pending', $vendor->id)
                     ->with('success', 'Vendor updated successfully.');
}

}
