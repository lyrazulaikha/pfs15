<?php

namespace App\Filament\Resources\Products;

use App\Models\Product;
use App\Models\Category;
use Filament\Resources\Resource;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\BulkActionGroup;
use App\Filament\Resources\Products\Pages\{CreateProduct, EditProduct, ListProducts, ViewProduct};

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel = 'Produk';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    public static function form(Form $form): Form
    {
        return $form->schema([
            TextInput::make('name')
                ->label('Nama Produk')
                ->required()
                ->maxLength(255),

            Textarea::make('description')
                ->label('Deskripsi'),

            TextInput::make('price')
                ->label('Harga')
                ->numeric()
                ->required(),

            Select::make('category_id')
                ->label('Kategori')
                ->relationship('category', 'name')
                ->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama Produk')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('price')
                    ->label('Harga')
                    ->sortable(),

                TextColumn::make('category.name')
                    ->label('Kategori')
                    ->sortable()
                    ->searchable(),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([]),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
            'view' => ViewProduct::route('/{record}'),
        ];
    }
}