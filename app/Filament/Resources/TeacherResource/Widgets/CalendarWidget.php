<?php

namespace App\Filament\Resources\TeacherResource\Widgets;

use App\Models\Emploie;
use Filament\Widgets\Widget;
use App\Filament\Resources\EmploieResource;
use Illuminate\Database\Eloquent\Model;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
class CalendarWidget extends FullCalendarWidget
{

    public Model | string | null $model = Emploie::class;


    public function fetchEvents(array $fetchInfo): array
    {
        return Emploie::query()
            ->where('start_at', '>=', $fetchInfo['start'])
            ->where('end_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Emploie $emploie) => [
                    'id' => $emploie->id,
                    'teacher_id' => $emploie->teacher_id,
                    'title' => $emploie->title,
                    'start' => $emploie->start_at,
                    'end' => $emploie->end_at,
                    // 'url' => EmploieResource::getUrl(name: 'edit', parameters: ['record' => $event]),
                    // 'shouldOpenUrlInNewTab' => true
                ]
            )
            ->all();
    }
    // public static function canView(): bool
    // {
    //     return true;
    // }
}
