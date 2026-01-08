<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()
            ->route('admin.users')
            ->with('success', 'User deleted successfully');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        $areaOperators = User::where('role', 'area_operator')->get();
        $deos = User::where('role', 'deo')->get();

        return view('admin.users.edit', compact(
            'user',
            'areaOperators',
            'deos'
        ));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'email'             => [
                'required',
                'email',
                Rule::unique('users')->ignore($user->id),
            ],
            'role'              => 'required|in:admin,area_operator,deo,salesman,user',
            'area_operator_id'  => 'nullable|exists:users,id',
            'deo_id'            => 'nullable|exists:users,id',
            'email_verified_at' => 'nullable|date',
        ]);

        /**
         * Business Rules
         */
        if ($validated['role'] !== 'salesman') {
            $validated['area_operator_id'] = null;
            $validated['deo_id'] = null;
        }

        if ($validated['role'] === 'deo') {
            $validated['area_operator_id'] = null;
        }

        /**
         * Handle Email Verification
         */
        if ($request->email_verified_at) {
            $validated['email_verified_at'] = now();
        } else {
            $validated['email_verified_at'] = null;
        }

        /**
         * Update User
         */
        $user->update($validated);

        return redirect()
            ->route('admin.area-operators')
            ->with('success', 'User updated successfully.');
    }
}
