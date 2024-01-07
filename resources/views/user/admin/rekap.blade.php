@extends('layouts.template')

@section('content')
    <h3 style="font-family: Arial, Helvetica, sans-serif">Data Rekap</h3>
    <div class="mt-3 d-flex flex-row">
        <p class="me-3"><a href="#" class="fw-bold text-decoration-none">Home</a></p>
        <p><a href="{{ route('admin.user.index') }}" class="fw-bold text-decoration-none">Data Keterlambatan</a></p>
    </div>

    <table class="table table-bordered table-striped mt-3">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nis</th>
                <th>Siswa</th>
                <th>Jumlah Telat</th>
                <th>Detail</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($group as $nis => $group)
            @php
                $total = $group->where('student.nis')->count();
            @endphp
            <tr style="text-align: center">
                <td>{{ $no++ }}</td>
                <td>{{ $nis }}</td>
                <td>{{ $group->first()->student->name }}</td>
                <td>{{ $total }}</td>
                <td>
                    <a href="{{ route('admin.user.show', ['id' => $group->first()->student->id]) }}" class="btn btn-primary me-2">Lihat Detail</a>
                    @if($total >= 3) 
                    <a href="{{ route('admin.user.download', ['id'])}}" class="btn btn-danger me-2">Cetak Surat Pernyataan</a>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection
