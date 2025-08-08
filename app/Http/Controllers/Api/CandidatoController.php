<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Candidato;
use Illuminate\Http\Request;

class CandidatoController extends Controller
{
    /**
     * Retorna uma lista paginada de candidatos.
     */
    public function index()
    {
        return Candidato::paginate(10);
    }

    /**
     * Cria um novo candidato.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:candidatos,email',
            'telefone' => 'required|string|max:20',
        ]);

        // Limpa a máscara do telefone antes de salvar
        $dados = $request->all();
        $dados['telefone'] = preg_replace('/[^0-9]/', '', $request->telefone);

        $candidato = Candidato::create($dados);

        return response()->json($candidato, 201);
    }

    /**
     * Retorna os detalhes de um candidato específico.
     */
    public function show(Candidato $candidato)
    {
        return $candidato;
    }

    /**
     * Atualiza um candidato existente.
     */
    public function update(Request $request, Candidato $candidato)
    {
        $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:candidatos,email,' . $candidato->id,
            'telefone' => 'sometimes|string|max:20',
        ]);

        $dados = $request->all();
        if ($request->has('telefone')) {
            $dados['telefone'] = preg_replace('/[^0-9]/', '', $request->telefone);
        }

        $candidato->update($dados);

        return response()->json($candidato);
    }

    /**
     * Exclui um candidato.
     */
    public function destroy(Candidato $candidato)
    {
        $candidato->delete();

        return response()->json(null, 204);
    }
}