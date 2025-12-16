<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EmployerProfile;
use App\Models\Job; // Make sure you import Job model
use App\Models\JobApplication;
use Illuminate\Support\Facades\Auth;

class EmployerController extends Controller
{
    // Show the employer profile (GET)
    public function profile()
    {
        // Fetch logged-in employer profile
        $employer = EmployerProfile::firstOrCreate(['user_id' => auth()->id()]);
        
        return view('employer.profile', compact('employer'));
    }

    // Update the employer profile (POST)
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'company_name' => 'required|string|max:255',
            'address'      => 'nullable|string|max:255',
            'description'  => 'nullable|string|max:1000', 
            'aadhar_card'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Fetch or create profile
        $profile = EmployerProfile::firstOrNew(['user_id' => $user->id]);

        $profile->company_name = $request->company_name;
        $profile->address      = $request->address;
        $profile->description  = $request->description;

        // Handle Aadhar card upload
        if ($request->hasFile('aadhar_card')) {
            $aadharFile = $request->file('aadhar_card');
            $aadharName = time() . '_aadhar.' . $aadharFile->getClientOriginalExtension();
            $aadharFile->move(public_path('uploads/aadhar'), $aadharName);
            $profile->aadhar_card = $aadharName;
        }

        $profile->save();

        return redirect()->route('employer.profile')
                         ->with('success', 'Profile updated successfully.');
    }

    // Show the job posting form
    public function create()
    {
        return view('employer.post_job'); // Blade view for posting job
    }

    // Store a new job
    public function storeJob(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'company'     => 'required|string|max:255',
            'location'    => 'required|string|max:255',
            'salary'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
        ]);

        Job::create([
            'employer_id' => Auth::id(),
            'title'       => $request->title,
            'company'     => $request->company,
            'location'    => $request->location,
            'salary'      => $request->salary,
            'description' => $request->description,
            'status'      => 'Active', // default status
        ]);

        return redirect()->route('employer.dashboard')
                         ->with('success', 'Job posted successfully!');
    }

    // Dashboard showing all jobs of logged-in employer with applications count
    public function dashboard()
    {
        $applications = Job::where('employer_id', Auth::id())
                           ->withCount('applications') // adds applications_count
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('employer.applications', compact('applications'));
    }

    // Applications page for employer (all jobs)
    public function applications()
    {
        $applications = Job::where('employer_id', Auth::id())
                           ->withCount('applications')
                           ->orderBy('created_at', 'desc')
                           ->get();

        return view('employer.applications', compact('applications'));
    }

    // Show candidates who applied for a specific job
    public function appliedCandidates($jobId)
    {
        $job = Job::findOrFail($jobId);

        $applications = JobApplication::where('job_id', $jobId)
                                      ->orderBy('created_at', 'desc')
                                      ->get();

        return view('employer.applied', compact('job', 'applications'));
    }

    // Update candidate application status
    public function updateStatus($id, $status)
    {
        $application = JobApplication::findOrFail($id);
        $application->status = $status;
        $application->save();

        return back()->with('success', 'Status updated to '. ucfirst($status));
    }
}
