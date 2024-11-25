<?php

namespace App\Filament\Resources\RatingReviewResource\Pages;

use App\Filament\Resources\RatingReviewResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditRatingReview extends EditRecord
{
    protected static string $resource = RatingReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ForceDeleteAction::make(),
            Actions\RestoreAction::make(),
        ];
    }
}
