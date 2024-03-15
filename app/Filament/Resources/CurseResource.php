<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CurseResource\Pages;
use App\Models\Ambit;
use App\Models\Curse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class CurseResource extends Resource
{
    protected static ?string $model = Curse::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Cursos';

    protected static ?string $label = 'Curso';

    protected static ?string $pluralLabel = 'Cursos';

    protected static ?string $navigationGroup = 'Pedagógico';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nome'),
                Forms\Components\Select::make('ambit_id')->required()->label('Âmbito')->searchable()->options(Ambit::all()->pluck('name', 'id')->toArray()),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('ambit.name')->label('Âmbito'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListCurses::route('/'),
            'create' => Pages\CreateCurse::route('/create'),
            'edit' => Pages\EditCurse::route('/{record}/edit'),
        ];
    }
}
