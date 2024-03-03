<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function __invoke(): Response
    {
        $user = auth()->user();

        $user->load('devices');

        return Inertia::render('Dashboard', ['devices' => $user->devices]);
    }
}
