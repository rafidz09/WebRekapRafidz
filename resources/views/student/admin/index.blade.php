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

    <div class="mt-3 d-flex flex-row">
        <p class="me-3"><a href="{{ route('admin.student.index') }}" class="fw-bold text-decoration-none">Home</a></p>
        <p><a href="{{ route('admin.student.create') }}" class="fw-bold text-decoration-none">Tambah Data Siswa</a></p>
    </div>

    <form action="{{ route('admin.student.index') }}" method="GET" class="mt-3 mb-3">
        <div class="input-group">
            <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="Search Data Siswa">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <table class="table table-bordered table-striped">
        <thead>
            <tr style="text-align: center">
                <th>No</th>
                <th>Nis</th>
                <th>Nama</th>
                <th>Rombel</th>
                <th>Rayon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody style="text-align: center">
            @if ($students->count() > 0)
            @foreach ($students as $item)
                <tr>
                    <td>{{ ($students->currentpage()-1) * $students->perpage() + $loop->index + 1}}</td>
                    <td>{{ $item['nis'] }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item->rombel ? $item->rombel['rombel'] : 'Tidak ada data rombel' }}</td>
                    <td>{{ $item->rayon ? $item->rayon['rayon'] : 'Tidak ada data rayon' }}</td>
                    <td class="d-flex justify-content-center">
                        <a href="{{ route('admin.student.edit', ['id' => $item['id']]) }}" class="btn btn-primary me-2">Edit</a>
                        <form method="POST" action="{{ route('admin.student.delete', ['id' => $item['id']]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @endif
        </tbody>
    </table>
    </div>
@endsection
