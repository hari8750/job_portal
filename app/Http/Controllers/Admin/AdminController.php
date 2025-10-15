<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// ✅ Import models
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\EmployerProfile;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        // Count jobs
        $jobs_count = Job::count();

        // Count employers (from employer_profiles table)
        $employers_count = EmployerProfile::count();

        // Count candidates (from job_applications table)
        $candidates_count = JobApplication::count();

        return view('admin.dashboard', compact('jobs_count', 'employers_count', 'candidates_count'));
    }
}
