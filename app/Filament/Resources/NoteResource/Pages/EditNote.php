<?php

namespace App\Filament\Resources\NoteResource\Pages;

use App\Filament\Resources\NoteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Log;


class EditNote extends EditRecord
{
    protected static string $resource = NoteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function afterSave(): void
    {
        // Retrieve the note
        Log::info("message");
        $note= $this->record;

        if(!empty($note->note_TP) && !empty($note->coef_note_TP) && !empty($note->note_TD) && !empty($note->coef_note_TD) && !empty($note->note_examen) && !empty($note->coef_note_examen)){
            $note->moyenne=(($note->note_TP)*($note->coef_note_TP)+($note->note_TD)*($note->coef_note_TD)+($note->note_examen)*($note->coef_note_examen))/(($note->coef_note_TP)+($note->coef_note_TD)+($note->coef_note_examen));
        }
       // $note->moyenne = 7;
       $note->save();

    }
}
