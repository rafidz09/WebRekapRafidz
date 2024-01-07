@extends('layouts.template')

@section('content')
<div class="mt-3">
  <h3 class="mb-4">Tambah Data Rayon</h3>
  <div class="mt-3 d-flex flex-row">
      <p class="me-3"><a href="{{ route('rayon.index') }}" class="fw-bold text-decoration-none">Data Rayon</a></p>
  </div>

  <form action="{{ route('rayon.store') }}" method="POST" class="card p-4 mt-4">
      @csrf
      <h5 class="mb-3">Tambah Data Rayon</h5>
      <div class="mt-3 mb-3 row">
          <label for="rayon" class="col-sm-3 col-form-label @error('rayon') is-invalid @enderror">Rayon :</label>
          <div class="col-sm-9">
              <input type="text" class="form-control" id="rayon" name="rayon" value="{{ old('rayon') }}">
              @error('rayon')
              <div class="text-danger">{{$message}}</div>
              @enderror
          </div>
      </div>
      <div class="mt-3 mb-3 row">
          <label for="user_id" class="col-sm-3 col-form-label @error('user_id') is-invalid @enderror">Pembimbing Siswa :</label>
          <div class="col-sm-9">
              <select name="user_id" id="user_id" class="form-control">
                  <option selected hidden disabled>Pilih</option>
                  @foreach ($users as $item)
                      <option value="{{ $item->id }}">{{ $item->name }}</option>
                  @endforeach
              </select>
              @error('user_id')
              <div class="text-danger">{{$message}}</div>
              @enderror
          </div>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
</div>
@endsection
