@extends('layouts.template')

@section('content')
<form action="{{ route('admin.user.update', ['id' => $student->id ?? 0]) }}" method="POST" class="card mt-3 p-5" enctype="multipart/form-data">        
    @method('PATCH') 
    @csrf

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h3 class="mb-4">Edit Data Keterlambatan</h3>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="date_time_lite" class="col-sm-2 col-form-label">Tanggal :</label>
            <div class="col-sm-10">
                <input type="datetime-local" class="form-control" id="date_time_lite" name="date_time_lite">
            </div>
        </div>
        
        <div class="mb-3 row">
            <label for="information" class="col-sm-2 col-form-label">Keterangan Keterlambatan :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="information" name="information">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="bukti" class="col-sm-2 col-form-label">Pilih file:</label>
            <div class="col-sm-10">
                <img src="{{ asset('uploads/') }}" class="img-thumbnail" alt="Bukti Keterlambatan">
                <input type="file" class="form-control" id="bukti" name="bukti">
            </div>
        </div>

        <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
</form>
@endsection
