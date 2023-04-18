<?php

namespace App\Http\Livewire;

use App\Actions\ServerResponseAction;
use App\Models\Website;
use Livewire\Component;
use \Illuminate\Contracts\View\View as ViewContract;

class AddServerForm extends Component
{
    public string $name = '';
    public string $url = '';
    public string $description = '';
    public int $scanInterval = 1;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'url' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:255'],
        'scanInterval' => ['nullable', 'integer', 'min:1'],
    ];

    public function render(): ViewContract
    {
        return view('livewire.add-server-form');
    }

    public function handle(): void
    {
        $this->validate();
        $call = ServerResponseAction::make($this->url);

        if (!$call) {
            $this->addError('url', 'The provided URL is not reachable.');
            return;
        }

        /** @var Website $server */
        $server = auth()->user()->websites()->create([
            'name' => $this->name,
            'url' => $this->url,
            'description' => $this->description,
            'uuid' => \Str::uuid(),
        ]);

        $server->parameters()->create([
            'scan_interval' => $this->scanInterval,
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('server-added');
    }
}
