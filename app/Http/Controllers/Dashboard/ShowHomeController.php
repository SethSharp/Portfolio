<?php

namespace App\Http\Controllers\Dashboard;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;

class ShowHomeController extends Controller
{
    public function __invoke(): Response
    {
        return Inertia::render('Dashboard/Home');
    }
}
