<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Newsletter;

class MailchimpController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);
        if (!Newsletter::isSubscribed($request->email)) {
            Newsletter::subscribe($request->email);
        }else if(Newsletter::isSubscribed($request->email)){
            return "user already subscribed!";
        }
        return "user subscribed successfully!";

    }
}
