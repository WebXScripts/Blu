<?php

namespace App\Http\Livewire\Tables;

use App\Http\Livewire\Tables\Base\Components\Column;
use App\Http\Livewire\Tables\Base\Table;
use App\Models\Website;
use App\Query\Implements\ScanHistoryQuery;
use Illuminate\Database\Eloquent\Builder;

class ScanHistoriesTable extends Table
{
    public Website $website;
    private ScanHistoryQuery $query;

    public function mount(ScanHistoryQuery $query): void
    {
        $this->query = $query;
        $this->sortBy('created_at', 'desc')
            ->perPage(5)
            ->pageName('scan-histories');
    }

    public function query(): Builder
    {
        return $this->query
            ->byWebsiteId($this->website->id);
    }

    public function columns(): array
    {
        return [
            Column::make('status_code', 'Status Code'),
            Column::make('created_at', 'Created At')
        ];
    }
}
