<?php

declare(strict_types=1);

namespace App\Enums;

enum OperationType: string
{
    case Inflow = 'inflow';
    case Outflow = 'outflow';

    public function title(): string
    {
        return match ($this) {
            self::Inflow => 'Поступление',
            self::Outflow => 'Расход',
        };
    }
}
