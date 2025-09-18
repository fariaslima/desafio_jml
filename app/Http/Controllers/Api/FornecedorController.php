<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFornecedorRequest;
use App\Http\Resources\FornecedorCollection;
use App\Http\Resources\FornecedorResource;
use App\Services\FornecedorService;
use Illuminate\Http\Request;

class FornecedorController extends Controller
{
    public function __construct(private FornecedorService $service)
    {
    }

    public function index(Request $request)
    {
        $filtros = ['nome' => $request->query('q')];
        $fornecedores = $this->service->listar($filtros, 50);

        return new FornecedorCollection($fornecedores);
    }

    public function store(StoreFornecedorRequest $request)
    {
        $fornecedor = $this->service->criar($request->validated());

        return (new FornecedorResource($fornecedor))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->service->deletar($id);

        return response()->noContent();
    }
}
