@extends('layouts.template')

@section('content')
<style>
    .card-link {
        text-decoration: none;
    }
</style>

@if(Auth::check())
@if (Auth::user()->role == 'admin')
<div class="jumbotron py-5 px-3" style="margin-top: -2rem;">
    <h4>Dashboard</h4>
    <a>Home</a>
    <hr class="my-4">
    <div class="row">
        <div class="col-md-4 mb-4">
            <a href="" class="card-link">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">Rombel</h5>
                        {{ App\Models\Rombel::where('id', '!=', '')->count() }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="" class="card-link">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">Peserta Didik</h5>
                        {{ App\Models\student::where('id', '!=', '')->count() }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-4 mb-4">
            <a href="" class="card-link">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">Rayon</h5>
                        {{ App\Models\rayon::where('id', '!=', '')->count() }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 mb-4">
            <a href="" class="card-link">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">Administrator</h5>
                        {{ App\Models\user::where('role', 'admin')->count() }}
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-6 mb-4">
            <a href="" class="card-link">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="text-prima">Pembimbing Siswa</h5>
                        {{ App\Models\user::where('role', 'ps')->count() }}
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endif

@if (Auth::user()->role == 'ps')
<div class="jumbotron py-5 px-3" style="margin-top: -2rem;">
    <h4>Dashboard</h4>
    <a>Home</a>
    <hr class="my-4">
    <div class="row">

        <div class="col-md-4 mb-4">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">Jumlah Siswa {{ Auth()->user()->rayon->rayon }}</h5>
                        <p>{{ $student }}</p>           
                    </div>
                </div>
            </a>
        </div>
        
        <div class="col-md-6 mb-4">
                <div class="card border shadow h-100 py-2">
                    <div class="card-body">
                        <h5 class="card-title">Keterlambatan {{ Auth()->user()->rayon->rayon }} Hari Ini</h5>
                        <p>{{ $todayLateCount }}</p> 
                    </div>
                </div>
            </a>
        </div>
</div>
@endif
@endif

@endsection
