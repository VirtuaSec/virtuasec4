<?php

namespace App\Filament\Resources\CurseResource\Pages;

use App\Filament\Resources\CurseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCurses extends ListRecords
{
    protected static string $resource = CurseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
