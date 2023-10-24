<?php

declare(strict_types=1);

namespace App\Actions\Operation;

use App\Actions\Balance\DecrementBalanceAction;
use App\Actions\Balance\IncrementBalanceAction;
use App\Actions\Operation\Data\CreateOperationData;
use App\Enums\OperationType;
use App\Models\Balance;
use App\Models\Operation;
use Illuminate\Support\Facades\DB;

class CreateOperationAction
{
    public function __construct(
        private readonly IncrementBalanceAction $incrementBalanceAction,
        private readonly DecrementBalanceAction $decrementBalanceAction,
    ) {
    }

    public function exec(CreateOperationData $data): Operation
    {
        return DB::transaction(function () use ($data) {
            $operation = new Operation();
            $operation->type = $data->type;
            $operation->sum = $data->sum;
            $operation->description = $data->description;
            $operation->user()->associate($data->user);
            $operation->save();

            /** @var Balance $balance */
            $balance = $data->user->balance()->lockForUpdate()->first();
            match ($data->type) {
                OperationType::Inflow => $this->incrementBalanceAction->exec($balance, $data->sum),
                OperationType::Outflow => $this->decrementBalanceAction->exec($balance, $data->sum),
            };

            return $operation;
        });
    }
}
