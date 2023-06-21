<?php

namespace App\Http\Livewire\Forms;

use App\Actions\Forms\AddServerAction;
use App\Actions\Servers\ServerResponseAction;
use App\DTO\Website\WebsiteStore;
use App\Enums\IntervalUnit;
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
    public int $interval = 5;
    public string $interval_unit = 'minutes';
    public $image;

    //Todo: i can probably convert interval_unit "in" key from enum
    protected array $rules = [
        'name' => ['required', 'string', 'max:255'],
        'url' => ['required', 'string', 'max:255'],
        'description' => ['nullable', 'string', 'max:255'],
        'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg'],
        'interval' => ['required', 'integer', 'min:1', 'max:1000', 'numeric'],
        'interval_unit' => ['required', 'string', "in:minutes,hours,days,weeks,months,years"],
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

        try {
            $addServerAction->handle(
                new WebsiteStore(
                    name: $this->name,
                    url: $this->url,
                    description: $this->description,
                    interval: $this->interval,
                    intervalUnit: IntervalUnit::tryFrom($this->interval_unit),
                    image: $this->image,
                )
            );
        } catch (\Exception) {
            Toast()->danger('Something went wrong, report this on our GitHub.')
                ->push();
            return;
        }

        $this->reset();
        $this->dispatchBrowserEvent('server-added');
        Toast()->success('Server added successfully.')
            ->push();
    }
}
