@extends('layouts.admin')

@section('title', 'Reports')

@section('content')

<h4 class="mb-4">Admin Reports</h4>

{{-- FILTER --}}
<form method="GET" class="row mb-4">
    <div class="col-md-3">
        <select name="role" class="form-control" onchange="this.form.submit()">
            <option value="">All Roles</option>
            @foreach(['admin','area_operator','deo','salesman','user'] as $r)
                <option value="{{ $r }}" {{ request('role') == $r ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_',' ', $r)) }}
                </option>
            @endforeach
        </select>
    </div>
</form>

{{-- STATS --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6>Total Users</h6>
                <h3>{{ $totalUsers }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6>Weekly Logins</h6>
                <h3>{{ $weeklyLogins }}</h3>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-center">
            <div class="card-body">
                <h6>Monthly Logins</h6>
                <h3>{{ $monthlyLogins }}</h3>
            </div>
        </div>
    </div>
</div>

{{-- CHART --}}
<div class="card mb-4">
    <div class="card-header">Users by Role</div>
    <div class="card-body">
        <canvas id="roleChart"></canvas>
    </div>
</div>

{{-- USERS TABLE --}}
<div class="card mb-4">
    <div class="card-header">Users</div>
    <div class="card-body table-responsive">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Last Login</th>
                    <th>Last Logout</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ ucfirst(str_replace('_',' ', $user->role)) }}</td>
                        <td>{{ optional($user->last_login_at)->format('d M Y, h:i A') ?? '-' }}</td>
                        <td>{{ optional($user->last_logout_at)->format('d M Y, h:i A') ?? '-' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- ACTIVITY LOG --}}
<div class="card">
    <div class="card-header">Recent Login / Logout Activity</div>
    <div class="card-body table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                    <th>IP</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @forelse($activities as $log)
                    <tr>
                        <td>{{ $log->user->name ?? 'Deleted User' }}</td>
                        <td>{{ ucfirst(str_replace('_',' ', $log->user->role ?? '')) }}</td>
                        <td>
                            <span class="badge bg-{{ $log->action == 'login' ? 'success' : 'danger' }}">
                                {{ ucfirst($log->action) }}
                            </span>
                        </td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">No activity found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
new Chart(document.getElementById('roleChart'), {
    type: 'bar',
    data: {
        labels: @json($roles),
        datasets: [{
            label: 'Users',
            data: @json($roleCounts),
            backgroundColor: 'rgba(54, 162, 235, 0.6)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 1 }
            }
        }
    }
});
</script>
@endsection
