<?php

namespace App\Http\Livewire;

use App\Models\Website;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use \Illuminate\Contracts\View\View as ViewContract;

class ServersList extends Component
{
    /** @var Collection<Website> */
    public Collection $servers;

    public function render(): ViewContract
    {
        return view('livewire.servers-list')
            ->extends('layouts.dashboard.app')
            ->section('content');
    }

    public function mount()
    {
        $this->servers = $this->getServersProperty();
    }

    public function refreshServers()
    {
        $this->servers = $this->getServersProperty();
    }

    private function getServersProperty(): Collection
    {
        /** @var Collection */
        return auth()->user()->websites()->with(['parameters', 'scanHistories'])->get();
    }
}
