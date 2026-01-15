<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SalesmanController extends Controller
{
    /**
     * List all Salesmen
     */
    public function index()
    {
        $salesmen = User::where('role', 'salesman')
            ->with(['deo', 'areaOperator'])
            ->latest()
            ->get();

        return view('admin.salesmen.index', compact('salesmen'));
    }

    /**
     * Show single Salesman
     */
    public function show(User $salesman)
    {
        abort_if($salesman->role !== 'salesman', 404);

        return view('admin.salesmen.show', compact('salesman'));
    }

    /**
     * Edit Salesman
     */
    public function edit(User $salesman)
    {
        abort_if($salesman->role !== 'salesman', 404);

        $deos = User::where('role', 'deo')->get();

        return view('admin.salesmen.edit', compact('salesman', 'deos'));
    }

    /**
     * Update Salesman
     */
    public function update(Request $request, $id)
    {
      
        $salesman = User::where('role', 'salesman')
            ->where('deo_id', Auth::id())
            ->findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'email'          => 'required|email|unique:users,email,' . $salesman->id,
            'phone_number'   => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:255',
            'account_number' => 'nullable|string|max:50',
            'ifsc_code'      => 'nullable|string|max:20',
        ]);

        $salesman->update([
            'name'           => $request->name,
            'email'          => $request->email,
            'phone_number'   => $request->phone_number,
            'address'        => $request->address,
            'account_number' => $request->account_number,
            'ifsc_code'      => $request->ifsc_code,
        ]);

        return redirect()
            ->route('salesmen.index')
            ->with('success', 'Salesman updated successfully.');
    }

    /**
     * Delete Salesman
     */
    public function destroy(User $salesman)
    {
        abort_if($salesman->role !== 'salesman', 404);

        $salesman->delete();

        return redirect()
            ->route('admin.salesmen.index')
            ->with('success', 'Salesman deleted successfully');
    }

    public function performance()
    {
        $salesmen = User::where('role', 'salesman')
            ->withCount([
                'vendors',
                'vendors as approved_vendors_count' => function ($q) {
                    $q->where('status', 'approved');
                },
                'submissions'
            ])
            ->get();

        return view('deo.performance.index', compact('salesmen'));
    }
}
