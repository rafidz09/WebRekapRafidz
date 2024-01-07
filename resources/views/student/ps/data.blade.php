@extends('layouts.template')

@section('content')
    @if (Session::get('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="font-family: Arial, Helvetica, sans-serif">Data Siswa</h3>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @php
               $no = 1; 
            @endphp
            @if ($siswa->count() > 0)
            @foreach ($siswa as $item)
                <tr>
                    <td>{{$no++}}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item->rombel ? $item->rombel['rombel'] : 'Tidak ada data rombel' }}</td>
                    <td>{{ $item->rayon ? $item->rayon['rayon'] : 'Tidak ada data rayon' }}</td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
@endsection
