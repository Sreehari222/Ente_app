<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BlockedUserController extends Controller
{
    public function index()
    {
        $users = User::where('is_blocked', true)
            ->latest()
            ->paginate(20);

        return view('admin.blocked.index', compact('users'));
    }

    /**
     * Unblock user
     */
    public function unblock($id)
    {
        User::findOrFail($id)->update([
            'is_blocked' => false
        ]);

        return back()->with('success', 'User unblocked');
    }
}
