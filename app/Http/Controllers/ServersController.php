<?php

namespace App\Http\Controllers;

class ServersController extends Controller
{
    public function __invoke()
    {
        return view('dashboard.servers.index');
    }
}
