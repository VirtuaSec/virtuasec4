<?php

namespace App\Filament\Resources\StudentClassCurseResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class StudentClassesRelationManager extends RelationManager
{
    protected static string $relationship = 'studentClasses';

    protected static ?string $label = 'Turma';
    protected static ?string $pluralLabel = 'Turmas';
    protected static ?string $title = 'Turmas';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->label('Nome')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('limit')->label('Capacidade')
                    ->required()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('limit')->label('Capacidade'),
                Tables\Columns\TextColumn::make('users_count')->label('Inscritos')->counts('users')->default(0),
            ])
            ->filters([
                //
            ])
            ->headerActions([

            ])
            ->actions([
                Tables\Actions\Action::make('Alunos')->url(fn($record) => route('filament.admin.resources.student-classes.students', $record)),
                Tables\Actions\Action::make('Editar')->url(fn($record) => route('filament.admin.resources.student-classes.edit', $record)),

               // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])->recordAction(null);
    }
}
