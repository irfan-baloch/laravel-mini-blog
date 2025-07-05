<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function about()
    {
        return view('pages.about');
    }

    public function contact()
    {
        return view('pages.contact');
    }

    public function storeContact(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|email',
            'subject'   => 'nullable|string|max:255',
            'message'   => 'required|string|min:10'
        ]);

        Contact::create($request->only('name', 'email', 'subject', 'message'));

        return back()->with('success', 'Your message has been sent!');

    }
}
