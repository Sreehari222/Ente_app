<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyMessage;
use Illuminate\Http\Request;

class CompanyMessageController extends Controller
{
     public function index()
    {
        $messages = CompanyMessage::latest()->get();
        return view('admin.company_messages.index', compact('messages'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        CompanyMessage::create($request->only('title', 'subject', 'message'));

        return redirect()->back()->with('success', 'Message saved successfully');
    }

    public function destroy($id)
    {
        CompanyMessage::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Message deleted successfully');
    }
}
