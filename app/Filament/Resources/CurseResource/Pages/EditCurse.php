<?php

namespace App\Filament\Resources\CurseResource\Pages;

use App\Filament\Resources\CurseResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurse extends EditRecord
{
    protected static string $resource = CurseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
