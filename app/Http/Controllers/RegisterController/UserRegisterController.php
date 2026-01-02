<?php

namespace App\Http\Controllers\RegisterController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserRegisterController extends Controller
{
    public function createDEO()
    {
        $areaOperators = User::where('role', 'area_operator')->get();
        return view('admin.deo_register', compact('areaOperators'));
    }

    public function createSalesman()
    {
        $deos = User::where('role', 'deo')->get();
        return view('admin.salesman_register', compact('deos'));
    }

    public function createAreaOperator()
    {
        return view('admin.area_operator_register');
    }
    public function storeAreaOperator(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'area_operator',
        ]);

        return redirect()->route('admin.area-operators.create')
            ->with('success', 'Area Operator registered successfully');
    }

    /**
     * Store DEO
     */
    public function storeDEO(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'area_operator_id' => 'required|exists:users,id',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'deo',
            'area_operator_id' => $request->area_operator_id,
        ]);

        return redirect()->route('admin.deos.create')
            ->with('success', 'DEO registered successfully');
    }

    /**
     * Store Salesman
     */
    public function storeSalesman(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'deo_id' => 'required|exists:users,id',
        ]);

        // Get DEO's Area Operator ID
        $deo = User::findOrFail($request->deo_id);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'salesman',
            'deo_id' => $deo->id,
            'area_operator_id' => $deo->area_operator_id,
        ]);

        return redirect()->route('admin.salesmen.create')
            ->with('success', 'Salesman registered successfully');
    }
}
