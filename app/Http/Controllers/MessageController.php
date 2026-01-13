<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Show message list + active chat
     */
    public function index(Request $request)
    {
        $userId = auth()->id();

        $messages = Message::whereHas('users', function ($q) use ($userId) {
                $q->where('user_id', $userId);
            })
            ->with(['users', 'replies.sender'])
            ->latest()
            ->get();

        $activeChat = null;

        if ($request->filled('message')) {
            $activeChat = $messages->firstWhere('id', $request->message);

            if ($activeChat) {
                // mark as read
                $activeChat->users()->updateExistingPivot($userId, [
                    'is_read' => 1,
                    'read_at' => now(),
                ]);
            }
        }

        return view(
            auth()->user()->role . '.messages.index',
            compact('messages', 'activeChat')
        );
    }

    /**
     * Create message page
     */
    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->get();

        return view(
            auth()->user()->role . '.messages.create',
            compact('users')
        );
    }

    /**
     * Store new message (start chat)
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'message' => 'required|string',
            'users'   => 'required|array|min:1',
        ]);

        // create chat
        $message = Message::create([
            'sender_id' => auth()->id(),
            'title'     => $request->title,
            'message'   => $request->message,
        ]);

        // attach participants
        $participants = array_unique(
            array_merge($request->users, [auth()->id()])
        );

        foreach ($participants as $userId) {
            $message->users()->attach($userId, [
                'is_read' => $userId == auth()->id() ? 1 : 0,
                'read_at' => $userId == auth()->id() ? now() : null,
            ]);
        }

        return redirect()
            ->route(auth()->user()->role . '.messages.index')
            ->with('success', 'Message sent successfully');
    }

    /**
     * Reply to message
     */
    public function reply(Request $request, Message $message)
    {
        $request->validate([
            'message' => 'required|string',
        ]);

        // save reply
        $message->replies()->create([
            'sender_id' => auth()->id(),
            'message'   => $request->message,
        ]);

        // update read status
        foreach ($message->users as $user) {
            if ($user->id == auth()->id()) {
                $message->users()->updateExistingPivot($user->id, [
                    'is_read' => 1,
                    'read_at' => now(),
                ]);
            } else {
                $message->users()->updateExistingPivot($user->id, [
                    'is_read' => 0,
                    'read_at' => null,
                ]);
            }
        }

        return back();
    }
}
