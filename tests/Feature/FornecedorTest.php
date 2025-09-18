<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class FornecedorTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function pode_criar_fornecedor_com_sucesso()
    {
        $payload = [
            'nome'  => 'Fornecedor X',
            'cnpj'  => '12345678000195',
            'email' => 'x@y.com',
        ];

        $this->postJson('/api/fornecedores', $payload)
            ->assertCreated()
            ->assertJsonFragment(['nome' => 'Fornecedor X']);

        $this->assertDatabaseHas('fornecedores', $payload);
    }

    #[Test]
    public function nao_pode_criar_fornecedor_com_dados_invalidos()
    {
        $payload = [
            'nome' => 'aa', // muito curto
            'cnpj' => '123', // inválido
        ];

        $this->postJson('/api/fornecedores', $payload)
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['nome', 'cnpj']);
    }

    #[Test]
    public function pode_filtrar_fornecedores_por_nome()
    {
        Fornecedor::factory()->create(['nome' => 'Alpha Corp', 'cnpj' => '11111111111111']);
        Fornecedor::factory()->create(['nome' => 'Beta Ltd', 'cnpj' => '22222222222222']);

        $this->getJson('/api/fornecedores?q=Alpha')
            ->assertOk()
            ->assertJsonCount(1, 'data')
            ->assertJsonFragment(['nome' => 'Alpha Corp']);
    }
}
