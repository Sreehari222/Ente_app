<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::where('user_id', Auth::id())
            ->latest()
            ->get();

        $role = Auth::user()->role;

        return view('submissions.index', compact('submissions', 'role'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'file'  => 'required|file|max:5120',
        ]);

        $path = $request->file('file')->store('submissions', 'public');

        Submission::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'file_path' => $path,
        ]);

        return back()->with('success', 'Submission uploaded successfully');
    }
}
