@extends('layouts.template')

@section('content')
    @if (Session::get('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="font-family: Arial, Helvetica, sans-serif">Data Keterlambatan</h3>
    </div>

    <div class="d-flex align-items-center">
        <a href="{{ route('ps.user.excel')}}" class="btn btn-primary me-2">Export data Excel</a>
        <p class="me-3 mb-0"><a href="{{ route('ps.user.rekap1')}}" class="btn btn-primary">Rekap Data</a></p>
    </div>     

    <form class="mt-3" action="" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="users" value="{{ request('student_id') }}" placeholder="Search Data Keterlambatan">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
    <br>

    <table class="table table-bordered table-striped">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Informasi</th>
            </tr>
        </thead>
        <tbody>
            @if ($lates->count() > 0)
                @foreach ($lates as $index => $delay)
                    <tr style="text-align: center">
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $delay->student->name }}</td>
                        <td>{{ $delay['date_time_lite'] }}</td>
                        <td>{{ $delay['information'] }}</td>
                    </tr>
                @endforeach
            @else
            @endif
        </tbody>
    </table>
@endsection
