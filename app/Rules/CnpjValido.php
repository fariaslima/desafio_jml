<?php

namespace App\Rules;

use App\Services\ValidationService;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CnpjValido implements ValidationRule
{
    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $validationService = app(ValidationService::class);

        if (! $validationService->validateCnpj($value)) {
            $fail('O campo :attribute não é um CNPJ válido.');
        }
    }
}
