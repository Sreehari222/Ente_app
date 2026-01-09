<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Facades\Auth;

class UserMessageController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        /** @var User $user */
        $user = Auth::user();

         $messages = Message::with(['users:id,name,role'])
        ->withCount('users')
        ->latest()
        ->get();

        return view('messages.index', compact('messages','user'));
    }

    /**
     * @param int $id
     * @return Factory|View
     */
    public function show(int $id)
    {
        /** @var User $user */
        $user = Auth::user();

        $message = $user->messages()
            ->with('sender')
            ->where('messages.id', $id)
            ->firstOrFail();

        // Mark pivot as read
        $user->messages()->updateExistingPivot($id, [
            'is_read' => true,
            'read_at' => now(),
        ]);

        // Mark ONLY this message notification as read
        $user->unreadNotifications()
            ->where('data->message_id', $id)
            ->update(['read_at' => now()]);

        return view('user.messages.show', compact('message'));
    }
}
