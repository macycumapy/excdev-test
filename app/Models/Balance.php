<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Scopes\SampleByUser;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $user_id
 * @property float $sum
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read User $user
 */
class Balance extends Model
{
    protected $fillable = [
        'sum',
    ];

    protected $casts = [
        'sum' => 'float',
    ];

    protected static function boot(): void
    {
        parent::boot();
        static::addGlobalScope(new SampleByUser());
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
