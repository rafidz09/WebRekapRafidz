<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Project Keterlambatan</a>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
            <div class="collapse navbar-collapse">
                @auth
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                            <span class="nav-link">
                                <i class="bi bi-person-circle"></i> 
                                <span class="fw-bold" style="font-size: 1.2em;">{{ Auth::user()->role }}</span>
                            </span>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
    <style>
        body {
            background-color: #f8f9fa;
        }

        .navbar {
            border-bottom: none;
        }

        .navbar-dark .navbar-nav .nav-link {
            color: #007bff;
        }

        .navbar-dark .navbar-nav .nav-link:hover {
            color: #007bff;
        }

        .navbar-dark .navbar-brand {
            color: #007bff;
        }

        .navbar-dark .navbar-brand:hover {
            color: #007bff;
        }

        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #007bff;
            padding-top: 56px;
        }

        .sidebar a {
            padding: 8px 16px;
            text-decoration: none;
            font-size: 18px;
            color: #ffffff;
            display: flex;
            align-items: center;
            transition: 0.3s;
        }

        .sidebar a i {
            margin-right: 10px; /* Adjust as needed */
        }

        .sidebar a:hover {
            background-color: #0056b3;
            color: #ffffff;
        }

        .content {
            margin-left: 250px;
            padding: 16px;
            transition: margin-left 0.3s;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .logout {
            position: absolute;
            bottom: 16px;
            left: 16px;
            padding: 8px 16px;
            color: #ffffff;
            border-radius: 5px;
            transition: 0.3s;
        }

        .logout:hover {
            background-color: #0056b3;
            color: #ffffff;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                height: auto;
                position: relative;
                padding-top: 3.5rem;
            }

            .content {
                margin-left: 0;
            }

            .logout {
                position: relative;
                top: 0;
                left: 0;
                margin-top: 16px;
                margin-left: 16px;
            }

            .h1 {

            }
        }
    </style>
</head>
<body>
    @if(Auth::check())
    @if (Auth::user()->role == 'ps')
    <div class="sidebar">
        <div class="mb-3 text-center">
            <h4 class="font-weight-bold text-white">REKAM KETERLAMBATAN</h4>
        </div>
        <a href="/dashboard" class="nav-link">Dashboard</a>
        <a href="{{ route('ps.student.data', '[id]') }}" class="nav-link">Data Siswa</a>
        <a href="{{ route('ps.user.data') }}" class="nav-link">
            <i class="bi bi-clock-fill"></i> Data Keterlambatan
        </a>
        <a class="nav-link logout" href="{{ route('logout')}}">
            <i class="bi bi-box-arrow-right"></i> Logout
        </a>
    </div>
    @endif

@if(Auth::user()->role == 'admin')
<div class="sidebar">
    <div class="mb-3 text-center">
        <h4 class="font-weight-bold text-white">REKAM KETERLAMBATAN</h4>
    </div>
    <a href="/dashboard" class="nav-link">Dashboard</a>
    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="collapse" data-bs-target="#dataMaster">
        <i class="bi bi-gear-fill"></i> Data Master
    </a>
    <div class="collapse" id="dataMaster">
        <ul class="list-unstyled">
            <li><a href="{{ route('rombel.index')}}" class="nav-link">Data Rombel</a></li>
            <li><a href="{{ route('rayon.index') }}" class="nav-link">Data Rayon</a></li>
            <li><a href="{{ route('admin.student.index') }}" class="nav-link">Data Siswa</a></li>
            <li><a href="{{ route('user1.index')}}" class="nav-link">Data User</a></li>
        </ul>
    </div>
    <a href="{{ route('admin.user.index') }}" class="nav-link">
        <i class="bi bi-clock-fill"></i> Data Keterlambatan
    </a>
    <a class="nav-link logout" href="{{ route('logout')}}">
        <i class="bi bi-box-arrow-right"></i> Logout
    </a>
</div>
@endif
@endif
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

@stack('script')
