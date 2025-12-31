<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Traits\LogsActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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

        // Strict Guard Separation: Logout from the other guard
        if ($guard === 'admin') {
            Auth::guard('web')->logout();
        } else {
            Auth::guard('admin')->logout();
        }

        // Redirect based on request path
        if ($request->is('admin/login')) {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Determine if this is an admin logout request
        $isAdmin = $request->is('admin/*') || $request->routeIs('admin.*');
        $guard = $isAdmin ? 'admin' : 'web';

        // Log activity before session is cleared
        $this->logActivity('Logout', ($isAdmin ? 'Admin' : 'User') . ' logged out');

        // Logout from specific guard
        Auth::guard($guard)->logout();

        // Invalidate and regenerate token for the current session
        // This is safe even for separate guards as it clears transient data
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($isAdmin) {
            // Check if admin.login route exists to prevent RouteNotFoundException
            return Route::has('admin.login') 
                ? redirect()->route('admin.login') 
                : redirect('/admin/login');
        }

        // Default frontend redirect
        return Route::has('home') 
            ? redirect()->route('home') 
            : redirect('/');
    }
}
