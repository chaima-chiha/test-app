<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClassesResource\Pages;
use App\Filament\Resources\ClassesResource\RelationManagers;
use App\Models\Classes;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;

class ClassesResource extends Resource
{
    protected static ?string $model = Classes::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Teacher Classe managment';
    protected static ?int $navigationSort= 1;

    public static function form(Form $form): Form
    {
        return $form


            ->schema([


                Wizard::make([
                    Wizard\Step::make('niveau')
                        ->schema([
                            Forms\Components\TextInput::make('niveau')
                            ->required()
                            ->maxLength(255),// ...
                        ]),
                    Wizard\Step::make('section')
                        ->schema([
                            Forms\Components\TextInput::make('section')
                ->required()
                ->maxLength(255),// ...
                        ]),
                    Wizard\Step::make('capacité')
                        ->schema([
                            Forms\Components\TextInput::make('capacité')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(30)
                            ->maxLength(255),// ...
                        ]),
                ])




            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('niveau')
                ->searchable(),
            Tables\Columns\TextColumn::make('section')
                ->searchable(),
            Tables\Columns\TextColumn::make('capacité')
                ->searchable(),
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
            Tables\Columns\TextColumn::make('updated_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),
                //
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
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasses::route('/create'),
            'edit' => Pages\EditClasses::route('/{record}/edit'),
        ];
    }
}
