@extends('layouts.template')

@section('content')
    <div class="mt-3">
        <h3 class="mb-4">Tambah Data Siswa</h3>
        <div class="mt-3 d-flex flex-row">
            <p class="me-3"><a href="{{ route('admin.student.index') }}" class="fw-bold text-decoration-none">Data Siswa</a></p>
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

        <form action="{{ route('admin.student.store') }}" method="POST" class="card p-4 mt-5">
            @csrf
            <div class="mt-3 mb-3 row">
                <label for="nis" class="col-sm-2 col-form-label @error('nis') is-invalid @enderror">Nis :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nis" name="nis" value="{{ old('nis') }}">
                    @error('nis')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-3 mb-3 row">
                <label for="name" class="col-sm-2 col-form-label @error('name') is-invalid @enderror">Nama :</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-3 mb-3 row">
                <label for="rayon_id" class="col-sm-2 col-form-label @error('rayon_id') is-invalid @enderror">Rayon :</label>
                <div class="col-sm-10">
                    <select name="rayon_id" id="rayon_id" class="form-control">
                        <option selected hidden disabled>Pilih</option>
                        @foreach ($rayons as $rayon)
                            <option value="{{$rayon->id}}">{{$rayon->rayon}}</option>
                        @endforeach
                    </select>
                    @error('rayon_id')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-3 mb-3 row">
                <label for="rombel_id" class="col-sm-2 col-form-label @error('rombel_id') is-invalid @enderror">Rombel :</label>
                <div class="col-sm-10">
                    <select name="rombel_id" id="rombel_id" class="form-control">
                        <option selected hidden disabled>Pilih</option>
                        @foreach ($rombels as $rombel)
                            <option value="{{$rombel->id}}">{{$rombel->rombel}}</option>
                        @endforeach
                    </select>
                    @error('rombel_id')
                        <div class="text-danger">{{$message}}</div>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Submit</button>
        </form>
    </div>
@endsection
