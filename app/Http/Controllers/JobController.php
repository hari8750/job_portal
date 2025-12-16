<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\JobApplication; // Updated model import

class JobController extends Controller
{
    // Show all jobs on front page
    public function index()
    {
        $jobs = Job::latest()->get();
        return view('welcome', compact('jobs'));
    }

    // Show job details
    public function show($id)
    {
        $job = Job::findOrFail($id);
        return view('jobs.apply', compact('job')); // Updated view path
    }

    // Apply for a job (GET) – show form
    public function apply($id)
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('redirect_to', url()->current());
        }

        $candidate_id = auth()->id();

        $exists = JobApplication::where('job_id', $id)
                        ->where('candidate_id', $candidate_id)
                        ->first();

        if ($exists) {
            return back()->with('error', 'You have already applied for this job.');
        }

        $job = Job::findOrFail($id);
        return view('jobs.apply', compact('job'));
    }

    // Submit job application (POST)
    public function submitApplication(Request $request, $id)
    {
        $candidate_id = auth()->id();

        $exists = JobApplication::where('job_id', $id)
                                ->where('candidate_id', $candidate_id)
                                ->first();

        if ($exists) {
            return back()->with('error', 'You have already applied for this job.');
        }

        JobApplication::create([
            'candidate_id' => $candidate_id,
            'name' => $request->name,
            'phone' => $request->phone,
            'city' => $request->city,
            'job_id' => $id,
            'status' => 'applied'
        ]);
        
        return redirect()->route('candidate.dashboard')->with('success', 'Job application submitted successfully!');
    }

    public function create()
    {
        return view('employer.post_job'); 
    }

    public function applications()
    {
        $applications = \App\Models\JobApplication::with(['job','candidate'])
            ->whereHas('job', function($q){
                $q->where('employer_id', auth()->id());
            })
            ->get();

        return view('employer.applications', compact('applications'));
    }

    public function showApplication($id)
    {
        $application = \App\Models\JobApplication::with(['job','candidate'])->findOrFail($id);
        return view('employer.application_show', compact('application'));
    }

    // Store a new job (POST)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string',
        ]);

        Job::create([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'salary' => $request->salary,
            'description' => $request->description,
            'employer_id' => auth()->id(),
        ]);

        return redirect()->route('employer.dashboard')->with('success', 'Job posted successfully!');
    }

    // ✅ Duplicate job
    public function duplicate($id)
    {
        $job = Job::findOrFail($id);

        $newJob = $job->replicate();
        $newJob->title = $job->title . ' (Copy)';
        $newJob->created_at = now();
        $newJob->updated_at = now();
        $newJob->save();

        return redirect()->back()->with('success', 'Job duplicated successfully!');
    }

    // ✅ Repost job
    public function repost($id)
    {
        $job = Job::findOrFail($id);
        $job->created_at = now();
        $job->updated_at = now();
        $job->save();

        return redirect()->route('employer.post_job')->with('success', 'Job reposted successfully!');
    }

    // ✅ Delete job
    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->back()->with('success', 'Job deleted successfully!');
    }
        // ✅ Edit job (show edit form)
    public function edit($id)
    {
        $job = Job::findOrFail($id);
        return view('employer.edit_job', compact('job'));
    }

    // ✅ Update job (save changes)
    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'company' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'nullable|string',
        ]);

        $job->update([
            'title' => $request->title,
            'company' => $request->company,
            'location' => $request->location,
            'salary' => $request->salary,
            'description' => $request->description,
        ]);

        return redirect()->route('employer.dashboard')->with('success', 'Job updated successfully!');
    }
   public function postJob(Request $request)
{
    $employerId = auth()->id();
    $status = $request->query('status');

    $jobs = Job::where('employer_id', $employerId)
               ->when($status, function ($query, $status) {
                   $query->where('status', $status);
               })
               ->get();

    return view('employer.post_job', compact('jobs', 'status'));
}
public function dashboard(Request $request)
{
    $status = $request->get('status'); // URL से status ले लो
    
    $query = Job::where('employer_id', auth()->id());

    if ($status) {
        $query->where('status', $status);
    }

    // applications count भी साथ लाना हो तो
    $applications = $query->withCount('applications')->latest()->get();

    return view('employer.dashboard', compact('applications'));
}




}
