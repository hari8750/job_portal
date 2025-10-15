<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\Candidate\CandidateController;
use App\Http\Controllers\Candidate\ProfileController;
use App\Http\Controllers\Candidate\NotificationController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;


// 🔹 Front page (sab ke liye common)Route::get('/', [JobController::class, 'index'])->name('home');

// 🔹 Job detail page
Route::get('/jobs/{id}', [JobController::class, 'show'])->name('jobs.show');

// 🔹 Apply job page (login required)
Route::get('/jobs/{id}/apply', [JobController::class, 'apply'])
     ->name('jobs.apply')
     ->middleware('auth');

// 🔹 Submit job application (POST)
Route::post('/jobs/{id}/apply', [JobController::class, 'submitApplication'])
     ->name('apply.job')
     ->middleware('auth');

// 🔹 Job search
Route::get('/search', [JobController::class, 'search'])->name('jobs.search');

// 🔹 Dashboard (generic user)
Route::get('/dashboard', function() {
    return view('home'); 
})->name('dashboard')->middleware('auth');

Route::get('/candidate/jobs', [JobController::class, 'candidateJobs'])->name('candidate.jobs');

// ======================
// 🔹 Candidate Routes
// ======================
Route::prefix('candidate')->name('candidate.')->middleware('auth')->group(function () {
    Route::get('/dashboard', [CandidateController::class, 'dashboard'])->name('dashboard');
    Route::get('/jobs', [CandidateController::class, 'jobs'])->name('jobs');
    Route::get('/profile', [CandidateController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [CandidateController::class, 'updateProfile'])->name('profile.update');
    Route::get('/notifications', [CandidateController::class, 'notifications'])->name('notifications');
});

// ======================
// 🔹 Employer Routes
// ======================
Route::prefix('employer')->middleware('auth')->group(function () {
    // Dashboard
    Route::get('/dashboard', [EmployerController::class, 'dashboard'])->name('employer.dashboard');

    // Job posting
    Route::get('/post-job', [EmployerController::class, 'create'])->name('employer.post_job');
    Route::post('/post-job', [EmployerController::class, 'storeJob'])->name('employer.postjob.store');

    // Applications
    Route::get('/applications', [EmployerController::class, 'applications'])->name('employer.applications');

    // Profile
    Route::get('/profile', [EmployerController::class, 'profile'])->name('employer.profile');
    Route::post('/profile/update', [EmployerController::class, 'update'])->name('employer.profile.update');

    // Applied candidates of a job
    Route::get('job/{jobId}/applied', [EmployerController::class, 'appliedCandidates'])->name('employer.appliedCandidates');

    // Update application status
    Route::get('application/{id}/update/{status}', [EmployerController::class, 'updateStatus'])->name('employer.updateStatus');

    // Job actions
    Route::get('/jobs/{id}/duplicate', [JobController::class, 'duplicate'])->name('jobs.duplicate');
    Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
    Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
    Route::get('/jobs/{id}/repost', [JobController::class, 'repost'])->name('jobs.repost');
    Route::delete('/jobs/{id}', [JobController::class, 'destroy'])->name('jobs.destroy');
});

// ======================
Route::get('admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login.submit');
Route::post('admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('admin/register', [RegisterController::class, 'showRegisterForm'])->name('admin.register');
Route::post('admin/register', [RegisterController::class, 'register'])->name('admin.register.submit');



Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
});


// 🔹 Auth routes (login, register, logout)
Auth::routes();

// 🔹 Optional home redirect after login
// 🔹 Front page (sab ke liye common)
Route::get('/', [JobController::class, 'index'])->name('home');

