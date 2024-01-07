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
        <a href="{{ route('ps.user.data')}}" class="btn btn-primary me-2">Keseluruhan Data</a>    
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
                <th>Nis</th>
                <th>Nama</th>
                <th>Jumlah Keterlambatan</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1 @endphp

            @foreach ($groupLates as $nis => $group)
            @php
                 $total = $group->where('student.nis')->count();
            @endphp
                    <tr style="text-align: center">
                        <td>{{ $no++ }}</td>
                        <td>{{ $nis }}</td>
                        <td>{{ $group->first()->student->name }}</td>
                        <td>{{ $total }}</td>
                        <td>
                            <a href="{{ route('ps.user.show1', ['id' => $group->first()->student->id]) }}" class="btn btn-primary me-2">Lihat Detail</a>
                            @if($total >= 3)
                            <a href="{{ route('ps.user.download', ['id']) }}" class="btn btn-danger me-2">Cetak Surat Pernyataan</a>
                            @endif
                        </td>
                    </tr>
                @endforeach
        </tbody>
    </table>
@endsection
