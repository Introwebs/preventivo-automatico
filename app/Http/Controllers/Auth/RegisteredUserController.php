<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(
            [
                'name' => 'required|string|max:50',
                'email' => 'required|string|lowercase|email|max:150|unique:'.User::class,
                'password' => ['required', 'confirmed', Rules\Password::defaults()],
            ],
            [
                'required' => '* Compila questo campo.',
                'confirmed' => '* Le password inserite non corrispondono.',
                'lowercase' => '* Sono ammessi solo caratteri minuscoli.',
                'name.max' => '* Massimo 50 caratteri consentiti.',
                'email.max' => '* Massimo 150 caratteri consentiti.',
                'email.email' => '* Inserisci un\'indirizzo email valido.',
                'email.unique' => '* L\'email risulta essere già registrata.',
            ]
        );

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'last_login_at' => now(),
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
