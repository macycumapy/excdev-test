<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\UserBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property-read Balance $balance
 * @property-read Collection<Operation> $operations
 * @mixin UserBuilder
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function newEloquentBuilder($query): UserBuilder
    {
        return new UserBuilder($query);
    }

    public function balance(): HasOne
    {
        return $this->hasOne(Balance::class);
    }

    public function operations(): HasMany
    {
        return  $this->hasMany(Operation::class);
    }
}
