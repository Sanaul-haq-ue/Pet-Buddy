<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Mail\ContactMessageMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $siteSetting = SiteSetting::first();

        return view('frontEnd.contact', compact('siteSetting'));
    }


    public function send(Request $request)
    {
        // Whitelist validation: only these 4 fields can ever reach this
        // controller's logic. Anything else in the request is ignored.
        // No 'file' or 'image' rule anywhere = file uploads are impossible
        // here even if someone tampers with the form and adds a file input.
        $validated = $request->validate([
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'subject' => ['required', 'string', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ]);

        // Strip any HTML/script tags from every field before it ever
        // touches the email or gets logged. Plain text only.
        foreach ($validated as $key => $value) {
            $validated[$key] = trim(strip_tags($value));
        }

        Mail::to(config('mail.contact_recipient', config('mail.from.address')))
            ->send(new ContactMessageMail($validated));

        return response()->json([
            'message' => 'Your message has been sent successfully. We will get back to you soon.',
        ]);
    }
}
