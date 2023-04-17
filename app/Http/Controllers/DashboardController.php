<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    public function __invoke(): ViewContract
    {
        return view('dashboard.index');
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect(route('login-form'));
    }
}
