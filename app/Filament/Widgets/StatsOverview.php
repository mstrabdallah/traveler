<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Tours', \App\Models\Tour::count())
                ->description('Active tours available')
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary'),
            Stat::make('Destinations', \App\Models\Destination::count())
                ->description('Covered regions')
                ->descriptionIcon('heroicon-m-map')
                ->color('success'),
            Stat::make('Pending Bookings', \App\Models\Booking::where('status', 'pending')->count())
                ->description('Needs attention')
                ->descriptionIcon('heroicon-m-bell')
                ->color('warning'),
            Stat::make('Tailor-Made Requests', \App\Models\CustomTourRequest::count())
                ->description(\App\Models\CustomTourRequest::whereDate('created_at', today())->count() . ' new today')
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('info'),
        ];
    }
}
