<?php

namespace App\Http\Controllers;

use App\Event;
use App\HomeSetting;
use App\NewsCategory;
use App\PublicationsList;
use App\ServicesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index()
    {
        $home_data = HomeSetting::first();

        $categories_home = NewsCategory::with('category_news')
            ->where("home_display", 1)
            ->get();

        $home_events = Event::where('home_display', 1)->get();

        $services = ServicesList::orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        foreach ($services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }

        $publications_list = PublicationsList::orderBy("date", "desc")
        ->orderBy("id")
        ->with("categories")
        ->get();

        return compact('home_data', 'categories_home', 'home_events', 'services', 'publications_list');
    }
}
