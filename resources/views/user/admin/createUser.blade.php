@extends('layouts.template')

@section('content')
    <div class="mt-3">
        <h3 class="mb-4">Tambah Data Keterlambatan</h3>
        <div class="mt-3 d-flex flex-row">
            <p class="me-3"><a href="{{ route('admin.user.index') }}" class="fw-bold text-decoration-none">Data Keterlambatan</a></p>
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

        <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="student_id" class="col-sm-2 col-form-label @error('student_id') is-invalid @enderror">Siswa :</label>
                <div class="col-sm-10">
                    <select name="student_id" id="student_id" class="form-control">
                        <option selected hidden disabled>Pilih</option>
                        @foreach ($student as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    @error('student_id')
                    <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>

            <div class="mb-3 row">
                <label for="tanggal" class="col-sm-2 col-form-label">Tanggal :</label>
                <div class="col-sm-10">
                    <input type="datetime-local" class="form-control" id="tanggal" name="date_time_lite" value="{{ old('date_time_lite') }}">
                </div>
            </div>
            
            <div class="mb-3 row">
                <label for="ket_keterlambatan" class="col-sm-2 col-form-label">Keterangan Keterlambatan :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="ket_keterlambatan" name="information" value="{{ old('information') }}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="bukti" class="col-sm-2 col-form-label">Pilih file:</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="bukti" name="bukti">
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
