@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Hisobotlar</h1>
        <a href="{{ route('reports.create') }}" class="btn btn-primary">Hisobot Yaratish</a>

        <!-- Sorting Filters -->
        <form action="{{ route('reports.index') }}" method="GET" class="row mb-4">
            <div class="col-md-4">
                <select name="department_id" class="form-select" onchange="this.form.submit();">
                    <option value="">Bo'limni tanlang</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->id }}" {{ request('department_id') == $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <select name="month" class="form-select" onchange="this.form.submit();">
                    <option value="">Oyni tanlang</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ request('month') == $i ? 'selected' : '' }}>
                            {{ \Carbon\Carbon::create()->month($i)->format('F') }}
                        </option>
                    @endfor
                </select>
            </div>
            <div class="col-md-4">
                <select name="year" class="form-select" onchange="this.form.submit();">
                    <option value="">Yilni tanlang</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>
                            {{ $year }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Bo'lim</th>
                <th>Maqsad</th>
                <th>Kirim</th>
                <th>Chiqim</th>
                <th>Sof Foyda</th>
                <th>Sana</th>
                <th>Amallar</th>
            </tr>
            </thead>
            <tbody>
            @foreach($reports as $report)
                <tr>
                    <td>{{ $report->id }}</td>
                    <td>{{ $report->department->name }}</td>
                    <td>{{ $report->target }}</td>
                    <td>{{ $report->profit }}</td>
                    <td>{{ $report->outlay }}</td>
                    <td>{{ $report->profit - $report->outlay }}</td>
                    <td>{{ \Carbon\Carbon::parse($report->date)->formatUzbekMonth() }}</td>
                    <td>
                        <a href="{{ route('reports.edit', $report->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
