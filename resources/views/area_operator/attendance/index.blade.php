@extends('layouts.area_operator')

@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Salesman Attendance</h4>

    {{-- FILTERS --}}
    <div class="card mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Salesman</label>
                    <select name="salesman_id" class="form-select">
                        <option value="">All Salesmen</option>
                        @foreach($salesmen as $salesman)
                            <option value="{{ $salesman->id }}" {{ ($salesmanId ?? '') == $salesman->id ? 'selected' : '' }}>
                                {{ $salesman->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Start Date</label>
                    <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">End Date</label>
                    <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                </div>

                <div class="col-md-3 d-flex gap-2">
                    <button class="btn btn-primary w-100">Filter</button>
                    <a href="{{ route('area.attendance.index') }}" class="btn btn-secondary w-100">Reset</a>
                </div>
            </form>
        </div>
    </div>

    {{-- ATTENDANCE TABLE --}}
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Attendance Records</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Salesman Name</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Check-in Time</th>
                            <th>Check-out Time</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ $attendance->user->name ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($attendance->date)->format('d M Y') }}</td>
                            <td>
                                @php
                                    $statusClass = match($attendance->status) {
                                        'present' => 'badge bg-success',
                                        'absent' => 'badge bg-danger',
                                        'leave' => 'badge bg-warning text-dark',
                                        default => 'badge bg-secondary'
                                    };
                                @endphp
                                <span class="{{ $statusClass }}">{{ ucfirst($attendance->status) }}</span>
                            </td>
                            <td>{{ $attendance->check_in ?? '-' }}</td>
                            <td>{{ $attendance->check_out ?? '-' }}</td>
                            <td>{{ $attendance->remarks ?? '-' }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No attendance records found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
