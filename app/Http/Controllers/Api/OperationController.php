<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OperationPaginatorResource;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OperationController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $items = Operation::searchByDescription($request->get('search', ''))->paginate(15);

        return response()->json(
            OperationPaginatorResource::make($items)
        );
    }
}
