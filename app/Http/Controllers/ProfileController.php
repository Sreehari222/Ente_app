<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Submission;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */

    public function show()
    {
        // logged-in admin/user
        $user = Auth::user();

        // get all submissions of the current user
        $submissions = Submission::where('user_id', $user->id)
            ->latest()
            ->get();

        // pass both variables to the view
        return view('admin.profile.show', compact('user', 'submissions'));
    }
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('admin.profile.show')->with('status', 'profile-updated');
    }

    public function changePassword(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        if (!\Illuminate\Support\Facades\Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->password = $request->password; // auto-hashed
        $user->save();

        return redirect()->back()->with('success', 'Password changed successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login'); // redirect to login page
    }

    public function submissions(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'user_id'   => auth()->id(),
            'title'     => $request->title,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Submission uploaded successfully');
    }

    public function removesubmissions(Submission $submission){
    if ($submission->user_id !== auth()->id()) {
        abort(403);
    }

    \Illuminate\Support\Facades\Storage::disk('public')->delete($submission->file_path);

    $submission->delete();

    return back()->with('success', 'Submission deleted successfully.');
    }
}
