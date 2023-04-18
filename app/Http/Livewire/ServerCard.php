<?php

namespace App\Http\Livewire;

use App\Models\Website;
use Livewire\Component;
use Illuminate\Contracts\View\View as ViewContract;

class ServerCard extends Component
{
    public Website $website;

    public function render(): ViewContract
    {
        return view('livewire.server-card');
    }

    public function mount(Website $website): void
    {
        $this->website = $website;
    }
}
