<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\ValuationResource\Pages;
use App\Models\Unit;
use App\Models\Valuation;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ValuationResource extends Resource
{
    protected static ?string $model = Valuation::class;

    protected static ?string $navigationIcon = 'gmdi-balance';

    protected static ?int $navigationSort = 8;

    protected static ?string $navigationGroup = 'Stores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->compact()
                    ->schema([
                        Forms\Components\TextInput::make('hsn_code')
                            ->maxLength(255)
                            ->columnSpanFull()
                            ->required(),
                        Forms\Components\TagsInput::make('units')
                            ->placeholder('Simply add units then press enter')
                            ->suggestions(fn () => Unit::orderBy('name', 'ASC')->pluck('name', 'name')),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix('NPR')
                            ->required(),
                        Forms\Components\ToggleButtons::make('status')
                            ->options(Status::class)
                            ->inline()
                            ->default('Public'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hsn_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListValuations::route('/'),
            'create' => Pages\CreateValuation::route('/create'),
            'edit' => Pages\EditValuation::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
