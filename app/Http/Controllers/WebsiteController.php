<?php

namespace App\Http\Controllers;

use App\EservicesSingle;
use App\Event;
use App\NewsList;
use App\ServicesList;
use Carbon\Carbon;
use App\DirectoryList;
use App\Project;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function sitemap()
    {
        return response()
            ->view('sitemap', [
                'services'=>ServicesList::select('slug')->get(),
                'e_services'=>EservicesSingle::select('slug')->get(),
                'news'=>NewsList::select('slug')->get(),
                'past_events'=>Event::where("date", "<=", Carbon::now())->select('slug')->get(),
                'upcoming_events'=>Event::where("date", ">", Carbon::now())->select('slug')->get(),
                'single_directory'=>DirectoryList::select('slug')->get(),
                'projects'=>Project::select('slug')->get()
                
            ])
            ->header('Content-Type', 'text/xml');
    }
}
