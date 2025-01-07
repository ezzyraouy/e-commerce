<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\mailer;
class ContactController extends Controller
{
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'tele' => 'required',
            'message' => 'required',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $details = ['name' => $request->name, 'email' => $request->email, 'tele' => $request->tele, /*'objet' => $request->objet,*/ 'message' => $request->message,];

        try {
            $mailer = new mailer($details);
            // Mail::to('a.ezzyraouy@directinvest.ma')->send($mailer);
            Mail::to(env('ADMIN_EMAIL'))->send($mailer);
            return back()->with('success', 'Your message has been sent successfully!');
        } catch (\Exception $e) {
        }
    }
}
