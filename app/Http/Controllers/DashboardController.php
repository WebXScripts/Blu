<?php

namespace App\Http\Controllers;

use App\Services\StatisticsService;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __construct(
        private readonly StatisticsService $statisticsService
    ) {}

    public function __invoke(): ViewContract
    {
        return view('dashboard.index', [
            'averageUpTime' => $this->statisticsService->calculateAverageUpTimePercent()
        ]);
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect(route('login-form'));
    }
}
