<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make(__('Total Tours'), \App\Models\Tour::count())
                ->description(__('Active tours available'))
                ->descriptionIcon('heroicon-m-globe-alt')
                ->color('primary'),
            Stat::make(__('Destinations'), \App\Models\Destination::count())
                ->description(__('Covered regions'))
                ->descriptionIcon('heroicon-m-map')
                ->color('success'),
            Stat::make(__('Pending Bookings'), \App\Models\Booking::where('status', 'pending')->count())
                ->description(__('Needs attention'))
                ->descriptionIcon('heroicon-m-bell')
                ->color('warning'),
            Stat::make(__('Tailor-Made Requests'), \App\Models\CustomTourRequest::count())
                ->description(\App\Models\CustomTourRequest::whereDate('created_at', today())->count() . ' ' . __('new today'))
                ->descriptionIcon('heroicon-m-chat-bubble-left-right')
                ->color('info'),
        ];
    }
}
