<?php

namespace App\Services;

use App\Models\Fornecedor;
use Illuminate\Support\Facades\DB;

class FornecedorService
{
    public function __construct(private FornecedorDataPreparer $preparer)
    {
    }

    /**
     * @param  array<string, mixed>  $filtros
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function listar(array $filtros = [], int $perPage = 50)
    {
        $query = Fornecedor::query();

        if (! empty($filtros['nome'])) {
            $query->where('nome', 'like', '%'.$filtros['nome'].'%');
        }

        return $query->orderByDesc('created_at')->paginate($perPage);
    }

    /**
     * @param  array<string, mixed>  $dados
     */
    public function criar(array $dados): Fornecedor
    {
        $dadosPreparados = $this->preparer->prepare($dados);

        return DB::transaction(function () use ($dadosPreparados) {
            return Fornecedor::create($dadosPreparados);
        });
    }

    /**
     * @param  int  $id
     * @return bool
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function deletar(int $id): bool
    {
        $fornecedor = Fornecedor::findOrFail($id);

        return $fornecedor->delete();
    }
}
