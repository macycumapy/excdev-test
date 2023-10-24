<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\Operation;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Operation
 */
class OperationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'type' => $this->type->title(),
            'sum' => $this->sum,
            'description' => $this->description,
            'date' => $this->created_at->format('d.m.Y H:i')
        ];
    }
}
