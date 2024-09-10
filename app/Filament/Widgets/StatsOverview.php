<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\HolidayPackages;
use App\Models\Transaction;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Category',  Category::count()),
            Stat::make('Total Holiday Packages',  HolidayPackages::count()),
            Stat::make('Total Transactions',  Transaction::count()),
            Stat::make('Total Customer',  User::where('role_id', 2)->count()),
            Stat::make('Total Pending Transactions',  Transaction::where('status', 'pending')->count()),
            Stat::make('Total Success Transactions',  Transaction::where('status', 'pending')->count()),
            Stat::make('Total Cancel Transactions',  Transaction::where('status', 'pending')->count()),

        ];
    }
}
