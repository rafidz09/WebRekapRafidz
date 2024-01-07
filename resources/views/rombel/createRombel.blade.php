@extends('layouts.template')

@section('content')
    <div class="mt-3">
        <h3 class="mb-4">Tambah Data Rombel</h3>
        <div class="mt-3 d-flex flex-row">
            <p class="me-3"><a href="{{ route('rombel.index') }}" class="fw-bold text-decoration-none">Data Rombel</a></p>
        </div>
    
            @if ($errors->any())
                <ul class="alert alert-danger">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            @if (Session::has('error'))
                <div class="alert alert-danger">{{ Session::get('error') }}</div>
            @endif

        <form action="{{ route('rombel.store') }}" method="post">
            @csrf

            <div class="mb-3 row">
                <label for="rombel" class="col-sm-2 col-form-label">Rombel :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="rombel" name="rombel" value="{{ old('rombel') }}">
                </div>
            </div>
            
            <div class="mb-3 text-end">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>

    @if (Session::has('success') || Session::has('error'))
        <script>
            // Menampilkan alert dengan warna hijau untuk sukses dan merah untuk error
            document.addEventListener('DOMContentLoaded', function () {
                @if (Session::has('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Sukses!',
                        text: '{{ Session::get('success') }}',
                        confirmButtonText: 'OK'
                    });
                @elseif(Session::has('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: '{{ Session::get('error') }}',
                        confirmButtonText: 'OK'
                    });
                @endif
            });
        </script>
    @endif
@endsection
