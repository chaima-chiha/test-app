<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StudentResource\Pages;
use App\Filament\Resources\StudentResource\RelationManagers;
use App\Models\Student;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use App\Models\Classes;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;

use Filament\Tables\Columns\ToggleColumn;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';
    protected static ?string $navigationGroup = 'Student managment';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Section::make()
                ->schema([
                Forms\Components\TextInput::make('nom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('prenom')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('cin')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('date_de_naissance')
                    ->required()
                    ->maxLength(255),

                Forms\Components\TextInput::make('adress')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                     ->suffix('.com')
                     ->suffixIcon('heroicon-m-check-circle')
                     ->suffixIconColor('success')
                    ->email()
                    ->required()
                    ->maxLength(255),

                    Forms\Components\Select::make('classe')
                    ->label('Classe')
                    ->options(Classes::all()->pluck('niveau', 'id'))
                    ->searchable(),
                    ])
                    ->columns(3),

                   Forms\Components\Section::make('Images')
                    ->schema([
                        SpatieMediaLibraryFileUpload::make('photo')
                            ->collection('product-images')
                            ->multiple()
                            ->maxFiles(5)
                            ->required()
                            ->hiddenLabel(),
                    ])
                    ->collapsible(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\SpatieMediaLibraryImageColumn::make('photo')
                ->label('Image')
                ->collection('product-images'),

                Tables\Columns\TextColumn::make('nom')
                    //->searchable(),
                    ->searchable(isIndividual: true),
                Tables\Columns\TextColumn::make('prenom')
                    ->searchable(),
                Tables\Columns\TextColumn::make('cin')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_de_naissance')
                    ->searchable(),

                Tables\Columns\TextColumn::make('adress')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('classe')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                    ToggleColumn::make('payment'),

            ])
            ->filters([
                Filter::make('created_at')
    ->form([
        DatePicker::make('created_from'),
        DatePicker::make('created_until'),
    ])
    ->query(function (Builder $query, array $data): Builder {
        return $query
            ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            )
            ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            );
    })


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
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}
