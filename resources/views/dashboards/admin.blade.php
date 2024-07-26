<!-- resources/views/reports/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Kompaniya Hisobotlari</h1>
        <div class="btn-toolbar" role="toolbar">
            <div class="btn-group me-2" role="group">
                <button type="button" class="btn btn-secondary" onclick="setPeriod('monthly')">Oylik</button>
                <button type="button" class="btn btn-secondary" onclick="setPeriod('quarterly')">Kvartal</button>
                <button type="button" class="btn btn-secondary" onclick="setPeriod('semi-annual')">Yarim Yillik</button>
                <button type="button" class="btn btn-secondary" onclick="setPeriod('yearly')">Yillik</button>
            </div>
            <div class="btn-group ms-2" role="group">
                <select id="chartType" class="form-select" onchange="changeChartType();">
                    <option value="line" {{ request('chartType', 'line') === 'line' ? 'selected' : '' }}>Chiziqli Diagramma</option>
                    <option value="bar" {{ request('chartType') === 'bar' ? 'selected' : '' }}>Barda Diagramma</option>
                    <option value="radar" {{ request('chartType') === 'radar' ? 'selected' : '' }}>Radar Diagramma</option>
                    <option value="pie" {{ request('chartType') === 'pie' ? 'selected' : '' }}>Doira Diagramma</option>
                    <option value="doughnut" {{ request('chartType') === 'doughnut' ? 'selected' : '' }}>Qovurdoq Diagramma</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Bo'lim va davr filtri -->
    <form id="filterForm" action="{{ route('admin.dashboard') }}" method="GET" class="row g-3 mb-5">
        <div class="col-md-6">
            <div class="form-floating">
                <select id="department_id" name="department_id" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="">Barcha Bo'limlar</option>
                    @foreach($departments as $department)
                    <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                        {{ $department->name }}
                    </option>
                    @endforeach
                </select>
                <label for="department_id">Bo'limni Tanlang</label>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-floating">
                <select id="period" name="period" class="form-select" onchange="document.getElementById('filterForm').submit();">
                    <option value="monthly" {{ request('period') == 'monthly' ? 'selected' : '' }}>Oylik</option>
                    <option value="quarterly" {{ request('period') == 'quarterly' ? 'selected' : '' }}>Kvartal</option>
                    <option value="semi-annual" {{ request('period') == 'semi-annual' ? 'selected' : '' }}>Yarim Yillik</option>
                    <option value="yearly" {{ request('period') == 'yearly' ? 'selected' : '' }}>Yillik</option>
                </select>
                <label for="period">Davrni Tanlang</label>
            </div>
        </div>
    </form>

    <!-- Bo'lim va davr ma'lumotlarini ko'rsatish -->
    <div class="mb-4">
        <h4 class="text-muted">
            {{ $departmentId ? $departments->firstWhere('id', $departmentId)->name : 'Barcha Bo\'limlar' }}
            - {{ ucfirst($period) }} Hisoboti
        </h4>
    </div>

    <!-- Diagramma uchun konteyner -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <canvas id="reportChart" width="400" height="150"></canvas>
        </div>
    </div>

    <!-- Hisobotlar uchun jadval -->
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Sana</th>
                    <th>Ma'qsad</th>
                    <th>Foyda</th>
                    <th>Chiqarish</th>
                    @if(!$departmentId)
                    <th>Bo'lim</th> <!-- Barcha bo'limlarni ko'rsatishda bo'lim ustunini ko'rsatish -->
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
                    <td>{{ $report->department_name }}</td> <!-- Bo'lim nomini ko'rsatish -->
                    @endif
                </tr>
                @endforeach

                <!-- Future months section -->
                @if($futureTargets->isNotEmpty())
                @foreach($futureTargets as $report)
                <tr class="table-secondary">
                    <td>{{ $report->date }}</td>
                    <td>{{ $report->target }}</td>
                    <td>{{ $report->profit }}</td>
                    <td>{{ $report->outlay }}</td>
                    @if(!$departmentId)
                    <td>{{ $report->department_name }}</td> <!-- Bo'lim nomini ko'rsatish -->
                    @endif
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>

    <!-- Chart.js kutubxonasini qo'shish -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Diagrammani chizish uchun script -->
    <script>
        let chartInstance; // Diagramma obyektini qayta ishlatish uchun global o'zgaruvchi

        document.addEventListener('DOMContentLoaded', function() {
            var ctx = document.getElementById('reportChart').getContext('2d');
            var reportData = @json($reports); // Laraveldan hisobot ma'lumotlarini o'tkazish
            var futureData = @json($futureTargets); // Laraveldan kelajak ma'lumotlarini o'tkazish

            // Chart.js uchun ma'lumotlarni tayyorlash
            var labels = [];
            var targetData = [];
            var profitData = [];
            var outlayData = [];

            reportData.forEach(report => {
                labels.push(report.date);
                targetData.push(parseFloat(report.target) || 0);
                profitData.push(parseFloat(report.profit) || 0);
                outlayData.push(parseFloat(report.outlay) || 0);
            });

            futureData.forEach(report => {
                labels.push(report.date);
                targetData.push(parseFloat(report.target) || 0);
                profitData.push(parseFloat(report.profit) || 0);
                outlayData.push(parseFloat(report.outlay) || 0);
            });

            // Ro'yxatdan tanlangan diagramma turini olish
            var initialChartType = document.getElementById('chartType').value;

            // Diagrammani dastlabki turda (chiziqli yoki tanlangan turda) sozlash
            chartInstance = new Chart(ctx, {
                type: initialChartType,
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Ma\'qsad',
                            data: targetData,
                            backgroundColor: "rgba(53, 244, 91, 0.2)",
                            borderColor: 'rgb(71,220,100)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Foyda',
                            data: profitData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Chiqarish',
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
                            text: '{{ $departmentId ? $departments->firstWhere("id", $departmentId)->name : "Barcha Bo\'limlar" }} - {{ ucfirst($period) }} Ishlash'
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
                                display: false
                            }
                        }
                    }
                }
            });
        });

        // Diagramma turini o'zgartirish uchun funksiyani qo'shish
        function changeChartType() {
            var newType = document.getElementById('chartType').value;
            if (chartInstance) {
                chartInstance.destroy(); // Eski diagrammani o'chirish
            }
            var ctx = document.getElementById('reportChart').getContext('2d');
            var reportData = @json($reports);
            var futureData = @json($futureTargets);

            var labels = [];
            var targetData = [];
            var profitData = [];
            var outlayData = [];

            reportData.forEach(report => {
                labels.push(report.date);
                targetData.push(parseFloat(report.target) || 0);
                profitData.push(parseFloat(report.profit) || 0);
                outlayData.push(parseFloat(report.outlay) || 0);
            });

            futureData.forEach(report => {
                labels.push(report.date);
                targetData.push(parseFloat(report.target) || 0);
                profitData.push(parseFloat(report.profit) || 0);
                outlayData.push(parseFloat(report.outlay) || 0);
            });

            chartInstance = new Chart(ctx, {
                type: newType,
                data: {
                    labels: labels,
                    datasets: [{
                            label: 'Ma\'qsad',
                            data: targetData,
                            backgroundColor: "rgba(53, 244, 91, 0.2)",
                            borderColor: 'rgb(71,220,100)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Foyda',
                            data: profitData,
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            fill: true
                        },
                        {
                            label: 'Chiqarish',
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
                            text: '{{ $departmentId ? $departments->firstWhere("id", $departmentId)->name : "Barcha Bo\'limlar" }} - {{ ucfirst($period) }} Ishlash'
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
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Periodni o'zgartirish uchun funksiyani qo'shish
        function setPeriod(period) {
            document.getElementById('period').value = period;
            document.getElementById('filterForm').submit();
        }
    </script>
</div>
@endsection
