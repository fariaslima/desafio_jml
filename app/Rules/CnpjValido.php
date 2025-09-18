<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CnpjValido implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $cnpj = preg_replace('/\D/', '', $value ?? '');

        if (strlen($cnpj) !== 14) {
            $fail('O campo :attribute deve conter 14 dígitos numéricos.');

            return;
        }

        if (preg_match('/^(\d)\1{13}$/', $cnpj)) {
            $fail('O campo :attribute não pode conter números repetidos.');

            return;
        }

        if (! $this->validarDigitos($cnpj)) {
            $fail('O campo :attribute não é um CNPJ válido.');
        }
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
