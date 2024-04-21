<?php

namespace App\Filament\Resources\CurseResource\RelationManagers;

use App\Models\Discipline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class CurseRelationManager extends RelationManager
{
    protected static ?string $label = 'Disciplina';
    protected static ?string $pluralLabel = 'Disciplinas';
    protected static ?string $title = 'Disciplinas';
    protected static string $relationship = 'disciplines';

    protected function getTableRecordUrlUsing(): ?\Closure
    {
        return null;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn($record) => route('filament.admin.resources.disciplines.edit', $record)),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->recordAction(null);
    }
}
