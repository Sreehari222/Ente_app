<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->withCount('users')->get();
        return view('admin.messages.index', compact('messages'));
    }

    public function create()
    {
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin.messages.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'message' => 'required',
            'users'   => 'required|array'
        ]);

        $message = Message::create([
            'sender_id' => auth()->id(),
            'title'     => $request->title,
            'message'   => $request->message,
        ]);

        foreach ($request->users as $userId) {
            $user = User::find($userId);
            $message->users()->attach($userId);
            $user->notify(new NewMessageNotification($message));
        }

        return redirect()->route('admin.messages.index')->with('success', 'Message sent');
    }

    public function reply(Request $request, $id)
    {
        /** @var \App\Models\User $admin */
        $admin = Auth::user();

        // ✅ Ensure only admin can reply
        if ($admin->role !== 'admin') {
            abort(403, 'Unauthorized');
        }

        // ✅ Validate reply
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        // ✅ Get message
        $message = Message::with('users')->findOrFail($id);

        // ✅ Create reply
        $reply = $message->replies()->create([
            'sender_id' => $admin->id,
            'message'   => $request->message,
        ]);

        // ✅ Notify all recipients except admin
        foreach ($message->users as $user) {
            if ($user->id !== $admin->id) {
                $user->notify(
                    new \App\Notifications\NewMessageNotification($reply)
                );
            }
        }

        return back()->with('success', 'Reply sent successfully!');
    }
}
