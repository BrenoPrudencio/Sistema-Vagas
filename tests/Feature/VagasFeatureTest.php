<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Vaga;

class VagasFeatureTest extends TestCase
{
    /**
     * Esta "trait" reseta o banco de dados em memória antes de CADA teste.
     * Isso garante que um teste não interfira no resultado do outro.
     */
    use RefreshDatabase;

    /**
     * Testa se a página de listagem de vagas pode ser renderizada com sucesso.
     *
     * @return void
     */
    public function test_vagas_index_page_can_be_rendered(): void
    {
        // AÇÃO: Simula um usuário visitando a URL /vagas
        $response = $this->get(route('vagas.index'));

        // VERIFICAÇÕES :
        // 1. Verifica se a página carregou com sucesso
        $response->assertStatus(200);

        // 2. Verifica se o texto "Lista de Vagas" aparece na tela
        $response->assertSee('Lista de Vagas');
    }

    /**
     * Testa se uma vaga criada aparece na página de listagem.
     *
     * @return void
     */
    public function test_a_created_vaga_appears_on_the_index_page(): void
    {
        //Cria uma vaga de teste no banco de dados em memória
        $vaga = Vaga::factory()->create([
            'titulo' => 'Vaga de Teste Específica'
        ]);

        //Visita a página de listagem de vagas
        $response = $this->get(route('vagas.index'));

        // Verifica se o título da vaga que acabamos de criar aparece na tela
        $response->assertSee('Vaga de Teste Específica');
    }

    /**
     * Testa se uma vaga pode ser criada através do formulário.
     *
     * @return void
     */
    public function test_a_vaga_can_be_created_via_form(): void
    {
        // 1. Prepara os dados da vaga que vai ser enviado
        $vagaData = [
            'titulo' => 'Nova Vaga de Teste de Criação',
            'descricao' => 'Descrição completa da vaga de teste.',
            'tipo_contratacao' => 'CLT',
        ];

        // 2. Simula o envio do formulário (uma requisição POST) para a rota de 'store'
        $response = $this->post(route('vagas.store'), $vagaData);

        // 3. VERIFICAÇÕES:
        
        // 3.1. Verifica se foi redirecionado para a página de listagem
        $response->assertRedirect(route('vagas.index'));

        // 3.2. Verifica se a vaga realmente existe no banco de dados
        $this->assertDatabaseHas('vagas', [
            'titulo' => 'Nova Vaga de Teste de Criação'
        ]);

        // 3.3. Verifica se a sessão tem a mensagem de sucesso
        $response->assertSessionHas('success', 'Vaga criada com sucesso!');
    }
    
    /**
     * Testa se a validação falha ao tentar criar uma vaga sem título.
     *
     * @return void
     */
    public function test_vaga_creation_fails_with_invalid_data(): void
    {
        // 1. Prepara os dados da vaga, mas deixa o TÍTULO em branco
        $vagaData = [
            'titulo' => '',
            'descricao' => 'Descrição válida para o teste de falha.',
            'tipo_contratacao' => 'PJ',
        ];

        // 2. Simula o envio do formulário com os dados inválidos
        $response = $this->post(route('vagas.store'), $vagaData);

        // 3. VERIFICAÇÕES:

        // 3.1. Verifica se a sessão contém um erro de validação para o campo 'titulo'
        $response->assertSessionHasErrors('titulo');

        // 3.2. Verifica se a vaga NÃO FOI criada no banco de dados
        $this->assertDatabaseMissing('vagas', [
            'descricao' => 'Descrição válida para o teste de falha.'
        ]);
    }
}