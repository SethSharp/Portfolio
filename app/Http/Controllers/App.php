<?php

namespace App\Http\Controllers;

class App extends Controller
{
    public function home()
    {
        return view('app');
    }

    public function about()
    {
        return view('about');
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
