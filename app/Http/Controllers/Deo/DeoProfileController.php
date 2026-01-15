<?php

namespace App\Http\Controllers\deo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeoProfileController extends Controller
{
    public function index()
    {
        $deo = auth()->user();
        return view('deo.profile.index', compact('deo'));
    }
    public function update(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name'            => 'required|string|max:255',
            'email'           => 'required|email|max:255|unique:users,email,' . $user->id,

            'phone_number'    => 'nullable|string|max:20',
            'address'         => 'nullable|string|max:500',

            'account_number'  => 'nullable|string|max:30',
            'ifsc_code'       => 'nullable|string|max:20',

            'password'        => 'nullable|min:6|confirmed',

            'profile_photo'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'cover_photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:4096',
        ]);

        /**
         * Update basic fields
         */
        $user->name           = $validated['name'];
        $user->email          = $validated['email'];
        $user->phone_number   = $validated['phone_number'] ?? null;
        $user->address        = $validated['address'] ?? null;
        $user->account_number = $validated['account_number'] ?? null;
        $user->ifsc_code      = $validated['ifsc_code'] ?? null;


        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }


        if ($request->hasFile('profile_photo')) {
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            $user->profile_photo = $request->file('profile_photo')
                ->store('profiles', 'public');
        }

        if ($request->hasFile('cover_photo')) {
            if ($user->cover_photo) {
                Storage::disk('public')->delete($user->cover_photo);
            }

            $user->cover_photo = $request->file('cover_photo')
                ->store('covers', 'public');
        }

        $user->save();

        return redirect()
            ->route('deo.profile')
            ->with('success', 'Profile updated successfully.');
    }


    public function edit()
    {
        $deo = Auth::user();
        return view('deo.profile.profile-edit', compact('deo'));
    }
}
