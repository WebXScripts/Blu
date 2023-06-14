<?php

namespace App\Http\Livewire\Dashboard\Helpers;

use App\Actions\Servers\ServerResponseMatchAction;
use App\Models\Website;
use Illuminate\Contracts\View\View as ViewContract;
use Livewire\Component;

class ServerCard extends Component
{
    public Website $website;

    public function render(ServerResponseMatchAction $action): ViewContract
    {
        return match($action->handle($this->website)) {
            0 => view('livewire.dashboard.helpers.server-cards.not-scanned'),
            1 => view('livewire.dashboard.helpers.server-cards.cannot-scan'),
            200 => view('livewire.dashboard.helpers.server-cards.online'),
            400 => view('livewire.dashboard.helpers.server-cards.offline'),
        };
    }

    public function lookUp(): void
    {
        redirect()->route('servers.lookup', $this->website);
    }
}
