<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum TypeStatus: string implements HasColor, HasLabel
{
    case Flat = 'Flat';
    case Percentage = 'Percentage';

    public function getLabel(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Flat => 'success',
            self::Percentage => 'info',
        };
    }
}
