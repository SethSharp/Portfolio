<?php

namespace App\Http\Controllers;

class App extends Controller
{
    public function about()
    {
        return view('app');
    }

    public function projects()
    {
        return view('projects');
    }

    public function capabilities()
    {
        return view('capabilities');
    }

    public function wil()
    {
        return view('wil');
    }
}
