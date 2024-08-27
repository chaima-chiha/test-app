<?php

namespace App\Filament\Resources\TeacherResource\Widgets;
use App\Filament\Resources\EmploieResource;
use App\Models\Emploie;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class CalendarWidget extends FullCalendarWidget
{
    public function fetchEvents(array $fetchInfo): array
    {
        return Emploie::query()
            ->where('start_at', '>=', $fetchInfo['start'])
            ->where('end_at', '<=', $fetchInfo['end'])
            ->get()
            ->map(
                fn (Emploie $emploie) => [
                    'id' => $emploie->id,
                    'title' => $emploie->title,
                    'start' => $emploie->start_at,
                    'end' => $emploie->end_at,
                    'url' => EmploieResource::getUrl(name: 'edit', parameters: ['record' => $emploie]),
                    'shouldOpenUrlInNewTab' => false,
                    'color' => $emploie->color,
                ]
            )
            ->all();
    }
    public static function canView(): bool
    {
        return false;
    }
}
