<!-- resources/views/reports/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reports</h1>

    <!-- Department and Period Filter -->
    <form id="filterForm" action="{{ route('admin.dashboard') }}" method="GET" class="mb-3">
        <div class="form-group">
            <label for="department_id">Select Department:</label>
            <select id="department_id" name="department_id" class="form-control" onchange="document.getElementById('filterForm').submit();">
                <option value="">All Departments</option>
                @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="period">Select Period:</label>
            <select id="period" name="period" class="form-control" onchange="document.getElementById('filterForm').submit();">
                <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                <option value="quarterly" {{ request('period') == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                <option value="semi-annual" {{ request('period') == 'semi-annual' ? 'selected' : '' }}>Semi-Annual</option>
                <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Yearly</option>
            </select>
        </div>
    </form>

    <!-- Container for Chart -->
    <canvas id="reportChart" width="200" height="50"></canvas>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script to Render the Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var ctx = document.getElementById('reportChart').getContext('2d');
            var reportData = @json($reports); // Pass your reports data from Laravel

            // Prepare data for Chart.js
            var labels = reportData.map(report => report.date);
            var targetData = reportData.map(report => parseFloat(report.target) || 0);
            var profitData = reportData.map(report => parseFloat(report.profit) || 0);
            var outlayData = reportData.map(report => parseFloat(report.outlay) || 0);

            var myChart = new Chart(ctx, {
                type: 'bar', // or 'line', 'pie', etc.
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Target',
                            data: targetData,
                            backgroundColor: "rgb(53,244,91)",
                            borderColor: 'rgb(71,220,100)',
                            borderWidth: 1
                        },
                        {
                            label: 'Profit',
                            data: profitData,
                            backgroundColor: 'rgba(75, 192, 192, 1)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Outlay',
                            data: outlayData,
                            backgroundColor: 'rgba(237,15,48,0.67)',
                            borderColor: 'rgba(237,15,48,0.67)',
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</div>
@endsection
