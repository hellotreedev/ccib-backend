<?php

namespace App\Http\Controllers;

use App\ContactForm;
use App\ContactLocation;
use App\ContactSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use stdClass;


class ContactController extends Controller
{
    public function index()
    {
        $contact_settings = ContactSetting::with('pages')->first();
        $contact_settings->background_image = Storage::url($contact_settings->background_image);

        $contact_locations = ContactLocation::orderBy("ht_pos")->orderBy("id")->get();

        $map_coord = new stdClass();


        foreach ($contact_locations as $key => $value) {
            if ($value->map_coordinates) {
                $coordinates = explode(',', $value->map_coordinates);

                $value->lat = $coordinates[0];
                $value->long = $coordinates[1];
            }
        }



        return compact('contact_settings', 'contact_locations');
    }



    public function contact($locale, Request $request)
    {
        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z ]+$/',
            'last_name' => 'required|regex:/^[a-zA-Z ]+$/',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'message' => 'required',
        ]);

        $admin_email = ContactSetting::first();
        $admin_email = $admin_email->admin_email;

        $contact = new ContactForm();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->email = $request->email;
        $contact->number = $request->number;
        $contact->message = $request->message;
        $contact->save();

        Mail::send('emails/contact-email', compact('request', 'admin_email'), function ($message) use ($request, $admin_email) {
            $message->to($admin_email);
        });
    }
}
