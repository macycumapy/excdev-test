<?php

declare(strict_types=1);

namespace App\Actions\Balance;

use App\Models\Balance;

class IncrementBalanceAction
{
    public function exec(Balance $balance, float $sum): bool
    {
        $balance->sum += $sum;
        return $balance->save();
    }
}
