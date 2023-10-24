<?php

declare(strict_types=1);

namespace App\Builders;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Operation
 */
class OperationBuilder extends Builder
{
    public function searchByDescription(?string $description = null)
    {
        return $this->whereRaw('lower(description) like ?', '%' . mb_strtolower($description) . '%');
    }
}
