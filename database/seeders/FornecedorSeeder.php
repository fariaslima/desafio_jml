<?php

namespace Database\Seeders;

use App\Models\Fornecedor;
use Illuminate\Database\Seeder;

class FornecedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fornecedores = [
            [
                'nome' => 'Tech Solutions Ltda',
                'cnpj' => '12345678000199',
                'email' => 'contato@techsolutions.com',
            ],
            [
                'nome' => 'Global Importações SA',
                'cnpj' => '22345678000188',
                'email' => 'vendas@globalimport.com',
            ],
            [
                'nome' => 'Construmax Engenharia',
                'cnpj' => '32345678000177',
                'email' => 'suporte@construmax.com',
            ],
            [
                'nome' => 'Agro Brasil LTDA',
                'cnpj' => '42345678000166',
                'email' => 'agro@agrobrasil.com',
            ],
            [
                'nome' => 'Mídia e Comunicação ME',
                'cnpj' => '52345678000155',
                'email' => 'contato@midia.com',
            ],
            [
                'nome' => 'Alpha Tecnologia SA',
                'cnpj' => '62345678000144',
                'email' => 'alpha@tech.com',
            ],
            [
                'nome' => 'Distribuidora Nova Era',
                'cnpj' => '72345678000133',
                'email' => 'contato@novaera.com',
            ],
            [
                'nome' => 'Indústria Metal Forte',
                'cnpj' => '82345678000122',
                'email' => 'fale@metalforte.com',
            ],
        ];

        foreach ($fornecedores as $fornecedor) {
            Fornecedor::create($fornecedor);
        }
    }
}
