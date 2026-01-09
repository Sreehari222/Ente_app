<?php

// app/Http/Controllers/ChatController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recommendation;
use App\Models\User;

class RecommendationController extends Controller
{
    public function index()
    {
        return view('sales.recommendation'); 

        // Recommendations RECEIVED by current user
        $receivedMessages = Recommendation::with('user')
            ->where('to_id', Auth::id())
            ->latest()
            ->get();

        // Recommendations SENT by current user
        $sentMessages = Recommendation::with('toUser')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        // Users list (exclude current user)
        $users = User::whereIn('role', ['deo', 'area_operator', 'admin'])
            ->where('id', '!=', Auth::id())
            ->get();

        return view(
            'sales.recommendation',
            compact('receivedMessages', 'sentMessages', 'users')
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'to_id' => 'required|exists:users,id',
            'description' => 'required|string|max:2000',
        ]);

        Recommendation::create([
            'user_id' => Auth::id(),   // sender
            'to_id' => $request->to_id, // receiver
            'description' => $request->description,
        ]);

        return redirect()
            ->back()
            ->with('success', 'Recommendation sent successfully');

    }
}