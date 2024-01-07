@extends('layouts.template')

@section('content')
    <div class="mt-3">
        <h3 class="mb-4">Tambah Data User</h3>
        <div class="mt-3 d-flex flex-row">
            <p class="me-3"><a href="{{ route('user1.index') }}" class="fw-bold text-decoration-none">Data User</a></p>
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

        <form action="{{ route('user1.store') }}" method="post">
            @csrf
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Name :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email :</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">Password :</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="role" class="col-sm-2 col-form-label">Role :</label>
                <div class="col-sm-10">
                  <select name="role"  id="role" class="form-control">
                    <option selected hidden disabled>Pilih Role</option>
                    <option value="ps" {{ old('role') == 'ps' ? 'selected' : ''}}>Pembimbing Siswa</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : ''}}>Admin</option>
                  </select>
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
