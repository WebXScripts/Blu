<?php

namespace App\Http\Livewire\Dashboard\Servers;

use App\Actions\Servers\ServerDotMatchAction;
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

    public function generateStatusDot(): string
    {
        return (new ServerDotMatchAction)->handle($this->website
            ->scanHistories
            ->last()
            ->status_code
        );
    }

    public function getLastCheckedStatus(): string
    {
        if ($this->website
                ->scanHistories
                ->last()
                ?->status_code ?? 0 == 200) {
            return 'Alive.';
        }

        return 'Issue detected.';
    }

    public function getLastCheckedDate(): string
    {
        return $this->website
            ->scanHistories
            ->last()
            ?->created_at
            ?->diffForHumans() ?? 'Never.';
    }

    public function getLastCheckedResponseTime(): string
    {
        return $this->website
            ->scanHistories
            ->last()
            ?->response_time ?? 'NaN';
    }

    public function getPositiveStatusCount(): int
    {
        return $this->website
            ->scanHistories
            ->where('status_code', 200)
            ->count();
    }

    public function getNegativeStatusCount(): int
    {
        return $this->website
            ->scanHistories
            ->where('status_code', '!=', 200)
            ->count();
    }
}
