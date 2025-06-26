<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('assets/bootstrap.min.css') }}">
</head>
<style>
    body {
        background: url("{{ asset('pemandangan.jpg') }}") no-repeat center center fixed;
        background-size: cover;
    }

    .bg-overlay {
        background-color: rgba(255, 255, 255, 0.8);
        backdrop-filter: blur(5px);
        border-radius: 12px;
        padding: 20px;
    }
</style>

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

<div class="card shadow" style="width: 400px;">
    <div class="card-body">
        <h5 class="card-title text-center mb-4">Login</h5>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input
                    type="email"
                    class="form-control"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                >
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input
                    type="password"
                    class="form-control"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
    </div>
</div>

</body>
</html>
