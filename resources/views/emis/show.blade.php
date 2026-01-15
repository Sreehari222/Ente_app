@extends('layouts.' . auth()->user()->role)

@section('title', 'EMI Details')

@section('content')
<div class="card">
    <div class="card-body">
        <h5>{{ $payment->vendor->shop_name }} - EMI Details</h5>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Installment</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Paid On</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payment->installments as $emi)
                    <tr>
                        <td>#{{ $emi->installment_number }}</td>
                        <td>₹{{ $emi->amount }}</td>
                        <td>
                            <span class="badge bg-{{ $emi->status === 'paid' ? 'success' : 'danger' }}">
                                {{ ucfirst($emi->status) }}
                            </span>
                        </td>
                        <td>{{ $emi->paid_at ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
