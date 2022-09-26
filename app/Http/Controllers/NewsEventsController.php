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

        $news = NewsList::orderBy("date", "desc")->get();

        $previous_events = Event::orderBy("date", "desc")->where("date", "<=", Carbon::now())->get();

        $upcoming_events = Event::orderBy("date", "desc")->where("date", ">", Carbon::now())->get();

        $publications = PublicationsList::orderBy("date", "desc")->get();

        return compact('settings', 'news', 'events', 'publications');
    }
}
