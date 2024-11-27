<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum OrderStatus: string implements HasColor, HasLabel
{
    // Pending, Confirmed, Picked up, On the way, Delivered
    case Pending = 'Pending';
    case Confirmed = 'Confirmed';
    case PickedUp = 'Picked Up';
    case OnTheWay = 'On The Way';
    case Delivered = 'Delivered';
    case Cancelled = 'Cancelled';
    case Refunded = 'Refunded';

    public function getLabel(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::Pending => 'warning',
            self::Confirmed => 'success',
            self::PickedUp => 'success',
            self::OnTheWay => 'warning',
            self::Delivered => 'success',
            self::Cancelled => 'danger',
            self::Refunded => 'danger',
        };
    }
}
