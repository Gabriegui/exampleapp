<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Pessoa;
use App\Models\Politico;
use App\Rules\UniqueInSchema;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller{
    public function create(): Response{
        return Inertia::render('auth/Login');
    }

    public function store(Request $request): RedirectResponse{
        $request->validate([
            'Nome' => 'required',
            'Partido' => 'required',
            'Urna' => 'required',
            'Apelido' => ['required', new UniqueInSchema('public', 'politicos', 'Nome_guerra')],
            'Eleicao' => 'required',
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
            'ano_eleicao' => $request->Eleicao,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return to_route('lista-politicos')->with('success', 'Politico registrado com sucesso.');
    }

    public function show(){
        $politicos = Politico::all();

        return Inertia::render('Lista-politicos', [
            'politicos' => $politicos,
        ]);
    }
    
    public function edit($id){
        $politico = Politico::findOrFail($id);
        return Inertia::render('Edit-politico', [
            'politico' => $politico,
        ]);
    }

    public function update(Request $request, $id){

        $politico = Politico::findOrFail($id);

        $validated = $request->validate([
            'Nome_guerra' => 'required',
            'numero_urna' => 'required',
            'partido' => 'required',
            'ano_eleicao' => 'required'
        ]);

        
        $politico->update($validated);
        
        return to_route('lista-politicos')->with('success', 'Politico editado com sucesso.');
    }

    public function destroy($id){
        $politico = Politico::findOrFail($id);
        $politico->delete();
        return to_route('lista-politicos')->with('success', 'Politico deletado com sucesso.');
    }
}
