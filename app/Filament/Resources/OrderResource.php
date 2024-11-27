<?php

namespace App\Filament\Resources;

use App\Enums\OrderStatus;
use App\Enums\PaymentMethods;
use App\Enums\Status;
use App\Filament\Resources\OrderResource\Pages;
use App\Models\Order;
use App\Models\Product;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make()
                    ->compact()
                    ->schema([
                        Forms\Components\Select::make('creator')
                            ->label('Customer / Creator')
                            ->relationship('creator', 'email')
                            ->searchable()
                            ->placeholder('Select Customer')
                            ->required()
                            ->preload(),
                    ]),
                Forms\Components\Section::make()
                    ->compact()
                    ->columns([
                        'sm' => 2,
                    ])
                    ->schema([
                        Forms\Components\TextInput::make('order')
                            ->readOnly()
                            ->label('Order ID')
                            ->helperText(function ($context) {
                                if ($context === 'create') {
                                    return 'This value will be auto-generated.';
                                }
                            }),
                        Forms\Components\Select::make('payment_method')
                            ->options(PaymentMethods::class)
                            ->required()
                            ->placeholder('Select Payment Method'),
                        TableRepeater::make('items')
                            ->columnSpanFull()
                            ->headers([
                                Header::make('Product Name'),
                                Header::make('Quantity')->width('80px'),
                                Header::make('Unit Price')->width('100px'),
                                Header::make('Total')->width('150px'),
                            ])
                            ->schema([
                                Forms\Components\Select::make('product_name')
                                    ->options(fn () => Product::where('status', Status::Public)->pluck('id', 'name'))
                                    ->searchable()
                                    ->placeholder('Select Product')
                                    ->preload()
                                    ->required(),
                                Forms\Components\TextInput::make('quantity')->numeric(),
                                Forms\Components\TextInput::make('unit_quantity')->numeric(),
                                Forms\Components\TextInput::make('total')->numeric(),
                            ]),
                        Forms\Components\TextInput::make('subtotal')
                            ->prefix('NPR')
                            ->numeric(),
                        Forms\Components\TextInput::make('shipping')
                            ->prefix('NPR')
                            ->numeric(),
                        Forms\Components\TextInput::make('total')
                            ->prefix('NPR')
                            ->required()
                            ->numeric(),
                        Forms\Components\ToggleButtons::make('status')
                            ->options(OrderStatus::class)
                            ->required()
                            ->inline()
                            ->default(OrderStatus::Pending),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('order')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('payment_status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('subtotal')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('shipping')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('total')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_by')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_by')
                    ->numeric()
                    ->sortable(),
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
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
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
