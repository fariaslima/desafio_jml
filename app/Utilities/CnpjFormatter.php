<?php

namespace App\Utilities;

class CnpjFormatter
{
    /**
     * Remove all non-numeric characters from CNPJ
     */
    public static function clean(string $cnpj): string
    {
        return preg_replace('/\D/', '', $cnpj);
    }
}
