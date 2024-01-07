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

    <div class="mt-3 d-flex flex-row">
        <p class="me-3"><a href="#" class="fw-bold text-decoration-none">Home</a></p>
        <p class="me-3"><a href="{{ route('admin.user.create') }}" class="fw-bold text-decoration-none">Tambah Data Keterlambatan</a></p>
    </div>

    <div class="d-flex align-items-center">
        <a href="{{ route('admin.user.excel')}}" class="btn btn-primary me-2">Export data Excel</a>
        <p class="me-3 mb-0"><a href="{{ route('admin.user.rekap') }}" class="btn btn-primary">Rekap Data</a></p>
    </div>     

    <form class="mt-3" action="{{ route('admin.user.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="users" value="{{ request('student_id') }}" placeholder="Search Data Keterlambatan">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr style="text-align: center">
                <th>no</th>
                <th>Nama</th>
                <th>Tanggal</th>
                <th>Informasi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @if ($users->count() > 0)
                @foreach ($users as $item)
                    <tr style="text-align: center">
                        <td>{{ ($users->currentpage()-1) * $users->perpage() + $loop->index + 1}}</td>
                        <td>{{ $item['student']['name'] }}</td>
                        <td>{{ $item['date_time_lite'] }}</td>
                        <td>{{ $item['information'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('admin.user.edit', ['id' => $item->id]) }}" class="btn btn-primary me-2">Edit</a> 
                            <form method="POST" action="{{ route('admin.user.delete', ['id' => $item['id']]) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="8" class="text-center">No data available</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
@endsection
