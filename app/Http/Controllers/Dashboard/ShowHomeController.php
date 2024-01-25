<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use Inertia\Response;

class ShowHomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Home');
    }
}
