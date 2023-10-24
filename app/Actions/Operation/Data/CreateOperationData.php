<?php

declare(strict_types=1);

namespace App\Actions\Operation\Data;

use App\Enums\OperationType;
use App\Models\User;
use Illuminate\Validation\Rules\Enum;
use Spatie\LaravelData\Data;

class CreateOperationData extends Data
{
    public User $user;
    public OperationType $type;
    public float $sum;
    public string $description;

    public static function rules(...$args): array
    {
        return [
            'user' => ['required'],
            'type' => ['required', new Enum(OperationType::class)],
            'sum' => ['required', 'numeric', 'min:0.01', 'max:99999999.99'],
            'description' => ['required', 'string', 'max:500'],
        ];
    }
}
