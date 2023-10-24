<?php

declare(strict_types=1);

namespace App\Models;

use App\Builders\OperationBuilder;
use App\Enums\OperationType;
use App\Models\Scopes\SampleByUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property OperationType $type
 * @property float $sum
 * @property string $description
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user
 * @mixin OperationBuilder
 */
class Operation extends Model
{
    protected $fillable = [
        'sum',
        'description',
        'type',
    ];

    protected $casts = [
        'sum' => 'float',
        'type' => OperationType::class,
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new SampleByUser());
    }

    public function newEloquentBuilder($query): OperationBuilder
    {
        return new OperationBuilder($query);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
