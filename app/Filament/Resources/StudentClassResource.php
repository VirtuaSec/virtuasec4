<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentClassResource\Pages;
use App\Filament\Resources\StudentClassResource\RelationManagers;
use App\Filament\Resources\StudentClassUserResource\RelationManagers\StudentClassesRelationManager;
use App\Models\StudentClass;
use App\Models\User;
use Filament\Tables\Actions\ActionGroup;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class StudentClassResource extends Resource
{
    protected static ?string $model = StudentClass::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Turmas';

    protected static ?string $label = 'Turma';

    protected static ?string $pluralLabel = 'Turmas';

    protected static ?string $navigationGroup = 'Pedagógico';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name'),
                Forms\Components\TextInput::make('limit')->integer(),
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
                Tables\Columns\TextColumn::make('limit')->label('Capacidade'),
                Tables\Columns\TextColumn::make('users_count')->label('Inscritos')->counts('users')->default(0),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
            ])
            ->actions(
                ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\Action::make('view-students')
                        ->label('Visualizar alunos')
                        ->url(fn ($record): string => route('filament.admin.resources.student-classes.students', $record))


                ])->label('Opções')
                    ->color('primary')
                    ->button()
            )
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //StudentClassesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudentClasses::route('/'),
            'create' => Pages\CreateStudentClass::route('/create'),
            'edit' => Pages\EditStudentClass::route('/{record}/edit'),
            'students' => Pages\Students::class::route('/{record}/students'),
        ];
    }
}
