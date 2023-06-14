<?php

namespace App\Http\Livewire\Tables\Base;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

abstract class Table extends Component
{
    use WithPagination;

    public $page = 1;
    private int $perPage = 5;
    private string $pageName = 'page';
    private string $sortColumn = 'id';
    private string $sortDirection = 'asc';
    private string $tableView = 'livewire.tables.base.table';

    public abstract function query(): Builder;

    public abstract function columns(): array;

    public function data(): LengthAwarePaginator
    {
        return $this
            ->query()
            ->orderBy($this->sortColumn, $this->sortDirection)
            ->paginate($this->perPage, ['*'], $this->pageName);
    }

    public function sortBy(string $column, string $sortDirection): self
    {
        $this->sortColumn = $column;
        $this->sortDirection = $sortDirection;

        return $this;
    }

    public function perPage(int $perPage): self
    {
        $this->perPage = $perPage;

        return $this;
    }

    public function pageName(string $pageName): self
    {
        $this->pageName = $pageName;

        return $this;
    }

    public function tableView(string $tableView): self
    {
        $this->tableView = $tableView;

        return $this;
    }

    public function render(): ViewContract
    {
        return view($this->tableView);
    }
}
