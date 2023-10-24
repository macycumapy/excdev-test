<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\Balance\CreateBalanceAction;
use App\Actions\User\Data\CreateUserData;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function __construct(private readonly CreateBalanceAction $createBalanceAction)
    {
    }

    public function exec(CreateUserData $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data->name,
                'email' => strtolower($data->email),
                'password' => Hash::make($data->password),
            ]);

            $this->createBalanceAction->exec($user);

            return $user;
        });
    }
}
