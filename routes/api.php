<?php

use App\Http\Controllers\Api\FornecedorController;

Route::get('fornecedores', [FornecedorController::class, 'index']);
Route::post('fornecedores', [FornecedorController::class, 'store']);
Route::delete('fornecedores/{id}', [FornecedorController::class, 'destroy']);
