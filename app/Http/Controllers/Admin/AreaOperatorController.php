<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AreaOperatorController extends Controller
{
    /**
     * Display a listing of Area Operators
     */
    public function index(Request $request)
    {
        $operators = User::where('role', 'area_operator')
            // Load DEO count
            ->withCount(['deos' => function ($query) {
                $query->where('role', 'deo');
            }])
            // Search by name or email
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($qq) use ($request) {
                    $qq->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('email', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(12);

        return view('admin.area_operator.index', compact('operators'));
    }


    /**
     * Show the details of a single Area Operator
     */
    public function show($id)
    {
        $operator = User::where('role', 'area_operator')->findOrFail($id);

        return view('admin.area-operators.show', compact('operator'));
    }

    /**
     * Show the edit form
     */
    public function edit($id)
    {
        $operator = User::where('role', 'area_operator')->findOrFail($id);

        return view('admin.area-operators.edit', compact('operator'));
    }

    /**
     * Update Area Operator
     */
    public function update(Request $request, $id)
    {
        $operator = User::where('role', 'area_operator')->findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $operator->id,
        ]);

        $operator->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.area-operators.index')
            ->with('success', 'Area Operator updated successfully.');
    }

    /**
     * Remove Area Operator
     */
    public function destroy($id)
    {
        $operator = User::where('role', 'area_operator')->findOrFail($id);
        $operator->delete();

        return redirect()
            ->route('admin.area-operators.index')
            ->with('success', 'Area Operator removed successfully.');
    }
}
