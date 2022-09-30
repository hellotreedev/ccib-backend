<?php

namespace App\Http\Controllers;

use App\Event;
use App\HomeNewsEvent;
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

        $home_data->main_image = Storage::url($home_data->main_image);
        $home_data->image1 = Storage::url($home_data->image1);
        $home_data->image2 = Storage::url($home_data->image2);
        $home_data->image3 = Storage::url($home_data->image3);
        $home_data->image4 = Storage::url($home_data->image4);
        $home_data->image5 = Storage::url($home_data->image5);
        $home_data->about_image = Storage::url($home_data->about_image);
        
        $services = ServicesList::where("home_display", 1)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        foreach ($services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }

        $publications_list = PublicationsList::where("home_display", 1)
            ->orderBy("date", "desc")
            ->orderBy("id")
            ->with("categories")
            ->get();

        return compact('home_data', 'services', 'publications_list');
    }

    public function swiper()
    {
        $home = HomeSetting::with("home_news.news_categories")->first();

        $selectedNews = [];
        $selectedEvents = [];
        $catArr = [];


        foreach ($home->home_news as $key => $el) {
            $selectedNews[] = $el;
        }

        foreach ($selectedNews as $key => $value) {
            foreach ($value->news_categories as $key => $cat) {
                if (!in_array($cat->id, $catArr)) {
                    $catArr[]  = $cat->id;
                }
            }
        }

        $categories = NewsCategory::whereIn('id', $catArr)->get();

        $events = HomeSetting::with("home_events")->get();

        foreach ($home->home_events as $key => $el) {
            $selectedEvents[] = $el;
        }

        return compact('selectedNews',  'selectedEvents', 'categories');
    }
}
