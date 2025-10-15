@extends('admin.layouts.app')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Admin Dashboard</h1>

    <!-- 1️⃣ Overview Cards -->
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Total Jobs</h5>
                    <h3>120</h3>
                    <small>Active: 80 | Pending: 25 | Expired: 15</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Total Employers</h5>
                    <h3>50</h3>
                    <small>Verified: 35 | Unverified: 15</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Total Candidates</h5>
                    <h3>300</h3>
                    <small>Active: 250 | Pending: 50</small>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm text-center">
                <div class="card-body">
                    <h5>Applications</h5>
                    <h3>450</h3>
                    <small>Reviewed: 300 | Pending: 150</small>
                </div>
            </div>
        </div>
    </div>

    <!-- 2️⃣ Recent Activity Section -->
    <div class="row mt-5">
        <div class="col-md-4">
            <h5>Recent Jobs</h5>
            <ul class="list-group">
                <li class="list-group-item">Software Engineer <br><small>Posted on: 20-09-2025</small></li>
                <li class="list-group-item">Web Developer <br><small>Posted on: 18-09-2025</small></li>
                <li class="list-group-item">UI/UX Designer <br><small>Posted on: 17-09-2025</small></li>
                <li class="list-group-item">Data Analyst <br><small>Posted on: 16-09-2025</small></li>
                <li class="list-group-item">Project Manager <br><small>Posted on: 15-09-2025</small></li>
            </ul>
        </div>

        <div class="col-md-4">
            <h5>Recent Employers</h5>
            <ul class="list-group">
                <li class="list-group-item">ABC Corp <br><small>Joined: 20-09-2025</small></li>
                <li class="list-group-item">XYZ Pvt Ltd <br><small>Joined: 18-09-2025</small></li>
                <li class="list-group-item">Tech Solutions <br><small>Joined: 17-09-2025</small></li>
                <li class="list-group-item">SoftTech <br><small>Joined: 16-09-2025</small></li>
                <li class="list-group-item">Global InfoTech <br><small>Joined: 15-09-2025</small></li>
            </ul>
        </div>

        <div class="col-md-4">
            <h5>Recent Candidates</h5>
            <ul class="list-group">
                <li class="list-group-item">Shalini Tiwari <br><small>Registered: 20-09-2025</small></li>
                <li class="list-group-item">Rohit Kumar <br><small>Registered: 19-09-2025</small></li>
                <li class="list-group-item">Anita Singh <br><small>Registered: 18-09-2025</small></li>
                <li class="list-group-item">Vikram Yadav <br><small>Registered: 17-09-2025</small></li>
                <li class="list-group-item">Pooja Sharma <br><small>Registered: 16-09-2025</small></li>
            </ul>
        </div>
    </div>

    <!-- 3️⃣ Chart Section -->
    <div class="row mt-5">
        <div class="col-md-12">
            <h5>Overview Chart</h5>
            <canvas id="dashboardChart" height="100"></canvas>
        </div>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var ctx = document.getElementById('dashboardChart').getContext('2d');
var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jobs', 'Employers', 'Candidates', 'Applications'],
        datasets: [{
            label: 'Total Count',
            data: [120, 50, 300, 450],
            backgroundColor: ['#007bff', '#28a745', '#ffc107', '#dc3545']
        }]
    },
    options: { responsive: true }
});
</script>
@endsection
