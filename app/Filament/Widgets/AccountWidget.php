<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class AccountWidget extends Widget
{
    protected static ?int $sort = -3;

    protected static bool $isLazy = false;

    protected array|int|string $columnSpan = 'full';

    protected static string $view = 'filament.widgets.account-widget';
}
