<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DisciplineResource\Pages;
use App\Filament\Resources\DisciplineTeacherResource\RelationManagers\UsersRelationManager;
use App\Models\Discipline;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class DisciplineResource extends Resource
{
    protected static ?string $model = Discipline::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Disciplinas';

    protected static ?string $label = 'Disciplina';

    protected static ?string $pluralLabel = 'Disciplinas';

    protected static ?string $navigationGroup = 'Pedagógico';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')->required()->label('Nome'),
                Forms\Components\Select::make('curse_id')
                    ->label('Curso')
                    ->required()
                    ->searchable()
                    ->relationship(
                        name: 'curse',
                        titleAttribute: 'name',
                    )
                    ->getOptionLabelFromRecordUsing(fn(Model $record) => "{$record->ambit->name} - {$record->name}")
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Nome'),
                Tables\Columns\TextColumn::make('curse.name')->label('Curso'),
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
            UsersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDisciplines::route('/'),
            'create' => Pages\CreateDiscipline::route('/create'),
            'edit' => Pages\EditDiscipline::route('/{record}/edit'),
        ];
    }
}
