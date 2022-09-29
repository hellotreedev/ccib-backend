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
            if (request('locale') == 'ar'){
                return "المستخدم مشترك بالفعل!";
            }else{
                return "user already subscribed!";
            }
            
        }

        if (request('locale') == 'ar'){
            return "اشترك المستخدم بنجاح!";
        }else{
            return "user subscribed successfully!";
        }

    }
}
