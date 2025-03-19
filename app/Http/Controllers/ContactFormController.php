<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function showForm()
    {
        return view('contact');  // Contact form view
    }

    public function sendEmail(Request $request)
    {
        // Define custom validation messages
        $messages = [
            'fname.required' => 'First Name is required.',
            'lname.required' => 'Last Name is required.',
            'email.required' => 'Email address is required.',
            'email.email' => 'Please provide a valid email address.',
            'pNumber.required' => 'Phone number is required.',
            'pNumber.numeric' => 'Please provide a valid phone number.',
            'desc.required' => 'Please write your message.',
        ];

        // Validate the form data
        $request->validate([
            'fname' => 'required|string|max:30',
            'lname' => 'required|string|max:30',
            'email' => 'required|email|max:50',
            'pNumber' => 'required|numeric|max:14',
            'desc' => 'required|string',
        ], $messages); // Pass custom messages

        // Prepare the email data
        $data = [
            'firstName' => $request->fname,
            'lastName' => $request->lname,
            'email' => $request->email,
            'phone' => $request->pNumber,
            'message' => $request->desc,
        ];

        // Send email using Mail facade
        Mail::send([], [], function ($message) use ($data) {
            $message->to('optique.team28@gmail.com')  // The email where the form data will be sent
                    ->subject('New Contact Form Submission')
                    ->setBody(
                        'Name: ' . $data['firstName'] . ' ' . $data['lastName'] . '\n' .
                        'Email: ' . $data['email'] . '\n' .
                        'Phone: ' . $data['phone'] . '\n' .
                        'Message: ' . $data['message']
                    );
        });

        // Redirect with a success message
        return redirect()->back()->with('success', 'Your message has been sent!');
    }
}