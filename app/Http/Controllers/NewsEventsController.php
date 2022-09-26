<?php

namespace App\Http\Controllers;

use App\Event;
use App\NewsEventsSetting;
use App\NewsList;
use App\PublicationsList;
use Illuminate\Http\Request;

class NewsEventsController extends Controller
{
    public function index() {
        $settings = NewsEventsSetting::first();

        $news = NewsList::orderBy("date", "desc")->get();

        $events = Event::orderBy("date", "desc")->get();

        $publications = PublicationsList::orderBy("date", "desc")->get();

        return compact('settings', 'news', 'events', 'publications');
    }
}
