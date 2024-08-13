<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NoteResource\Pages;
use App\Filament\Resources\NoteResource\RelationManagers;
use App\Models\Note;
use App\Models\matiere;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\QueryBuilder\Constraints\TextConstraint;

class NoteResource extends Resource
{
    protected static ?string $model = Note::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                /*Forms\Components\TextInput::make('id_matiere')
                    ->required()
                   ->numeric(),
                Forms\Components\TextInput::make('id_student')
                    ->required()
                    ->numeric(),*/
                    Select::make('id_matiere')
                    ->label('matiere')
                    ->options(matiere::all()->pluck('matiere', 'id'))
                    ->searchable(),
                    Select::make('id_student')
                    ->label('student')
                    ->options(Student::all()->pluck('nom', 'id'))
                    ->searchable(),

                Forms\Components\TextInput::make('note_TP')
                    //->required()
                    ->numeric(),
                Forms\Components\TextInput::make('note_TD')
                    //->required()
                    ->numeric(),
                Forms\Components\TextInput::make('note_examen')
                    //->required()
                    ->numeric(),
                Forms\Components\TextInput::make('coef_note_TP')
                    //->required()
                    ->numeric(),
                Forms\Components\TextInput::make('coef_note_TD')
                   // ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('coef_note_examen')
                   // ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('periode')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matieres.matiere')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('students.nom')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note_TP')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note_TD')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('note_examen')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coef_note_TP')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coef_note_TD')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('coef_note_examen')
                    ->numeric()
                    ->sortable(),
                    Tables\Columns\TextColumn::make('moyenne_matiere')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('periode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('id_matiere')
                ->relationship('matieres', 'matiere')
                ->searchable()
                ->preload(),
                SelectFilter::make('id_student')
                ->relationship('students', 'nom')
                ->searchable()
                ->preload(),
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
            'index' => Pages\ListNotes::route('/'),
            'create' => Pages\CreateNote::route('/create'),
            'edit' => Pages\EditNote::route('/{record}/edit'),
        ];
    }
}
