<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use App\Http\Requests\ContactRequest;

class ContactController extends Controller
{
    public function create(Request $request) 
    {
        return Inertia::render('Home/Contact', [
            'user' => Auth::user()
        ]);
    }

    public function store(ContactRequest $request)
    {
        Mail::to('farmdirect9@gmail.com')
            ->send(new ContactMail($request));
    }
}
