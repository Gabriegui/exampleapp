<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration page.
     */
    public function create(): Response
    {
        return Inertia::render('auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Nome' => 'required|unique:_pessoa,Nome',
            'Endereço' => 'required',
            'CPF' => 'required|unique:_pessoa,CPF|max:20',
            'Gênero' => 'required',
        ]);

        Pessoa::create([
            'Nome' => $request->Nome,
            'Endereço' => $request->Endereço,
            'CPF' => $request->CPF,
            'Gênero' => $request->Gênero,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return to_route('dashboard')->with('success', 'Pessoa registrada com sucesso.');
    }
}
