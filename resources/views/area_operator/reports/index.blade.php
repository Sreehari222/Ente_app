@extends('layouts.area_operator')

@section('content')
    <div class="container-fluid">
        <h4 class="mb-4">Area Operator Reports</h4>
        {{-- TOTAL REVENUE CARD --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body text-center">
                        <h6>Total Revenue </h6>
                        <h3 class="text-success">₹{{ number_format($totalRevenue, 2) }}</h3>
                    </div>
                </div>
            </div>
        </div>
        {{-- FILTERS --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" class="row g-3 align-items-end">
                    <div class="col-md-3">
                        <label class="form-label">Salesman</label>
                        <select name="salesman_id" class="form-select">
                            <option value="">All Salesmen</option>
                            @foreach ($salesmen as $salesman)
                                <option value="{{ $salesman->id }}" {{ $salesmanId == $salesman->id ? 'selected' : '' }}>
                                    {{ $salesman->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Start Date</label>
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">End Date</label>
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate }}">
                    </div>

                    <div class="col-md-3 d-flex gap-2">
                        <button class="btn btn-primary w-100">Filter</button>
                        <a href="{{ route('area.reports.index') }}" class="btn btn-secondary w-100">Reset</a>
                    </div>
                </form>
            </div>
        </div>



        {{-- SALES MAN PERFORMANCE GRAPH (Number of Vendors) --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Salesman Performance (Vendors)</h5>
                <canvas id="vendorChart" height="100"></canvas>
            </div>
        </div>

        {{-- SALES MAN REVENUE GRAPH --}}
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Revenue by Salesman</h5>
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>

        {{-- VENDOR TABLE --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Vendor List</h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Shop Name</th>
                                <th>Owner Name</th>
                                <th>Mobile</th>
                                <th>Email</th>
                                <th>Service Area</th>
                                <th>Total Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendors as $vendor)
                                <tr>
                                    <td>{{ $vendor->shop_name }}</td>
                                    <td>{{ $vendor->owner_name }}</td>
                                    <td>{{ $vendor->mobile }}</td>
                                    <td>{{ $vendor->email }}</td>
                                    <td>{{ $vendor->service_area }}</td>
                                    <td>₹{{ number_format($vendor->total_amount, 2) }}</td>
                                    <td>
                                        @php
                                            $statusClass = match ($vendor->status) {
                                                'approved' => 'badge bg-success',
                                                'pending' => 'badge bg-warning text-dark',
                                                'rejected' => 'badge bg-danger',
                                                default => 'badge bg-secondary',
                                            };
                                        @endphp
                                        <span class="{{ $statusClass }}">{{ ucfirst($vendor->status) }}</span>
                                    </td>
                                    <td>{{ $vendor->created_at->format('d M Y') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted">No vendors found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Vendor Count Graph
        const vendorCtx = document.getElementById('vendorChart').getContext('2d');
        new Chart(vendorCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($salesmanPerformance->pluck('name')) !!},
                datasets: [{
                    label: 'Number of Vendors',
                    data: {!! json_encode($salesmanPerformance->pluck('vendor_count')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });

        // Revenue Graph
        const revenueCtx = document.getElementById('revenueChart').getContext('2d');
        new Chart(revenueCtx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($salesmanRevenue->pluck('name')) !!},
                datasets: [{
                    label: 'Revenue (₹)',
                    data: {!! json_encode($salesmanRevenue->pluck('revenue')) !!},
                    backgroundColor: 'rgba(75, 192, 192, 0.6)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>
@endsection
