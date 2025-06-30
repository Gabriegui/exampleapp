<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Politico;
use App\Models\Pessoa;
use App\Rules\UniqueInSchema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Show the login page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Nome' => 'required',
            'Partido' => 'required',
            'Urna' => 'required',
            'Apelido' => ['required', new UniqueInSchema('public', 'politicos', 'Nome_guerra')],
        ]);

        $pessoa = Pessoa::where('Nome', $request->Nome)->first();

        if (!$pessoa) {
            return back()->withErrors([
                'Nome' => 'Pessoa não registrada. Vá até a tela de registro de pessoas.',
            ])->withInput();
        } 

        Politico::create([
            'user_id' => $pessoa->id,
            'partido' => $request->Partido,
            'numero_urna' => $request->Urna,
            'Nome_guerra' => $request->Apelido,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return to_route('dashboard')->with('success', 'Politico registrado com sucesso.');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
