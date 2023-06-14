<?php

namespace App\Http\Livewire\Tables\Base\Components;

class Column
{
    public string $component = 'table.column';
    public string $key;
    public string $label;

    public function __construct($key, $label)
    {
        $this->key = $key;
        $this->label = $label;
    }

    public static function make($key, $label): static
    {
        return new static($key, $label);
    }
}
