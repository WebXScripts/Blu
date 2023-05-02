<?php

namespace App\Http\Livewire;

use App\Actions\ServerResponseAction;
use App\DTO\Website\WebsiteStore;
use App\Repositories\Interfaces\WebsiteRepositoryInterface;
use App\Repositories\WebsiteRepository;
use Livewire\Component;
use \Illuminate\Contracts\View\View as ViewContract;
use Usernotnull\Toast\Concerns\WireToast;

class AddServerForm extends Component
{
    use WireToast;

    public string $name = '';
    public string $url = '';
    public string $description = '';

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'url' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:255'],
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
            Toast()->danger('Server is not responding. Please check the URL and try again.')
                ->push();
            return;
        }

        app(WebsiteRepository::class)->store(
            new WebsiteStore(
                name: $this->name,
                url: $this->url,
                description: $this->description,
                uuid: \Str::uuid(),
            )
        );

        $this->reset();
        $this->dispatchBrowserEvent('server-added');
        Toast()->success('Server added successfully.')
            ->push();
    }
}
