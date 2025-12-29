<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Request $request): View
    {
        return $request->is('admin/*') ? view('auth.register') : view('frontend.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        // Determine guard
        $isAdmin = $request->is('admin/*');
        $guard = $isAdmin ? 'admin' : 'web';

        Auth::guard($guard)->login($user);

        return $isAdmin
            ? redirect()->route('admin.dashboard')
            : redirect(route('frontend.login')); // Redirect to login after registration or home? 
            // Actually, Breeze usually redirects to 'home'.
            // But if they are logged in, they can go home.
            // Let's stick to 'home' as before, but ensure 'home' is valid.
    }
}
