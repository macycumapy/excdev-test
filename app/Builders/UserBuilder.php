<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin User
 */
class UserBuilder extends Builder
{
    public function findByEmail(string $email): ?User
    {
        return $this->where('email', strtolower($email))->first();
    }
}
