<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\LogsActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use LogsActivity;

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Authenticate user
        $request->authenticate();

        // Regenerate session
        $request->session()->regenerate();

        // Log activity
        $this->logActivity('Login', 'User logged in successfully');

        /*
        |--------------------------------------------------------------------------
        | Admin vs Frontend Redirect
        |--------------------------------------------------------------------------
        | Laravel 10/11 has no RouteServiceProvider::HOME
        | So we control redirect manually
        */

        // If login request is from admin panel
        if ($request->is('admin/login')) {
            return redirect()->route('admin.dashboard');
        }

        // Default frontend redirect
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Detect if logout is from admin panel
        $isAdmin = $request->is('admin/*');

        // Log activity
        $this->logActivity('Logout', 'User logged out');

        // Logout
        Auth::logout();

        // Invalidate session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect after logout
        return $isAdmin
            ? redirect('/admin/login')
            : redirect('/');
    }
}
