<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AreaOperatorSalesmanController extends Controller
{
    public function index()
    {
        $salesmen = User::where('role', 'salesman')
            ->where('area_operator_id', Auth::id())
            ->latest()
            ->get();

        return view('area_operator.salesmen.index', compact('salesmen'));
    }

    public function show(User $salesman)
    {
        if ($salesman->role !== 'salesman' || $salesman->area_operator_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('area_operator.salesmen.show', compact('salesman'));
    }

    public function edit(User $salesman)
    {
        User::where('id', 12)->update(['area_operator_id' => Auth::id()]);
        return view('area_operator.salesmen.edit', compact('salesman'));
    }

public function update(Request $request, User $salesman)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $salesman->id,
        'phone_number' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
    ]);

    $salesman->update($request->only('name','email','phone_number','address'));

    return redirect()->route('area.salesmen.show', ['salesman' => $salesman->id])
                     ->with('success', 'Salesman updated successfully!');
}

}
