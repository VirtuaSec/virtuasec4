<?php

namespace App\Filament\Resources\AmbitResource\Pages;

use App\Filament\Resources\AmbitResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAmbit extends EditRecord
{
    protected static string $resource = AmbitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
