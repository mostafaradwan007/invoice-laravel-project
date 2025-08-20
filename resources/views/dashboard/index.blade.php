@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <p class="mb-4">Welcome! Glad to see you.</p>

    <div class="row">
        <!-- Recent Transactions Card -->
        <div class="col-lg-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5>Recent Transactions</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Invoices
                            <span class="badge bg-primary rounded-pill">$ 0.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Payments
                            <span class="badge bg-success rounded-pill">$ 0.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Expenses
                            <span class="badge bg-secondary rounded-pill">$ 0.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Outstanding
                            <span class="badge bg-danger rounded-pill">$ 0.00</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Total Invoices Outstanding
                            <span>0</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Overview Chart -->
        <div class="col-lg-8 mb-4">
            <div class="card h-100">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Overview</h5>
                    <div>
                        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="btnradio" id="btnradio1" autocomplete="off" checked>
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio1">USD</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio2" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio2">Day</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio3" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio3">Week</label>

                            <input type="radio" class="btn-check" name="btnradio" id="btnradio4" autocomplete="off">
                            <label class="btn btn-outline-secondary btn-sm" for="btnradio4">Month</label>
                        </div>
                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            This Month
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                        <button class="btn btn-outline-secondary btn-sm"><i class="bi bi-gear"></i></button>
                    </div>
                </div>
                <div class="card-body">
                    <canvas id="overviewChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Recent Activity Card -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5>Recent Activity</h5>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            Mostafa Mohamed Radwan deleted client No Contact Set<br>
                            <small class="text-muted">24/Jul/2025 05:24 PM 197.63.29.202</small>
                        </li>
                        <li class="list-group-item">
                            Mostafa Mohamed Radwan created client No Contact Set<br>
                            <small class="text-muted">24/Jul/2025 05:23 PM 197.63.29.202</small>
                        </li>
                        <li class="list-group-item">
                            Mostafa Mohamed Radwan created user Mostafa Mohamed Radwan<br>
                            <small class="text-muted">24/Jul/2025 02:25 PM 197.63.29.202</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Recent Payments Card -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="bi bi-credit-card"></i> Recent Payments</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Client</th>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="5" class="text-center">No records found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Upcoming Invoices Card -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="bi bi-calendar-check"></i> Upcoming Invoices</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">No records found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Past Due Invoices Card -->
        <div class="col-lg-6 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    <h5><i class="bi bi-exclamation-triangle"></i> Past Due Invoices</h5>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Number</th>
                                <th>Client</th>
                                <th>Due Date</th>
                                <th>Balance</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">No records found</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const overviewCtx = document.getElementById('overviewChart').getContext('2d');
        new Chart(overviewCtx, {
            type: 'line',
            data: {
                labels: ['01/Aug/2025', '31/Aug/2025'], // Placeholder labels
                datasets: [{
                    label: 'Overview',
                    data: [0, 0], // Placeholder data
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value, index, values) {
                                return '$ ' + value.toFixed(2);
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection




