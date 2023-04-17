<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ErrorMessage extends Component
{
    public string $title;
    public string $message;

    public function __construct(string $title = "Whoops!", string $message = '')
    {
        $this->title = $title;
        $this->message = $message;
    }

    public function render(): View|Closure|string
    {
        return view('components.error-message');
    }
}
