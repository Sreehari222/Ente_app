<?php

namespace App\Http\Controllers\Salesman;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SalesmanMessageController extends Controller
{
    /**
     * Display a list of messages assigned to the logged-in salesman
     */
    public function index()
    {
        /** @var \App\Models\User $salesman */
        $salesman = Auth::user();

        $messages = $salesman->messages()
            ->with('sender')
            ->withCount('users')
            ->latest()
            ->get();

        return view('messages.index', compact('messages'));
    }

    public function create()
    {
        $users = User::whereIn('role', ['admin', 'deo', 'area_operator'])->get();

        return view('messages.create', compact('users'));
    }


    public function show($id)
    {
        /** @var \App\Models\User $salesman */
        $salesman = Auth::user();

    
        // LEFT PANEL messages
        $messages = $salesman->messages()
            ->with('sender', 'users')
            ->withCount('users')
            ->latest()
            ->get();

        // RIGHT PANEL active message
        $activeMessage = $salesman->messages()
            ->with(['sender', 'users', 'replies.sender'])
            ->where('messages.id', $id)
            ->firstOrFail();

        // mark as read
        $salesman->messages()->updateExistingPivot($id, [
            'is_read' => true,
            'read_at' => now(),
        ]);

        // mark notification read
        $salesman->unreadNotifications
            ->where('data.message_id', $id)
            ->each(fn($n) => $n->markAsRead());

        return view('messages.index', compact('messages', 'activeMessage'));
    }

    public function store(Request $request)
    {
        $salesman = Auth::user();

        // 1️⃣ Validate request
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'user_ids' => 'required|array', // IDs of users to send message to
            'user_ids.*' => 'exists:users,id',
        ]);

        // 2️⃣ Create message
        $msg = Message::create([
            'sender_id' => $salesman->id,
            'title' => $data['title'],
            'message' => $data['message'],
        ]);

        // 3️⃣ Attach users to message (many-to-many pivot)
        $msg->users()->attach($data['user_ids'], [
            'is_read' => false,
            'read_at' => null,
        ]);

        // 4️⃣ Optionally, send Laravel notifications
        foreach ($msg->users as $user) {
            $user->notify(new \App\Notifications\NewMessageNotification($msg));
        }

        return redirect()->route('salesman.messages.index')
            ->with('success', 'Message sent successfully!');
    }

    public function reply(Request $request, $id)
    {
        /** @var \App\Models\User $salesman */
        $salesman = Auth::user();

        // 1️⃣ Validate the reply message
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

    // 2️⃣ Fetch the message assigned to this salesman
        /** @var \App\Models\Message $message */
        $message = $salesman->messages()
            ->with('sender')       // Load sender
            ->withCount('users')   // Count recipients
            ->findOrFail($id);     // Fetch by primary key

        // 3️⃣ Create a reply
        $message->replies()->create([
            'sender_id' => $salesman->id,
            'message'   => $request->message,
        ]);

        // 4️⃣ Optional: mark original message as read in pivot table
        $salesman->messages()->updateExistingPivot($id, [
            'is_read' => true,
            'read_at' => now(),
        ]);

        // 5️⃣ Optional: mark related notifications as read
        $salesman->unreadNotifications
            ->where('data.message_id', $id)
            ->each(fn($notification) => $notification->markAsRead());

        // 6️⃣ Redirect back to the chat view
        return redirect()->route('salesman.messages.index', ['message' => $id])
            ->with('success', 'Reply sent successfully!');
    }
}
