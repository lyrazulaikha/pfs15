<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Actions\CreateAction;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;
    protected static ?string $title = 'Produk';
    protected ?string $heading = 'List Produk';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make()->createAnother(false),
        ];
    }
}