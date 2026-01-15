<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class EMIController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $payments = Payment::with('vendor', 'installments')
            ->when($user->role === 'salesman', function ($q) use ($user) {
                $q->whereHas('vendor', fn($v) =>
                    $v->where('created_by', $user->id)
                );
            })
            ->when($user->role === 'deo', function ($q) use ($user) {
                $q->whereHas('vendor', fn($v) =>
                    $v->where('deo_id', $user->id)
                );
            })
            ->when($user->role === 'area_operator', function ($q) use ($user) {
                $q->whereHas('vendor', fn($v) =>
                    $v->where('area_operator_id', $user->id)
                );
            })
            ->latest()
            ->get();

        return view('emis.index', compact('payments'));
    }

    public function show(Payment $payment)
    {
        $payment->load('vendor', 'installments');

        return view('emis.show', compact('payment'));
    }
}
