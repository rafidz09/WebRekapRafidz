@extends('layouts.template')

@section('content')
    @if (Session::get('sukses'))
        <div class="alert alert-success">{{ Session::get('sukses') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 style="font-family: Arial, Helvetica, sans-serif">Data User</h3>
    </div>

    <div class="mt-3 d-flex flex-row">
        <p class="me-3"><a href="{{ route('user1.index') }}" class="fw-bold text-decoration-none">Home</a></p>
        <p><a href="{{ route('user1.create') }}" class="fw-bold text-decoration-none">Tambah Data User</a></p>
    </div>

    <form class="mt-3 mb-3" action="{{ route('user1.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="users" value="{{ request('Users') }}" placeholder="Search Users">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div class="table-responsive mt-3"> <!-- Add a responsive wrapper for smaller screens -->
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $item)
                    <tr>
                        {{-- <td>{{ ($users->currentpage()-1) * $users->perpage() + $loop->index + 1}}</td> --}}
                        <td>{{ $item['name'] }}</td>
                        <td>{{ $item['email'] }}</td>
                        <td>{{ $item['role'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('user1.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                            <form action="{{ route('user1.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
