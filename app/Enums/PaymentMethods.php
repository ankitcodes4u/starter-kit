<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum PaymentMethods: string implements HasColor, HasLabel
{
    case DigitalWallet = 'Digital Wallet';
    case MobileBanking = 'Mobile Banking';
    case CashOnDelivery = 'Cash On Delivery';
    case Others = 'Others';

    public function getLabel(): string
    {
        return $this->name;
    }

    public function getColor(): string
    {
        return match ($this) {
            self::DigitalWallet => 'success',
            self::MobileBanking => 'success',
            self::CashOnDelivery => 'success',
            self::Others => 'success',
        };
    }
}
