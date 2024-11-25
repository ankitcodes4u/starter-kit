<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Filament\Resources\ShippingRuleResource\Pages;
use App\Models\ShippingRule;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ShippingRuleResource extends Resource
{
    protected static ?string $model = ShippingRule::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?int $navigationSort = 5;

    protected static ?string $navigationGroup = 'Stores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->compact()
                    ->columns([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('hsn_code')
                            ->maxLength(255)
                            ->required(),
                        TableRepeater::make('rules')
                            ->streamlined()
                            ->headers([
                                Header::make('Shipping From'),
                                Header::make('Shipping To'),
                                Header::make('Price'),
                            ])
                            ->schema([
                                Forms\Components\TextInput::make('shipping_from'),
                                Forms\Components\TextInput::make('shipping_to'),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->prefix('NPR'),
                            ])
                            ->columnSpanFull(),
                        Forms\Components\Toggle::make('applied_to_all')
                            ->label('Applied to all Products?')
                            ->columnSpanFull(),
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
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('hsn_code')
                    ->searchable(),
                Tables\Columns\IconColumn::make('applied_to_all')
                    ->label('Applied to all Products?')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),
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
            'index' => Pages\ListShippingRules::route('/'),
            'create' => Pages\CreateShippingRule::route('/create'),
            'edit' => Pages\EditShippingRule::route('/{record}/edit'),
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
