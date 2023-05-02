<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SecondRow extends Component
{
    public int $averageUpTime;

    /**
     * Create a new component instance.
     */
    public function __construct(int $averageUpTime)
    {
        $this->averageUpTime = $averageUpTime;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.second-row', [
            'averageUpTime' => $this->averageUpTime
        ]);
    }
}
