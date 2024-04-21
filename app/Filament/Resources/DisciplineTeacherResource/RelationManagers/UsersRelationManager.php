<?php

namespace App\Filament\Resources\DisciplineTeacherResource\RelationManagers;

use App\Models\Role;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsersRelationManager extends RelationManager
{
    protected static string $relationship = 'users';
    protected static ?string $label = 'Professor';
    protected static ?string $pluralLabel = 'Professores';
    protected static ?string $title = 'Professores';

    public function form(Form $form): Form
    {
        return $form
            ->schema();
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome')
            ])
            ->filters([
                //
            ])->headerActions([
                Tables\Actions\AttachAction::make()
                    ->form([
                        Forms\Components\Select::make('recordId')
                            ->label('Professor')
                            ->options(Role::find(3)->users->pluck('name', 'id'))
                            ->required()
                    ])
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->url(fn($record) => route('filament.admin.resources.teachers.edit', $record)),
                Tables\Actions\Action::make('Desvincular')
                    ->action(function ($record) {
                        $this->record->users()->detach($record->id);
                    })
                    ->requiresConfirmation()
                ->icon('heroicon-c-x-mark')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
