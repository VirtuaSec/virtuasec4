<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AmbitResource\Pages;
use App\Filament\Resources\AmbitResource\RelationManagers;
use App\Models\Ambit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AmbitResource extends Resource
{
    protected static ?string $model = Ambit::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Âmbitos';

    protected static ?string $label = 'Âmbito';

    protected static ?string $pluralLabel = 'Âmbitos';

    protected static ?string $navigationGroup = 'Pedagógico';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nome'),
                Forms\Components\TextInput::make('description')->label('Descrição'),
                Forms\Components\TextInput::make('email')->required()->label('E-mail'),
                Forms\Components\TextInput::make('hotsite')->required()->label('Hotsite'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('description')->label('Descrição'),
                Tables\Columns\TextColumn::make('email')->label('E-mail'),
                Tables\Columns\TextColumn::make('hotsite')->label('Hotsite'),
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
            'index' => Pages\ListAmbits::route('/'),
            'create' => Pages\CreateAmbit::route('/create'),
            'edit' => Pages\EditAmbit::route('/{record}/edit'),
        ];
    }
}
