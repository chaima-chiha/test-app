<?php

namespace App\Filament\Resources\EmploieResource\Pages;

use App\Filament\Resources\EmploieResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploie extends EditRecord
{
    protected static string $resource = EmploieResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
