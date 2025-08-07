<?php

namespace App\Http\Controllers;

use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Candidato::query();

        $query->when($request->search, function ($q) use ($request) {
            // Adiciona uma cláusula WHERE que busca em MÚLTIPLAS colunas
            return $q->where(function ($subQuery) use ($request) {
                $subQuery->where('nome', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        });

        $candidatos = $query->orderBy('id', 'asc')->paginate(20)->withQueryString();

        return view('candidatos.index', ['candidatos' => $candidatos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('candidatos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos,email',
            'telefone' => 'required|string|max:20',
        ]);

        $dadosCandidato = $request->all();
        $dadosCandidato['telefone'] = preg_replace('/[^0-9]/', '', $request->telefone);

        Candidato::create($dadosCandidato);

        return redirect()->route('candidatos.index')
                         ->with('success', 'Candidato criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Candidato $candidato)
    {
        return view('candidatos.show', ['candidato' => $candidato]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Candidato $candidato)
    {
        return view('candidatos.edit', ['candidato' => $candidato]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Candidato $candidato)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos,email,' . $candidato->id,
            'telefone' => 'required|string|max:20',
        ]);

        $dadosCandidato = $request->all();
        $dadosCandidato['telefone'] = preg_replace('/[^0-9]/', '', $request->telefone);

        $candidato->update($dadosCandidato);

        return redirect()->route('candidatos.index')
                         ->with('success', 'Candidato atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Candidato $candidato)
    {
        $candidato->delete();

        return redirect()->route('candidatos.index')
                         ->with('success', 'Candidato excluído com sucesso!');
    }
}