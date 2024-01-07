@extends('layouts.template')

@section('content')
    <div class="card mt-3">
        <div class="card-body p-5">
            <h3 class="card-title mb-4 fw-bold">Edit Rombel</h3>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif

            <form action="{{ route('rombel.update', $rombels['id']) }}" method="POST">
                @csrf
                @method('PATCH')

                <div class="mb-3">
                    <label for="rombel" class="form-label">Rombel :</label>
                    <input type="text" class="form-control" id="rombel" name="rombel" value="{{ $rombels['rombel'] }}">
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
