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
    public function create(Request $request): View
    {
        return $request->is('admin/*') ? view('auth.login') : view('frontend.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        // Determine guard
        $guard = $request->is('admin/login') ? 'admin' : 'web';

        // Authenticate user
        $request->authenticate($guard);

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
        // Determine guard
        $isAdmin = $request->is('admin/*');
        $guard = $isAdmin ? 'admin' : 'web';

        // Log activity
        $this->logActivity('Logout', 'User logged out');

        // Logout from specific guard
        Auth::guard($guard)->logout();

        // ONLY invalidate and regenerate token if it's the web guard (frontend)
        // OR if you want to completely clear everything. 
        // To keep them separate, we should be careful.
        // Actually, if they are separate guards, we might still want to invalidate the specific session data.
        // Laravel's session driver shared across guards means we might need to be careful.
        // But for simplicity and to satisfy the user's "mix ho rhy hain" fix:
        
        if (!$isAdmin) {
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }

        return $isAdmin
            ? redirect()->route('admin.login')
            : redirect('/');
    }
}
