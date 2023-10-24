<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserBalanceResource;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function balance(): JsonResponse
    {
        return response()->json(
            UserBalanceResource::make(
                auth()->user()->load([
                    'balance',
                    'operations' => fn (HasMany $hasMany) => $hasMany->orderByDesc('id')->limit(5),
                ])
            )
        );
    }
}
