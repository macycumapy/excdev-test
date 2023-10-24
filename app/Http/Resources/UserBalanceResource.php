<?php

declare(strict_types=1);

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserBalanceResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'balance' => $this->balance->sum,
            'operations' => OperationResource::collection($this->operations),
        ];
    }
}
