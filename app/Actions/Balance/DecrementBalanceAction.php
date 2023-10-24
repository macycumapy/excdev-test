<?php

declare(strict_types=1);

namespace App\Actions\Balance;

use App\Models\Balance;
use Exception;

class DecrementBalanceAction
{
    /**
     * @throws Exception
     */
    public function exec(Balance $balance, float $sum): bool
    {
        $balance->sum -= $sum;

        if ($balance->sum < 0) {
            throw new Exception('Баланс не может быть отрицательным');
        }

        return $balance->save();
    }
}
