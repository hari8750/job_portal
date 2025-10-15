<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        // Yaha notification fetch karenge
        $notifications = auth()->user()->notifications;
        return view('candidate.notifications', compact('notifications'));
    }
}

