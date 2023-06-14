<?php

namespace App\Http\Livewire\Forms;

use App\Actions\Forms\AddServerAction;
use App\Actions\Servers\ServerResponseAction;
use App\DTO\Website\WebsiteStore;
use App\Repositories\WebsiteRepository;
use Illuminate\Contracts\View\View as ViewContract;
use Livewire\Component;
use Livewire\WithFileUploads;
use Usernotnull\Toast\Concerns\WireToast;

class AddServerForm extends Component
{
    use WireToast, WithFileUploads;

    public string $name = '';
    public string $url = '';
    public string $description = '';
    public $image;

    protected $rules = [
        'name' => ['required', 'string', 'max:255'],
        'url' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:255'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
    ];

    public function render(): ViewContract
    {
        return view('livewire.forms.add-server-form');
    }

    public function handle(ServerResponseAction $responseAction, AddServerAction $addServerAction): void
    {
        $this->validate();
        if (!$responseAction->handle($this->url)) {
            Toast()->danger('Server is not responding. Please check the URL and try again.')
                ->push();
            return;
        }

        $addServerAction->handle(
            new WebsiteStore(
                name: $this->name,
                url: $this->url,
                description: $this->description,
                image: $this->image,
            )
        );

        $this->reset();
        $this->dispatchBrowserEvent('server-added');
        Toast()->success('Server added successfully.')
            ->push();
    }
}
