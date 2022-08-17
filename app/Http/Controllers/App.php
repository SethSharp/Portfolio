<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class App extends Controller {
    public function home() {
        return view('app');
    }
    public function about() {
        return view('about');
    }

    public function projects() {
        return view('projects');
    }

    public function qualifications() {
        return view('qualifications');
    }

}
