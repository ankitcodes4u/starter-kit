<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum RequestStatus: string implements HasColor, HasLabel
{
    case Pending = 'Pending';
    case Resolved = 'Resolved';
    case UnResolved = 'Un-Resolved';

    public function getLabel(): ?string
    {
        return $this->name;
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Pending => 'gray',
            self::Resolved => 'success',
            self::UnResolved => 'danger',

        };
    }
}
