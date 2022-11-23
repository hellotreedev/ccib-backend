<?php

namespace App\Http\Controllers;

use App\Event;
use App\NewsEventsSetting;
use App\NewsList;
use App\PublicationsList;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NewsEventsController extends Controller
{
    public function index() {
        $settings = NewsEventsSetting::first();

        $news = NewsList::orderBy("date", "desc")->take(4)->get();

        $previous_events = Event::orderBy("date", "desc")->where("date", "<=", Carbon::now())->take(4)->get();

        $upcoming_events = Event::orderBy("date", "desc")->where("date", ">", Carbon::now())->take(4)->get();

        $publications = PublicationsList::orderBy("date", "desc")->take(4)->get();

        return compact('settings', 'news', 'previous_events', 'upcoming_events', 'publications');
    }
}
