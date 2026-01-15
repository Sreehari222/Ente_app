@extends('layouts.deo')

@section('content')
    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="mb-0">Reports</h4>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary">
                <i class="ri-arrow-left-line"></i> Back
            </a>
        </div>

        {{-- Report Filter --}}
        <form action="{{ route('reports.monthly') }}" method="GET" class="d-flex align-items-center gap-2 mb-4">
            <label class="mb-0 fw-semibold">Select Report Type:</label>
            <select name="report_type" class="form-select w-auto">
                <option value="weekly" {{ request('report_type') == 'weekly' ? 'selected' : '' }}>Weekly</option>
                <option value="monthly" {{ request('report_type') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="yearly" {{ request('report_type') == 'yearly' ? 'selected' : '' }}>Yearly</option>
            </select>
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>

        {{-- Salesman Reports --}}
        <div class="card mb-4 shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0">Salesman Reports</h5>
            </div>

            <div class="card-body">
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>#</th>
                                <th>Salesman</th>
                                <th class="text-center">Total Vendors</th>
                                <th class="text-center">Total Cash Collected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salesmanReports as $index => $report)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $report['salesman']->name }}</td>
                                    <td class="text-center">{{ $report['total_vendors'] }}</td>
                                    <td class="text-center">₹ {{ number_format($report['total_cash'], 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <canvas id="salesmanChart" height="100"></canvas>
            </div>
        </div>

        {{-- Category Reports --}}
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0">Category Reports</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive mb-4">
                    <table class="table table-striped table-hover align-middle">
                        <thead class="table-light text-uppercase small">
                            <tr>
                                <th>#</th>
                                <th>Main Category</th>
                                <th>Category</th>
                                <th class="text-center">Vendor Count</th>
                                <th class="text-center">Total Cash</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categoryReports as $index => $category)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $category->mainCategory->name ?? '-' }}</td>
                                    <td>{{ $category->category->name ?? '-' }}</td>
                                    <td class="text-center">{{ $category->vendor_count }}</td>
                                    <td class="text-center">₹ {{ number_format($category->total_cash, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="max-width: 350px; margin: auto; height: 200px;">
                    <canvas id="categoryChart"></canvas>
                </div>

            </div>
        </div>

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Salesman Vendors Chart
        const salesmanLabels = @json($salesmanReports->pluck('salesman.name'));
        const salesmanData = @json($salesmanReports->pluck('total_vendors'));
        const salesmanCash = @json($salesmanReports->pluck('total_cash'));

        new Chart(document.getElementById('salesmanChart'), {
            type: 'bar',
            data: {
                labels: salesmanLabels,
                datasets: [{
                        label: 'Total Vendors',
                        data: salesmanData,
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Cash Collected (₹)',
                        data: salesmanCash,
                        backgroundColor: 'rgba(255, 206, 86, 0.7)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top'
                    },
                    title: {
                        display: true,
                        text: 'Salesman-wise Vendors & Cash'
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Category Cash Chart
        const categoryLabels = @json($categoryReports->map(fn($c) => ($c->mainCategory->name ?? '-') . ' - ' . ($c->category->name ?? '-')));
        const categoryCash = @json($categoryReports->pluck('total_cash'));

        new Chart(document.getElementById('categoryChart'), {
            type: 'pie',
            data: {
                labels: categoryLabels,
                datasets: [{
                    label: 'Cash Collected',
                    data: categoryCash,
                    backgroundColor: categoryLabels.map(() => 'rgba(' + Math.floor(Math.random() * 255) +
                        ',' + Math.floor(Math.random() * 255) + ',' + Math.floor(Math.random() * 255) +
                        ',0.7)'),
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right'
                    },
                    title: {
                        display: true,
                        text: 'Category-wise Cash Collection'
                    }
                }
            }
        });
    </script>
@endsection
