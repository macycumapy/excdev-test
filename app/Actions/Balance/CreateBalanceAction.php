<?php

declare(strict_types=1);

namespace App\Actions\Balance;

use App\Models\Balance;
use App\Models\User;

class CreateBalanceAction
{
    public function exec(User $user, float $sum = 0.0): Balance
    {
        $balance = new Balance([
            'sum' => $sum,
        ]);
        $balance->user()->associate($user);
        $balance->save();

        return $balance;
    }
}
