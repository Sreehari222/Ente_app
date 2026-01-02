<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use Illuminate\Http\Request;

class PlanController extends Controller
{

    public function create()
    {
        $plans = Plan::latest()->get();
        return view('admin.plans.create', compact('plans'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);

        Plan::create($data);

        return redirect()
            ->route('admin.plans.create')
            ->with('success', 'Plan created successfully!');
    }

    public function destroy(Plan $plan)
    {
        $plan->delete();

        return redirect()
            ->route('admin.plans.create')
            ->with('success', 'Plan deleted successfully!');
    }

    public function edit(Plan $plan)
    {
        return view('admin.plans.edit', compact('plan'));
    }

    public function update(Request $request, Plan $plan)
    {
        // Validate input
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
        ]);

        // Update plan
        $plan->update($data);

        // Redirect back with success
        return redirect()
            ->route('admin.plans.create')
            ->with('success', 'Plan updated successfully!');
    }


}
