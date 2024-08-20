<?php

namespace App\Filament\Resources\UserResource\Widgets;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use App\Models\Note;

use Filament\Widgets\ChartWidget;

class staticsChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';



    protected function getData(): array
    {
        $data = Trend::model(Note::class)
        ->between(
            start: now()->startOfYear(),
            end: now()->endOfYear(),
        )
        ->perMonth()
        ->count();
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

}
