@extends('layouts.' . auth()->user()->role)

@section('title', 'EMI Monitoring')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="mb-3">EMI Monitoring</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Vendor</th>
                    <th>Plan</th>
                    <th>Total</th>
                    <th>EMI</th>
                    <th>Paid</th>
                    <th>Pending</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->vendor->owner_name }}</td>
                        <td>{{ $payment->plan_id->title ?? '-' }}</td>
                        <td>₹{{ $payment->total_amount }}</td>
                        <td>
                            {{ $payment->emi_duration }}
                            × ₹{{ $payment->emi_amount }}
                        </td>
                        <td>
                            {{ $payment->installments->where('status','paid')->count() }}
                        </td>
                        <td>
                            {{ $payment->installments->where('status','pending')->count() }}
                        </td>
                        <td>
                            <span class="badge bg-{{ $payment->status === 'completed' ? 'success' : 'warning' }}">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('emis.show', $payment->id) }}"
                               class="btn btn-sm btn-primary">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
