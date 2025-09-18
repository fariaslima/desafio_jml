<?php

namespace App\Services;

use App\Utilities\CnpjFormatter;

class FornecedorDataPreparer
{
    public function prepare(array $dados): array
    {
        if (isset($dados['cnpj'])) {
            $dados['cnpj'] = CnpjFormatter::clean($dados['cnpj']);
        }

        if (isset($dados['nome'])) {
            $dados['nome'] = trim($dados['nome']);
        }

        if (isset($dados['email'])) {
            $dados['email'] = strtolower(trim($dados['email']));
        }

        return $dados;
    }
}
