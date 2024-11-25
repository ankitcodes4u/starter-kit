<?php

namespace App\Filament\Resources;

use App\Enums\Status;
use App\Enums\TypeStatus;
use App\Filament\Resources\ProductResource\Pages;
use App\Models\Product;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?int $navigationSort = 6;

    protected static ?string $navigationGroup = 'Stores';

    public static function generateAttribute() {}

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make('Product Details')
                    ->columnSpanFull()
                    ->tabs([
                        // Basic Information Tab
                        Tabs\Tab::make('Basic Information')
                            ->columns([
                                'sm' => 2,
                            ])
                            ->schema([
                                Forms\Components\TextInput::make('hsn_code')
                                    ->maxLength(255)
                                    ->placeholder('Enter HSN code')
                                    ->required(),
                                Forms\Components\TextInput::make('name')
                                    ->maxLength(255)
                                    ->label('Product Name')
                                    ->placeholder('Enter product name')
                                    ->required(),
                                Forms\Components\TextInput::make('link')
                                    ->maxLength(255)
                                    ->label('Product Link')
                                    ->placeholder('Enter product link'),
                                Forms\Components\Select::make('brand_id')
                                    ->relationship('brand', 'name', fn ($query) => $query->where('status', Status::Public))
                                    ->placeholder('Select a brand'),
                                Forms\Components\Select::make('category_id')
                                    ->relationship('category', 'name', fn ($query) => $query->where('status', Status::Public))
                                    ->placeholder('Select a category'),
                                Forms\Components\Select::make('unit_id')
                                    ->relationship('unit', 'name', fn ($query) => $query->where('status', Status::Public))
                                    ->placeholder('Select a unit'),
                            ]),

                        // Media Tab
                        Tabs\Tab::make('Media')
                            ->schema([
                                Forms\Components\FileUpload::make('images')
                                    ->multiple()
                                    ->image()
                                    ->previewable(false)
                                    ->downloadable()
                                    ->openable()
                                    ->placeholder('Upload product images')
                                    ->columnSpanFull(),
                                Forms\Components\Repeater::make('videos')
                                    ->columnSpanFull()
                                    ->simple(
                                        Forms\Components\TextInput::make('video')
                                            ->maxLength(1000)
                                            ->placeholder('Enter video URL')
                                    ),
                            ]),

                        // Pricing Tab
                        Tabs\Tab::make('Pricing & Orders')
                            ->schema([
                                Forms\Components\TextInput::make('minimum_order_quantity')
                                    ->numeric()
                                    ->placeholder('Enter minimum order quantity')
                                    ->default(1),
                                Forms\Components\TextInput::make('price')
                                    ->numeric()
                                    ->prefix('NPR')
                                    ->placeholder('Enter minimum order quantity'),

                                TableRepeater::make('bulk_price')
                                    ->streamlined()
                                    ->headers([
                                        Header::make('Min. Quantity'),
                                        Header::make('Max. Quantity'),
                                        Header::make('Type'),
                                        Header::make('Price'),
                                    ])
                                    ->schema([
                                        Forms\Components\TextInput::make('min_quantity')
                                            ->numeric()
                                            ->required()
                                            ->placeholder('Enter minimum quantity')
                                            ->label('Minimum Quantity'),
                                        Forms\Components\TextInput::make('max_quantity')
                                            ->numeric()
                                            ->required()
                                            ->placeholder('Enter maximum quantity')
                                            ->label('Maximum Quantity'),
                                        Forms\Components\Select::make('type')
                                            ->options(TypeStatus::class)
                                            ->placeholder('Select Type')
                                            ->default(TypeStatus::Flat)
                                            ->required(),
                                        Forms\Components\TextInput::make('price')
                                            ->numeric()
                                            ->required()
                                            ->placeholder('Enter price')
                                            ->label('Price'),
                                    ]),
                            ]),

                        // Product Details Tab
                        Tabs\Tab::make('Product Details')
                            ->schema([
                                Forms\Components\Textarea::make('attributes')
                                    ->columnSpanFull(),
                                Forms\Components\Textarea::make('overview')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('description')
                                    ->columnSpanFull(),
                                Forms\Components\RichEditor::make('faq')
                                    ->columnSpanFull(),
                            ]),

                        // Meta & SEO Tab
                        Tabs\Tab::make('Meta & SEO')
                            ->schema([
                                Forms\Components\Textarea::make('meta_title'),
                                Forms\Components\Textarea::make('meta_keywords')
                                    ->placeholder(''),
                                Forms\Components\Textarea::make('meta_description'),
                            ]),

                        // Additional Settings Tab
                        Tabs\Tab::make('Additional Settings')
                            ->schema([
                                Forms\Components\Toggle::make('refundable'),
                                Forms\Components\Toggle::make('warranty'),
                                Forms\Components\ToggleButtons::make('status')
                                    ->options(Status::class)
                                    ->inline()
                                    ->default('Public'),
                                Forms\Components\Textarea::make('remarks')
                                    ->rows(6)
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('hsn_code')
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->label('Product Name'),
                Tables\Columns\TextColumn::make('price')
                    ->money('NPR')
                    ->sortable(),
                Tables\Columns\TextColumn::make('brand.name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->searchable(),
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

                // Additional Filters
                Tables\Filters\SelectFilter::make('brand_id')
                    ->relationship('brand', 'name', fn ($query) => $query->where('status', Status::Public))
                    ->label('Brand'),

                Tables\Filters\SelectFilter::make('category_id')
                    ->relationship('category', 'name', fn ($query) => $query->where('status', Status::Public))
                    ->label('Category'),

                Tables\Filters\Filter::make('price_range')
                    ->form([
                        Forms\Components\TextInput::make('min_price')->label('Min Price')->numeric(),
                        Forms\Components\TextInput::make('max_price')->label('Max Price')->numeric(),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['min_price'], fn ($q, $min) => $q->where('price', '>=', $min))
                            ->when($data['max_price'], fn ($q, $max) => $q->where('price', '<=', $max));
                    })
                    ->label('Price Range'),

                Tables\Filters\Filter::make('is_refundable')
                    ->query(fn (Builder $query) => $query->where('refundable', true))
                    ->label('Refundable Only'),

                Tables\Filters\Filter::make('has_warranty')
                    ->query(fn (Builder $query) => $query->where('warranty', true))
                    ->label('With Warranty'),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
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
