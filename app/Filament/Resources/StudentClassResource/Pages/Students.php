<?php

namespace App\Filament\Resources\StudentClassResource\Pages;

use App\Filament\Resources\StudentClassResource;
use App\Models\StudentClass;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Get;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use Filament\Resources\Pages\Page;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Table;
use Filament\Tables;
use Illuminate\Validation\Rules\Unique;

class Students extends Page implements HasTable
{
    use InteractsWithRecord, InteractsWithTable;

    public string|int|null|\Illuminate\Database\Eloquent\Model $record;

    protected static string $resource = StudentClassResource::class;

    protected static string $view = 'filament.resources.student-class-resource.pages.students';

    protected static ?string $navigationLabel = 'Aluno';

    protected static ?string $title = 'Alunos';

    public function mount(int|string $record): void
    {
        $this->record = $this->resolveRecord($record);
    }

    public function table(Table $table)
    {
        return $table->columns([
            TextColumn::make('name')
            ])
            ->actions([
                Tables\Actions\Action::make('Desvincular')
                    ->action(function($record) {
                        $this->record->users()->detach($record->id);
                    })
                    ->requiresConfirmation()
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make('student_class_id')
                    ->form([
                        Select::make('recordId')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable()
                            ->label('Aluno')
                            ->rules([
                                function () {
                                    return function (string $attribute, $value, \Closure $fail) {
                                        if ($this->record->users()->where('users.id', $value)->count() > 0) {
                                            return $fail(__('validation.unique', ['attribute' => 'aluno']));
                                        }
                                        return true;
                                    };
                                },
                            ])
                    ])->visible(function () {

                        return $this->record->limit > $this->record->users()->count();
                    })->modalHeading('Vincular Aluno')

            ])->relationship(function () {
                return $this->record->users();
            });
    }

}
