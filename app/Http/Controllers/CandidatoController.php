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
        // Pega o valor de itens por página da requisição, com um padrão de 20
        $perPage = $request->input('per_page', 20);

        // Inicia a construção da consulta ao banco
        $query = Candidato::query();

        // Adiciona a condição de busca SE o parâmetro 'search' existir na requisição
        $query->when($request->search, function ($q) use ($request) {
            return $q->where(function ($subQuery) use ($request) {
                $subQuery->where('nome', 'like', '%' . $request->search . '%')
                         ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        });

        // Ordena e executa a paginação com o valor de $perPage, mantendo os filtros nos links
        $candidatos = $query->orderBy('id', 'asc')->paginate($perPage)->withQueryString();

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
        // Este método pode ser usado no futuro para ver detalhes de um candidato
        // Note que não criamos a view 'candidatos.show', então isso daria erro se chamado.
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

    /**
     * 
     * NOVO MÉTODO PARA DELEÇÃO EM MASSA
     */
    public function destroyMass(Request $request)
    {
        // Valida se 'ids' foi enviado e se é um array de IDs existentes na tabela candidatos
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:candidatos,id', 
        ]);

        // Deleta todos os candidatos cujos IDs estão no array
        Candidato::destroy($request->ids);

        return redirect()->route('candidatos.index')
                         ->with('success', 'Candidatos selecionados excluídos com sucesso!');
    }
}