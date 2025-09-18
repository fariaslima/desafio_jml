<?php

namespace App\Services;

use App\Utilities\CnpjFormatter;

class ValidationService
{
    public function validateCnpj(string $cnpj): bool
    {
        $cnpj = CnpjFormatter::clean($cnpj);

        if (strlen($cnpj) !== 14) {
            return false;
        }

        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            return false; // Números repetidos
        }

        return $this->validarDigitos($cnpj);
    }

    private function validarDigitos(string $cnpj): bool
    {
        $multiplicadores1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
        $multiplicadores2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += intval($cnpj[$i]) * $multiplicadores1[$i];
        }
        $resto = $soma % 11;
        $digito1 = $resto < 2 ? 0 : 11 - $resto;

        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += intval($cnpj[$i]) * $multiplicadores2[$i];
        }
        $resto = $soma % 11;
        $digito2 = $resto < 2 ? 0 : 11 - $resto;

        return $cnpj[12] == $digito1 && $cnpj[13] == $digito2;
    }
}
