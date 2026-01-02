<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function vendors()
    {
        $entries = Entry::where('is_verified', false)
            ->latest()
            ->get();

        return view('admin.verifications.vendors', compact('entries'));
    }

    /**
     * Approve vendor entry
     */
    public function approve($id)
    {
        $entry = Entry::findOrFail($id);

        $entry->update([
            'is_verified' => true,
            'verified_by' => auth()->id(),
            'verified_at' => now(),
        ]);

        return back()->with('success', 'Vendor verified successfully');
    }

    /**
     * Reject vendor entry
     */
    public function reject($id)
    {
        Entry::findOrFail($id)->delete();

        return back()->with('success', 'Vendor rejected and removed');
    }
}
