@extends('layouts.template')

@section('content')
    <style>
        body {
            background-color: white;
            max-width: 100%;
            margin: 0 auto;
            overflow-x: hidden;
        }
    </style>

    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h3 style="font-family: Arial, Helvetica, sans-serif">Data Rayon</h3>
    </div>

    <div class="mt-3 d-flex flex-row">
        <p class="me-3"><a href="{{ route('rayon.index') }}" class="fw-bold text-decoration-none">Home</a></p>
        <p><a href="{{ route('rayon.create') }}" class="fw-bold text-decoration-none">Tambah Data Rayon</a></p>
    </div>

    <form class="d-flex" action="{{ route('rayon.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="rayons" value="{{ request('rayons') }}" placeholder="Search Rayons">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>
    

    <table class="table table-bordered mt-3" style="text-align: center;">
        <thead>
            <tr>
                <th>No</th>
                <th>Rayon</th>  
                <th>Pembimbing Siswa</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @foreach ($rayons as $item)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $item['rayon'] }}</td>
                    <td>{{ optional($item->user)->name }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('rayon.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                        <form action="{{ route('rayon.delete', $item['id']) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
