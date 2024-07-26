<!-- resources/views/reports/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Reports</h1>

    <!-- Department Filter -->
    <form id="filterForm" action="{{ route('admin.dashboard') }}" method="GET" class="">
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
    </form>

    <!-- Container for Chart -->
    <canvas id="reportChart" width="300" height="100"></canvas>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script to Render the Chart -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Example data, replace with your data
            var ctx = document.getElementById('reportChart').getContext('2d');
            var reportData = @json($reports); // Pass your reports data from Laravel

            // Prepare data for Chart.js
            var labels = reportData.map(report => report.date);
            var profitData = reportData.map(report => parseFloat(report.profit) || 0);
            var outlayData = reportData.map(report => parseFloat(report.outlay) || 0);

            var myChart = new Chart(ctx, {
                type: 'bar', // or 'line', 'pie', etc.
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: 'Profit',
                            data: profitData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        },
                        {
                            label: 'Outlay',
                            data: outlayData,
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            borderColor: 'rgba(255, 99, 132, 1)',
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
