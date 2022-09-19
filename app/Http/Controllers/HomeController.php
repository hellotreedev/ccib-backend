<?php

namespace App\Http\Controllers;

use App\Event;
use App\HomeSetting;
use App\NewsCategory;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $home_data = HomeSetting::first();

        $categories_home = NewsCategory::with('category_news')
        ->where("home_display", 1)
        ->get();

        $home_events = Event::where('home_display', 1)->get();

        return compact('home_data', 'categories_home', 'home_events');
    }
}
