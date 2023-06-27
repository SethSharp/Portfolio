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

    public function qualifications()
    {
        return view('qualifications');
    }

    public function wil()
    {
        return view('wil');
    }
}
