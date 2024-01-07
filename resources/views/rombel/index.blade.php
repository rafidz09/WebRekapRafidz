@extends('layouts.template')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('deleted'))
        <div class="alert alert-warning">{{ Session::get('deleted') }}</div>
    @endif

    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h3 style="font-family: Arial, Helvetica, sans-serif">Data Rombel</h3>
    </div>

    <div class="mt-3 d-flex flex-row">
        <p class="me-3"><a href="{{ route('rombel.index') }}" class="fw-bold text-decoration-none">Home</a></p>
        <p><a href="{{ route('rombel.create') }}" class="fw-bold text-decoration-none">Tambah Data Rombel</a></p>
    </div>

    <form class="mt-3 mb-3" action="{{ route('rombel.index') }}" method="GET">
        <div class="input-group">
            <input type="text" class="form-control" name="rombels" value="{{ request('rombels') }}" placeholder="Search Rombels">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Rombel</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @forelse ($rombels as $item)
                    <tr>
                        <td class="text-center">{{ $no++ }}</td>
                        <td class="text-center">{{ $item['rombel'] }}</td>
                        <td class="d-flex justify-content-center">
                            <a href="{{ route('rombel.edit', $item['id']) }}" class="btn btn-primary me-2">Edit</a>
                            <form action="{{ route('rombel.delete', $item['id']) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No data available</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- <div class="d-flex justify-content-end">
        pagination
        @if ($users->count())
        {{$users->links()}}  
        @endif
    </div> --}}
@endsection
