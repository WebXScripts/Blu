<?php

namespace App\Http\Livewire\Dashboard\Servers;

use App\Models\Website;
use Livewire\Component;
use Illuminate\Contracts\View\View as ViewContract;

class LookUp extends Component
{
    public Website $website;

    public function mount(Website $website): void
    {
        $this->website = $website;
    }

    public function render(): ViewContract
    {
        return view('livewire.dashboard.servers.lookup')
            ->extends('layouts.dashboard.app')
            ->section('content');
    }
}
