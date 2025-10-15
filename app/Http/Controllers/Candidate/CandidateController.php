<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // ✅ correct place
use App\Models\JobApplication; // For jobs list

class CandidateController extends Controller
{
    // Candidate Dashboard
    public function dashboard()
    {
        return view('candidate.dashboard');
    }

    // Candidate Jobs
    public function jobs()
    {
        // Fetch all jobs applied by the logged-in candidate
        $jobs = JobApplication::where('candidate_id', Auth::id())
                    ->with('job') // make sure JobApplication has 'job' relationship
                    ->get();

        return view('candidate.jobs', compact('jobs'));
    }

    // Candidate Profile
    public function profile()
    {
        $user = Auth::user(); // login user ka data
        return view('candidate.profile', compact('user'));
    }

    // Candidate Notifications
    public function notifications()
    {
        // Fetch notifications for the logged-in candidate
        $notifications = Auth::user()->notifications ?? collect();

        return view('candidate.notifications', compact('notifications'));
    }

    // Profile Update (only name, phone, city)
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
        ]);

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->city = $request->city; // Updated to save city

        $user->save();

        return redirect()->route('candidate.profile')->with('success', 'Profile updated successfully!');
    }
}
