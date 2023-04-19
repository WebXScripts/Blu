<?php

namespace App\Http\Livewire;

use App\Actions\ServerResponseMatchAction;
use App\Models\Website;
use Livewire\Component;
use Illuminate\Contracts\View\View as ViewContract;

class ServerCard extends Component
{
    public Website $website;

    public function render(): ViewContract
    {
        return match (ServerResponseMatchAction::make($this->website)) {
            0 => view('livewire.server-cards.not-scanned'),
            200 => view('livewire.server-cards.online'),
            400 => view('livewire.server-cards.offline'),
        };
    }
}
