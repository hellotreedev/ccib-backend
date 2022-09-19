<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventsSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function index() {
        $events_settings = EventsSetting::first();
        return compact("events_settings");
    }

    public function prevEvents() {
        $prev_events = Event::orderBy("ht_pos")->orderBy("id")->where("date", "<", Carbon::now())->paginate(8);

        return compact("prev_events");
    }

    public function upcomingEvents() {
        $upcoming_events = Event::orderBy("ht_pos")->orderBy("id")->where("date", ">=", Carbon::now())->paginate(16);

        return compact("upcoming_events");
    }
}
