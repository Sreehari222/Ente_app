@extends('layouts.salesman')

@section('title', 'Your Statistics')

@section('content')
<div class="container-fluid">

    <!-- FILTER & PAGE TITLE -->
    <div class="row mb-3">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h4>Your Statistics</h4>
            <div>
                <select id="filterPeriod" class="form-select">
                    <option value="daily" {{ request('period') == 'daily' ? 'selected' : '' }}>Daily</option>
                    <option value="weekly" {{ request('period') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
            </div>
        </div>
    </div>

    <!-- SUMMARY CARDS -->
    <div class="row g-3 mb-4">
        <div class="col-md-2 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <h5>Total Vendors</h5>
                    <h3>{{ $totalVendors }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6">
            <div class="card text-center bg-success text-white">
                <div class="card-body">
                    <h5>Approved</h5>
                    <h3>{{ $approvedVendors }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6">
            <div class="card text-center bg-warning text-dark">
                <div class="card-body">
                    <h5>Pending</h5>
                    <h3>{{ $pendingVendors }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-2 col-sm-6">
            <div class="card text-center bg-danger text-white">
                <div class="card-body">
                    <h5>Rejected</h5>
                    <h3>{{ $rejectedVendors }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-sm-12">
            <div class="card text-center bg-info text-white">
                <div class="card-body">
                    <h5>Total Amount Collected</h5>
                    <h3>₹{{ number_format($totalAmountCollected, 2) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- CHARTS -->
    <div class="row g-3">

        <!-- Vendor Status -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-bold">Vendor Status</div>
                <div class="card-body d-flex align-items-center justify-content-center">
                    <canvas id="vendorStatusChart" style="max-height: 350px;"></canvas>
                </div>
            </div>
        </div>

        <!-- Vendors Added Per Day -->
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-header fw-bold">Vendors Added Per Day</div>
                <div class="card-body">
                    <canvas id="vendorsAddedChart" style="height: 350px;"></canvas>
                </div>
            </div>
        </div>

    </div>

</div>

<!-- Charts JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Vendor Status Pie Chart
    new Chart(document.getElementById('vendorStatusChart'), {
        type: 'doughnut',
        data: {
            labels: ['Approved', 'Pending', 'Rejected'],
            datasets: [{
                data: [{{ $approvedVendors }}, {{ $pendingVendors }}, {{ $rejectedVendors }}],
                backgroundColor: ['#28a745','#ffc107','#dc3545'],
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });

    // Vendors Added Per Day Line Chart
    new Chart(document.getElementById('vendorsAddedChart'), {
        type: 'line',
        data: {
            labels: {!! json_encode($vendorsAddedLabels) !!},
            datasets: [{
                label: 'Vendors Added',
                data: {!! json_encode($vendorsAddedData) !!},
                borderColor: '#0d6efd',
                backgroundColor: 'rgba(13,110,253,0.2)',
                fill: true,
                tension: 0.4,
                pointRadius: 4
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } },
            plugins: { legend: { display: true } }
        }
    });

    // Filter period change
    document.getElementById('filterPeriod').addEventListener('change', function() {
        window.location.href = '?period=' + this.value;
    });
</script>
@endsection
