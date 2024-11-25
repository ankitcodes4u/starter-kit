<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Enums\TypeStatus;
use App\Filament\Resources\TariffResource\Pages;
use App\Models\Tariff;
use App\Models\Unit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TariffResource extends Resource
{
    protected static ?string $model = Tariff::class;

    protected static ?string $navigationIcon = 'heroicon-o-percent-badge';

    protected static ?int $navigationSort = 7;

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
                        Forms\Components\TextInput::make('hsn_code')
                            ->columnSpanFull()
                            ->maxLength(255)
                            ->required(),
                        Forms\Components\Textarea::make('description_of_goods')
                            ->columnSpanFull(),
                        Forms\Components\Select::make('type')
                            ->options(TypeStatus::class)
                            ->live()
                            ->default('Flat')
                            ->required(),
                        Forms\Components\TextInput::make('price')
                            ->numeric()
                            ->prefix(fn (Get $get) => $get('type') === 'Flat' ? 'NPR' : '')
                            ->suffix(fn (Get $get) => $get('type') === 'Percentage' ? '%' : '')
                            ->required(),
                        Forms\Components\TagsInput::make('units')
                            ->placeholder('Simply add units then press enter')
                            ->suggestions(fn () => Unit::orderBy('name', 'ASC')->pluck('name', 'name')),
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
                Tables\Columns\TextColumn::make('type')
                    ->searchable(),
                Tables\Columns\TextColumn::make('price')
                    ->sortable()
                    ->prefix(fn ($record) => $record->type === 'Flat' ? 'NPR' : '')
                    ->suffix(fn ($record) => $record->type === 'Percentage' ? '%' : ''),
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
            'index' => Pages\ListTariffs::route('/'),
            'create' => Pages\CreateTariff::route('/create'),
            'edit' => Pages\EditTariff::route('/{record}/edit'),
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
