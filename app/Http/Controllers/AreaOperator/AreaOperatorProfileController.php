<?php

namespace App\Http\Controllers\AreaOperator;

use App\Http\Controllers\Controller;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AreaOperatorProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $submissions = Submission::where('user_id', $user->id)->latest()->get();
        return view('area_operator.profile.index', compact('user', 'submissions'));
    }
public function update(Request $request, \App\Models\User $user)
{
    // Now $user is the user from the route, e.g. /area/profile/5
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        'phone_number' => 'nullable|string|max:20',
        'address' => 'nullable|string|max:255',
        'account_number' => 'nullable|string|max:50',
        'ifsc_code' => 'nullable|string|max:20',
        'profile_photo' => 'nullable|image|max:2048',
        'cover_photo' => 'nullable|image|max:4096',
    ]);

    $user->update($request->only([
        'name', 'email', 'phone_number', 'address', 'account_number', 'ifsc_code'
    ]));

    // Upload files as before
    if ($request->hasFile('profile_photo')) {
        if ($user->profile_photo) Storage::disk('public')->delete($user->profile_photo);
        $user->profile_photo = $request->file('profile_photo')->store('profiles', 'public');
    }

    if ($request->hasFile('cover_photo')) {
        if ($user->cover_photo) Storage::disk('public')->delete($user->cover_photo);
        $user->cover_photo = $request->file('cover_photo')->store('covers', 'public');
    }

    $user->save();

    return redirect()->route('area.profile.index')->with('success', 'Profile updated successfully');
}


}

