<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('candidate.jobs', compact('jobs'));
    }

    public function apply(Job $job)
    {
        // Job apply logic yaha aayega
        return back()->with('success', 'Applied successfully!');
    }
}


