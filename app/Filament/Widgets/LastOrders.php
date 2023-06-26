<?php

namespace App\Filament\Widgets;

use Closure;
use Filament\Tables;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Builder;
use Filament\Widgets\TableWidget as BaseWidget;

class LastOrders extends BaseWidget
{
    protected static ?int $sort = 2;

    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Payment::with('product')->latest()->take(5);
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')->label('Time'),
            Tables\Columns\TextColumn::make('total')->money(),
            Tables\Columns\TextColumn::make('product.name'),
        ];
    }

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}