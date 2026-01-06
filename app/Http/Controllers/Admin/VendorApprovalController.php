<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;

class VendorApprovalController extends Controller
{
    public function index()
    {
        $vendors = Vendor::where('status', 'pending')->latest()->get();
        return view('admin.vendors.pending', compact('vendors'));
    }

    public function approve(Vendor $vendor)
    {
        $vendor->update([
            'status' => 'approved',
            'approved_at' => now()
        ]);

        return back()->with('success', 'Vendor approved successfully');
    }

    public function reject(Vendor $vendor)
    {
        $vendor->update(['status' => 'rejected']);
        return back()->with('success', 'Vendor rejected');
    }
}
