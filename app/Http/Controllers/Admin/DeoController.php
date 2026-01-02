<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DeoController extends Controller
{
    public function index()
    {
        $deos = User::where('role', 'deo')
            ->with('areaOperator')
            ->withCount('salesmen')
            ->latest()
            ->get();

        return view('admin.deos.index', compact('deos'));
    }
    public function show(User $deo)
    {
        abort_if($deo->role !== 'deo', 404);

        $salesmen = User::where('role', 'salesman')
            ->where('deo_id', $deo->id)
            ->get();

        return view('admin.deos.show', compact('deo', 'salesmen'));
    }

    /**
     * Edit DEO
     */
    public function edit(User $deo)
    {
        abort_if($deo->role !== 'deo', 404);

        $areaOperators = User::where('role', 'area_operator')->get();

        return view('admin.deos.edit', compact('deo', 'areaOperators'));
    }

    /**
     * Update DEO
     */
    public function update(Request $request, User $deo)
    {
        abort_if($deo->role !== 'deo', 404);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $deo->id,
            'area_operator_id' => 'required|exists:users,id',
            'password' => 'nullable|min:6',
        ]);

        $deo->update([
            'name' => $request->name,
            'email' => $request->email,
            'area_operator_id' => $request->area_operator_id,
        ]);

        // Update password only if provided
        if ($request->filled('password')) {
            $deo->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update Area Operator ID for salesmen under this DEO
        User::where('deo_id', $deo->id)
            ->update(['area_operator_id' => $request->area_operator_id]);

        return redirect()
            ->route('admin.deos.index')
            ->with('success', 'DEO updated successfully');
    }

    /**
     * Delete DEO
     */
    public function destroy(User $deo)
    {
        abort_if($deo->role !== 'deo', 404);

        // Optional: prevent delete if salesmen exist
        if ($deo->salesmen()->count() > 0) {
            return back()->with('error', 'Cannot delete DEO with assigned salesmen');
        }

        $deo->delete();

        return redirect()
            ->route('admin.deos.index')
            ->with('success', 'DEO deleted successfully');
    }
}
