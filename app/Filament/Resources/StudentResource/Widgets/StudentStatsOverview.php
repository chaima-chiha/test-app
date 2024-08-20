<?php

namespace App\Filament\Resources\StudentResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Student;
use App\Models\User;
use App\Models\Teacher;

class StudentStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Students', Student::query()->count())
            ->description('Nombre de Students')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('primary'),
            Stat::make('Users', User::query()->count())
            ->description('Nombre de users')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),
            Stat::make('Teachers',Teacher::query()->count())
            ->description('Nombre de Teachers')
            ->descriptionIcon('heroicon-m-arrow-trending-up')
            ->color('success'),

            //
        ];
    }
}
