<?php

namespace Tests\Feature;

use App\Models\Fornecedor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class FornecedorSoftDeleteTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function pode_remover_fornecedor_sem_exclui_lo_do_banco()
    {
        $fornecedor = Fornecedor::factory()->create([
            'nome'  => 'Fornecedor Soft',
            'cnpj'  => '99999999000199',
            'email' => 'soft@x.com',
        ]);

        $this->deleteJson("/api/fornecedores/{$fornecedor->id}")
            ->assertNoContent();

        $this->assertSoftDeleted('fornecedores', [
            'id'    => $fornecedor->id,
            'nome'  => 'Fornecedor Soft',
        ]);

        $this->assertNull(Fornecedor::find($fornecedor->id));

        $this->assertNotNull(
            Fornecedor::withTrashed()->find($fornecedor->id)
        );
    }
}
