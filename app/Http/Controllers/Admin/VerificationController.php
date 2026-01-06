<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\VerificationRequest;
use App\Models\User;
use App\Models\Vendor;

class VerificationController extends Controller
{
    /**
     * Show verification requests
     */
    public function index()
    {
        $vendors = Vendor::where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.verifications.index', compact('vendors'));
    }

    /**
     * Approve request
     */
    public function approve($id)
    {
        $vendor = Vendor::findOrFail($id);

        if ($vendor->status !== 'pending') {
            return redirect()->back()->with('error', 'Vendor already processed.');
        }

        $vendor->status = 'approved';
        $vendor->approved_at = now();
        $vendor->save();

        return redirect()->back()->with('success', 'Vendor approved successfully.');
    }

    /**
     * Reject request
     */
    public function reject($id)
    {
        $vendor = Vendor::findOrFail($id);

        if ($vendor->status !== 'pending') {
            return redirect()->back()->with('error', 'Vendor already processed.');
        }

        $vendor->status = 'rejected';
        $vendor->approved_at = now(); // optional
        $vendor->save();

        return redirect()->back()->with('success', 'Vendor rejected successfully.');
    }
    public function show($id)
    {
        $vendor = Vendor::with([
            'mainCategory',
            'category',
            'plan'
        ])->findOrFail($id);

        return view('admin.verifications.show', compact('vendor'));
    }
}
