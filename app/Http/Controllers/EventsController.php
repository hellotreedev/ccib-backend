<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventContact;
use App\EventsSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class EventsController extends Controller
{
    public function index() {
        $events_settings = EventsSetting::first();
        $events_settings->phone_icon = Storage::url($events_settings->phone_icon);
        $events_settings->calendar_icon = Storage::url($events_settings->calendar_icon);
        $events_settings->mail_icon = Storage::url($events_settings->mail_icon);
        $events_settings->web_icon = Storage::url($events_settings->web_icon);
        $events_settings->pin_icon = Storage::url($events_settings->pin_icon);

        
        return compact("events_settings");
    }

    public function prevEvents() {
        $prev_events = Event::orderBy("ht_pos")->orderBy("id")->where("date", "<", Carbon::now())->paginate(8);

        foreach ($prev_events as $key => $value) {
            if ($value->gallery != "") {
                $arr = [];
                foreach (json_decode($value->gallery) as $key => $img) {
                    $arr[] = Storage::url($img);
                }
                $value->gallery = $arr;
            }
        }

        return compact("prev_events");
    }

    public function upcomingEvents() {
        $upcoming_events = Event::orderBy("ht_pos")->orderBy("id")->where("date", ">=", Carbon::now())->paginate(16);

        foreach ($upcoming_events as $key => $value) {
            if ($value->gallery != "") {
                $arr = [];
                foreach (json_decode($value->gallery) as $key => $img) {
                    $arr[] = Storage::url($img);
                }
                $value->gallery = $arr;
            }
        }

        return compact("upcoming_events");
    }

    public function singleEvent(Request $request) {
        $event = Event::where("slug", $request->slug);
        return $event;
    }

    public function contact(Request $request){
        $request->validate([
            'first_name' => 'required|regex:/^[a-zA-Z ]+$/',
            'last_name' => 'required|regex:/^[a-zA-Z ]+$/',
            'company' => 'required',
            'number_of_people' => 'required|numeric',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'description' => 'required',
        ]);

        $admin_email = EventsSetting::first();
        $admin_email = $admin_email->admin_email;

        $contact = new EventContact();
        $contact->first_name = $request->first_name;
        $contact->last_name = $request->last_name;
        $contact->company = $request->company;
        $contact->number_of_people = $request->number_of_people;
        $contact->email = $request->email;
        $contact->number = $request->number;
        $contact->description = $request->description;
        $contact->save();

        Mail::send('emails/events-email', compact('request', 'admin_email'), function ($message) use ($request, $admin_email) {
            $message->to($admin_email);
        });
    }
}
