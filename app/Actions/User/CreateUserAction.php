<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Actions\User\Data\CreateUserData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateUserAction
{
    public function exec(CreateUserData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => strtolower($data->email),
            'password' => Hash::make($data->password),
        ]);
    }
}
