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
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'type' => ['required', 'in:Persoană fizică,Agent imobiliar'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'company_name' => ['nullable', 'string', 'max:255', 'required_if:type,Agent imobiliar'],
            'cui' => ['nullable', 'string', 'max:20', 'required_if:type,Agent imobiliar'],
            'company_address' => ['nullable', 'string', 'max:255', 'required_if:type,Agent imobiliar'],
            'check' => ['accepted'],
        ], [
            'type.required' => 'Te rog să selectezi tipul de utilizator.',
            'type.in' => 'Tipul de utilizator trebuie să fie Persoană fizică sau Juridică.',
            'name.required' => 'Numele este obligatoriu.',
            'email.required' => 'Adresa de email este obligatorie.',
            'email.email' => 'Adresa de email trebuie să fie validă.',
            'email.unique' => 'Această adresă de email este deja folosită.',
            'password.required' => 'Parola este obligatorie.',
            'password.confirmed' => 'Parolele nu coincid.',
            'company_name.required_if' => 'Numele companiei este obligatoriu pentru utilizatorii juridici.',
            'cui.required_if' => 'CUI-ul este obligatoriu pentru utilizatorii juridici.',
            'company_address.required_if' => 'Adresa companiei este obligatorie pentru utilizatorii juridici.',
            'check.accepted' => 'Trebuie să accepți termenii și condițiile pentru a continua.',
        ]);

        $user = User::create([
            'type' => $request->type,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'company_name' => $request->type === 'Agent imobiliar' ? $request->company_name : null,
            'cui' => $request->type === 'Agent imobiliar' ? $request->cui : null,
            'company_address' => $request->type === 'Agent imobiliar' ? $request->company_address : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

}
