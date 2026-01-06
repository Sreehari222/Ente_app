<?php

namespace App\Http\Controllers\Deo;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SalesmanlistController extends Controller
{
    public function index()
    {
        $salesmen = User::where('role', 'salesman')
            ->where('deo_id', Auth::id())
            ->get();

        return view('deo.salesman.index', compact('salesmen'));
    }

    public function show($id)
    {
        $salesman = User::where('id', $id)
            ->where('role', 'salesman')
            ->where('deo_id', auth()->id())
            ->firstOrFail();

        return view('deo.salesman.show', compact('salesman'));
    }

    public function edit($id)
    {
        $salesman = User::where('id', $id)
            ->where('role', 'salesman')
            ->where('deo_id', auth()->id())
            ->firstOrFail();

        return view('deo.salesmen.edit', compact('salesman'));
    }

    public function update(\Illuminate\Http\Request $request, $id)
    {
        $salesman = User::where('id', $id)
            ->where('role', 'salesman')
            ->where('deo_id', auth()->id())
            ->firstOrFail();

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $salesman->id,
        ]);

        $salesman->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('deo.salesmen.index')
            ->with('success', 'Salesman updated successfully');
    }

    public function destroy($id)
    {
        $salesman = User::where('id', $id)
            ->where('role', 'salesman')
            ->where('deo_id', auth()->id()) // IMPORTANT security
            ->firstOrFail();

        $salesman->delete();

        return redirect()
            ->route('deo.salesmen.index')
            ->with('success', 'Salesman deleted successfully');
    }
}
