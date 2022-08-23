<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;

class ContactController extends Controller
{
    public function SendEmail(Request $request) {
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message
        ];
        Mail::to("seth.sharp@outlook.com")->send(new ContactMail($data));
        return view('app');
    }
}
