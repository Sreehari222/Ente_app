<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $tasks = Task::all();
        } elseif ($user->role === 'area_operator') {
            $tasks = Task::where('area_operator_id', $user->id)
                ->orWhere('created_by', $user->id)
                ->get();
        } else {
            $tasks = Task::where('deo_id', $user->id)
                ->orWhere('salesman_id', $user->id)
                ->get();
        }

        return view('tasks.index', compact('tasks'));
    }

    public function create()
    {
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'area_operator'])) {
            abort(403, "Unauthorized");
        }

        $deos = User::where('role', 'deo')->get();
        $salesmen = User::where('role', 'salesman')->get();
        return view('tasks.create', compact('deos', 'salesmen'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        if (!in_array($user->role, ['admin', 'area_operator'])) {
            abort(403, "Unauthorized");
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'required|in:low,medium,high',
            'deo_id' => 'nullable|exists:users,id',
            'salesman_id' => 'nullable|exists:users,id'
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'priority' => $request->priority,
            'created_by' => $user->id,
            'area_operator_id' => $user->role === 'area_operator' ? $user->id : null,
            'deo_id' => $request->deo_id,
            'salesman_id' => $request->salesman_id
        ]);

        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function show(Task $task)
    {
        $user = Auth::user();
        if (
            $user->role === 'admin' ||
            $task->area_operator_id === $user->id ||
            $task->deo_id === $user->id ||
            $task->salesman_id === $user->id
        ) {
            return view('tasks.show', compact('task'));
        }

        abort(403, "Unauthorized");
    }

    public function updateStatus(Request $request, Task $task)
    {
        $user = Auth::user();
        if (
            !in_array($user->role, ['deo', 'salesman']) ||
            !($task->deo_id === $user->id || $task->salesman_id === $user->id)
        ) {
            abort(403, "Unauthorized");
        }

        $request->validate([
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $task->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Status updated');
    }

    public function getSalesmenByDEO($deo_id)
    {
        $salesmen = User::where('role', 'salesman')->where('deo_id', $deo_id)->get();
        return response()->json($salesmen);
    }
}
