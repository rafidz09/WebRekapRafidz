@extends('layouts.template')

@section('content')
    <form action="{{ route('admin.student.update', $student->id) }}" method="POST" class="card mt-3 p-5">
        @method('PATCH')
        @csrf {{-- Add this line to include CSRF token --}}

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <h3 class="mb-4">Edit Data Siswa</h3>
        
        <div class="mb-3 row">
            <label for="nis" class="col-sm-2 col-form-label">Nis :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="nis" name="nis" value="{{ $student->nis }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="name" class="col-sm-2 col-form-label">Nama :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="name" name="name" value="{{ $student->name }}">
            </div>
        </div>

        <div class="mb-3 row">
            <label for="rombel_id" class="col-sm-2 col-form-label">Rombel :</label>
            <div class="col-sm-10">
                <select name="rombel_id" id="rombel_id" class="form-select">
                    <option selected disabled>Pilih Rombel</option>
                    @foreach ($rombels as $rombel)
                        <option value="{{ $rombel->id }}" {{ $rombel->id == $student->rombel_id ? 'selected' : '' }}>
                            {{ $rombel->rombel }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-3 row">
            <label for="rayon_id" class="col-sm-2 col-form-label">Rayon :</label>
            <div class="col-sm-10">
                <select name="rayon_id" id="rayon_id" class="form-select">
                    <option selected disabled>Pilih Rayon</option>
                    @foreach ($rayons as $rayon)
                        <option value="{{ $rayon->id }}" {{ $rayon->id == $student->rayon_id ? 'selected' : '' }}>
                            {{ $rayon->rayon }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="mb-3 text-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
@endsection
