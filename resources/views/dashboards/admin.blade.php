<!-- resources/views/reports/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Company Reports</h1>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group me-2" role="group">
                <button type="button" class="btn btn-secondary" onclick="setPeriod('monthly')">Monthly</button>
                <button type="button" class="btn btn-secondary" onclick="setPeriod('quarterly')">Quarterly</button>
                <button type="button" class="btn btn-secondary" onclick="setPeriod('semi-annual')">Semi-Annual</button>
                <button type="button" class="btn btn-secondary" onclick="setPeriod('yearly')">Yearly</button>
            </div>
            <div class="btn-group ms-2" role="group">
                <!-- Dropdown for Chart Type Selection -->
                <select id="chartType" class="form-select" onchange="changeChartType();">
                    <option value="line" {{ request('chartType', 'line') === 'line' ? 'selected' : '' }}>Line Chart</option>
                    <option value="bar" {{ request('chartType') === 'bar' ? 'selected' : '' }}>Bar Chart</option>
                    <option value="radar" {{ request('chartType') === 'radar' ? 'selected' : '' }}>Radar Chart</option>
                    <option value="pie" {{ request('chartType') === 'pie' ? 'selected' : '' }}>Pie Chart</option>
                    <option value="doughnut" {{ request('chartType') === 'doughnut' ? 'selected' : '' }}>Doughnut Chart</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Department and Period Filter -->
    <form id="filterForm" action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 mb-5">
        <div class="col-md-6">
            <div class="form-floating">
                <select id="department_id" name="department_id" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="">All Departments</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                    @endforeach
                </select>
                <label for="department_id">Select Department</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select id="period" name="period" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Monthly</option>
                    <option value="quarterly" {{ request('period') == 'quarterly' ? 'selected' : '' }}>Quarterly</option>
                    <option value="semi-annual" {{ request('period') == 'semi-annual' ? 'selected' : '' }}>Semi-Annual</option>
                    <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Yearly</option>
                </select>
                <label for="period">Select Period</label>
            </div>
        </div>
    </form>

    <!-- Display Department and Period Info -->
    <div class="mb-4">
        <h4 class="text-muted">
            {{ $departmentId ? $departments->firstWhere('id', $departmentId)->name : 'All Departments' }}
            - {{ ucfirst($period) }} Report
        </h4>
    </div>

    <!-- Container for Chart -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <canvas id="reportChart" width="400" height="150"></canvas>
        </div>
    </div>

    <!-- Table for Reports -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Target</th>
                    <th>Profit</th>
                    <th>Outlay</th>
                    @if(!$departmentId)
                    <th>Department</th> <!-- Show department column when viewing all departments -->
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($reports as $report)
                <tr>
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->target }}</td>
                    <td>{{ $report->profit }}</td>
                    <td>{{ $report->outlay }}</td>
                    @if(!$departmentId)
                    <td>{{ $report->department_name }}</td> <!-- Display department name -->
                    @endif
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script to Render the Chart -->
    <script>
        let chartInstance; // Declare the chart instance globally for re-use

        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('reportChart').getContext('2d');
            var reportData = @json($reports); // Pass your reports data from Laravel

            // Prepare data for Chart.js
            var labels = reportData.map(report => report.date);
            var targetData = reportData.map(report => parseFloat(report.target) || 0);
            var profitData = reportData.map(report => parseFloat(report.profit) || 0);
            var outlayData = reportData.map(report => parseFloat(report.outlay) || 0);

            // Get the selected chart type from the dropdown
            var initialChartType = document.getElementById('chartType').value;

            // Initialize the chart with the default type (line or the selected type)
            chartInstance = new Chart(ctx, {
                type: initialChartType,
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Target',
                            data: targetData,
                            backgroundColor: "rgba(53, 244, 91, 0.2)",
                            borderColor: 'rgb(71,220,100)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Profit',
                            data: profitData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Outlay',
                            data: outlayData,
                            backgroundColor: 'rgba(237, 15, 48, 0.2)',
                            borderColor: 'rgba(237, 15, 48, 0.67)',
                            borderWidth: 2,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '{{ $departmentId ? $departments->firstWhere("id", $departmentId)->name : "All Departments" }} - {{ ucfirst($period) }} Performance'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.3)'
                            }
                        }
                    }
                }
            });
        });

        // Helper function to set the period in the filter form and submit
        function setPeriod(period) {
            document.getElementById('period').value = period;
            document.getElementById('filterForm').submit();
        }

        // Function to change the chart type
        function changeChartType() {
            var selectedType = document.getElementById('chartType').value;

            // Destroy the current chart instance to create a new one
            chartInstance.destroy();

            // Recreate the chart with the new type
            chartInstance = new Chart(document.getElementById('reportChart').getContext('2d'), {
                type: selectedType,
                data: {
                    labels: chartInstance.data.labels, // Use the existing labels
                    datasets: chartInstance.data.datasets.map(dataset => ({
                        ...dataset,
                        borderColor: dataset.borderColor
                    })), // Use the existing datasets
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: true,
                            text: '{{ $departmentId ? $departments->firstWhere("id", $departmentId)->name : "All Departments" }} - {{ ucfirst($period) }} Performance'
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(200, 200, 200, 0.3)'
                            }
                        }
                    }
                }
            });
        }
    </script>

</div>
@endsection