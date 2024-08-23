<?php

namespace App\Filament\Resources\EmploieResource\Pages;

use App\Filament\Resources\EmploieResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmploies extends ListRecords
{
    protected static string $resource = EmploieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
