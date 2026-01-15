<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AreaOperatorDEOController extends Controller
{
   public function index()
    {
        $deos = User::where('role', 'deo')
                    ->where('area_operator_id', auth()->id())
                    ->get();

        return view('area_operator.deos.index', compact('deos'));
    }

    // Show create DEO form
    public function create()
    {
        return view('area_operator.deos.create');
    }

    // Store a new DEO
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone_number' => 'nullable|string|max:15',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number,
            'role' => 'deo',
            'area_operator_id' => auth()->id(),
        ]);

        return redirect()->route('area_operator.deos.index')
                         ->with('success', 'DEO created successfully.');
    }

    // Show edit form for a DEO
    public function edit($id)
    {
        $deo = User::where('role', 'deo')
                    ->where('area_operator_id', auth()->id())
                    ->findOrFail($id);

        return view('area_operator.deos.edit', compact('deo'));
    }

    // Update DEO
    public function update(Request $request, $id)
    {
        $deo = User::where('role', 'deo')
                    ->where('area_operator_id', auth()->id())
                    ->findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $deo->id,
            'password' => 'nullable|string|min:6|confirmed',
            'phone_number' => 'nullable|string|max:15',
        ]);

        $deo->name = $request->name;
        $deo->email = $request->email;
        $deo->phone_number = $request->phone_number;

        if ($request->filled('password')) {
            $deo->password = Hash::make($request->password);
        }

        $deo->save();

        return redirect()->route('area_operator.deos.index')
                         ->with('success', 'DEO updated successfully.');
    }

    public function show(User $deo)
    {
        abort_if(
            $deo->role !== 'deo' ||
            $deo->area_operator_id !== Auth::id(),
            403
        );

        return view('area_operator.deos.show', compact('deo'));
    }

    // Delete DEO
    public function destroy($id)
    {
        $deo = User::where('role', 'deo')
                    ->where('area_operator_id', auth()->id())
                    ->findOrFail($id);

        $deo->delete();

        return redirect()->route('area_operator.deos.index')
                         ->with('success', 'DEO deleted successfully.');
    }
}
