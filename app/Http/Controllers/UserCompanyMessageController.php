<?php

namespace App\Http\Controllers;

use App\Models\CompanyMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserCompanyMessageController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $messages = CompanyMessage::orderBy('created_at', 'desc')->get();

        return view('company_messages.index', compact('messages'));
    }
}
