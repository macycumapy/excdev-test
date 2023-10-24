<?php

declare(strict_types=1);

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @mixin LengthAwarePaginator
 */
class OperationPaginatorResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'items' => OperationResource::collection($this->resource),
            'current_page' => $this->currentPage(),
            'links' => $this->linkCollection(),
            'total' => $this->total(),
            'total_pages' => $this->lastPage(),
        ];
    }
}
