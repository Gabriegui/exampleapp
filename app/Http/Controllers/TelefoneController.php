<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Telefone;
use App\Models\Pessoa;
use App\Rules\UniqueInSchema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class TelefoneController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('auth/Telefones');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'Nome' => 'required',
            'Telefone' => ['required', new UniqueInSchema('public', 'telefones', '_numero')],
        ]);

        $pessoa = Pessoa::where('Nome', $request->Nome)->first();

        if (!$pessoa) {
            return back()->withErrors([
                'Nome' => 'Pessoa não registrada. Vá até a tela de registro de pessoas.',
            ])->withInput();
        } 

        Telefone::create([
            'user_id' => $pessoa->id,
            '_numero' => $request->Telefone,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return to_route('dashboard')->with('success', 'Telefone registrado com sucesso.');
    }
}
