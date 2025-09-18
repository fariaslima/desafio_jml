<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class FornecedorCollection extends ResourceCollection
{
    public $collects = FornecedorResource::class;

    /**
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'meta' => [
                'total' => $this->collection->count(),
                'has_more' => method_exists($this->resource, 'hasMorePages')
                                ? $this->resource->hasMorePages()
                                : false,
                'generated_at' => now()->toISOString(),
            ],
        ];
    }
}
