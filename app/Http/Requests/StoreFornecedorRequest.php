<?php

namespace App\Http\Requests;

use App\Rules\CnpjValido;
use App\Utilities\CnpjFormatter;
use Illuminate\Foundation\Http\FormRequest;

class StoreFornecedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|string|min:3|max:255',
            'cnpj' => [
                'required',
                'digits:14',
                'unique:fornecedores,cnpj',
                new CnpjValido(),
            ],
            'email' => 'nullable|email|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'nome.required' => 'Nome é obrigatório.',
            'nome.min' => 'Nome deve ter no mínimo 3 caracteres.',
            'nome.max' => 'Nome deve ter no máximo 255 caracteres.',
            'cnpj.required' => 'CNPJ é obrigatório.',
            'cnpj.digits' => 'CNPJ deve ter 14 dígitos numéricos.',
            'cnpj.unique' => 'CNPJ já cadastrado.',
            'email.email' => 'E-mail inválido.',
            'email.max' => 'E-mail deve ter no máximo 255 caracteres.',
        ];
    }

    protected function prepareForValidation(): void
    {
        if ($this->has('cnpj')) {
            $this->merge([
                'cnpj' => CnpjFormatter::clean($this->cnpj),
            ]);
        }
    }
}
