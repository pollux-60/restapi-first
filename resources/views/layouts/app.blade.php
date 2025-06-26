<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sistem Data Mahasiswa</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/DataTables-1.13.3/css/dataTables.bootstrap5.css') }}">
</head>
<body>
    <div class="d-flex" style="min-height: 100vh;">
        <div class="bg-danger text-white p-3" style="min-height: 220px;">
            <div class="mb-4 text-center">
                <img src="{{ secure_asset('assets/image/logo.png') }}" style="max-width: 180px; height: auto;" alt="">
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link text-white" href="/">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="{{ route('mahasiswa') }}">Data Mahasiswa</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-white">Logout</a>
                </li>
            </ul>
        </div>
        <div class="flex-fill">
            <nav class="navbar navbar-expand-lg navbar-light bg-light px-4 d-flex justify-content-between">
                <span class="navbar-brand">Sistem Akademik</span>
                <div class="ms-auto">
                    <span class="navbar-text">Selamat Datang, {{ Auth::user()->name }}</span>
                </div>
            </nav>
            <div class="p-4">
                @yield("content")
            </div>
        </div>
    </div>

    <script src="{{ secure_asset('assets/jquery-3.6.1.js') }}"></script>
    <script src="{{ secure_asset('assets/bootstrap.min.js') }}"></script>
    <script src="{{ secure_asset('assets/DataTables-1.13.3/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ secure_asset('assets/DataTables-1.13.3/js/dataTables.bootstrap5.min.js') }}"></script>

    @yield('scripts')
</body>
</html>
