<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
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
    public function update(Request $request, User $salesman)
    {
        abort_if($salesman->role !== 'salesman', 404);

        $request->validate([
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $salesman->id,
            'deo_id' => 'required|exists:users,id',
            'password' => 'nullable|min:6',
        ]);

        $deo = User::findOrFail($request->deo_id);

        $salesman->update([
            'name' => $request->name,
            'email' => $request->email,
            'deo_id' => $deo->id,
            'area_operator_id' => $deo->area_operator_id,
        ]);

        if ($request->filled('password')) {
            $salesman->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()
            ->route('admin.salesmen.index')
            ->with('success', 'Salesman updated successfully');
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
}
