<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;

class BlockedUserController extends Controller
{
    public function index()
    {
        // Get all vendors with status rejected
        $blockedVendors = Vendor::where('status', 'rejected')
            ->latest()
            ->paginate(10);

        return view('admin.verifications.blockedusers', compact('blockedVendors'));
    }

    /**
     * Unblock user
     */
    public function approve($id)
    {
        $vendor = Vendor::findOrFail($id);

        if ($vendor->status !== 'rejected') {
            return redirect()->back()->with('error', 'Vendor is not blocked.');
        }

        $vendor->status = 'pending';
        $vendor->save();

        return redirect()->back()->with('success', 'Vendor status set back to pending.');
    }

    public function show($id)
    {
        $vendor = Vendor::with([
            'mainCategory',
            'category',
            'plan',
            'creator'
        ])->findOrFail($id);

        return view('admin.blocked-users.show', compact('vendor'));
    }
}
