@extends('layouts.area_operator')

@section('content')
<div class="container mt-4">
    <h4>Attendance</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-4 text-center">
        <p>Date: {{ \Carbon\Carbon::today()->format('d M Y') }}</p>
        <p>Status: <strong>{{ ucfirst($attendance->status ?? 'Absent') }}</strong></p>
        <p>Check-in: {{ $attendance->check_in ?? '-' }}</p>
        <p>Check-out: {{ $attendance->check_out ?? '-' }}</p>

        <div class="mt-3">
            @if(!$attendance->check_in)
                <form method="POST" action="{{ route('attendance.checkin') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-success">Check In</button>
                </form>
            @endif

            @if($attendance->check_in && !$attendance->check_out)
                <form method="POST" action="{{ route('attendance.checkout') }}" class="d-inline">
                    @csrf
                    <button class="btn btn-danger">Check Out</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
