<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Jobs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Delivery Jobs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#">Jobs</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Post a Job</a></li>
                    @guest
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link btn btn-primary text-white ms-2" href="{{ route('register') }}">Register</a></li>
                    @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link btn btn-danger text-white ms-2" type="submit">Logout</button>
                        </form>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-light text-center py-5">
        <div class="container">
            <h1 class="display-4">Find Your Dream Job</h1>
            <p class="lead">Browse thousands of job opportunities and apply in one click</p>
            <form class="row g-2 justify-content-center" action="{{ route('jobs.search') }}" method="GET">
                <div class="col-md-4">
                    <input type="text" class="form-control" name="keyword" placeholder="Job title or keyword">
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" name="location" placeholder="Location">
                </div>
                <div class="col-md-2">
                    <button class="btn btn-primary w-100">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Featured Jobs -->
    <section class="container py-5">
        <h2 class="mb-4 text-center">🚴 Delivery Jobs</h2>
        <div class="row">
            @foreach($jobs as $job)
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5>{{ $job->title }}</h5>
                        <p>{{ $job->company }}</p>
                        <p><strong>Salary:</strong> {{ $job->salary }}</p>
                        <p><strong>Location:</strong> {{ $job->location }}</p>
                        <a href="{{ url('jobs/'.$job->id) }}" class="btn btn-outline-primary btn-sm">Apply Now</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white text-center py-3">
        <p>© {{ date('Y') }} JobPortal. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
