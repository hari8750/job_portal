<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home'; // ✅ Commented out since authenticated() handles redirection

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Redirect users after authentication based on role.
     */
    protected function authenticated(Request $request, $user)
    {
        // Normalize role to lowercase and trim spaces
        $role = trim(strtolower($user->role));

        if ($role === 'employer') {
            return redirect('/employer/dashboard');
        } else {
            return redirect('/candidate/dashboard');
        }
    }
}
