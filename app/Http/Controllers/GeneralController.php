<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\PageNotFound;
use App\SeoPage;
use App\Popup;
use App\SocialMedia;
use App\ServicesList;
use App\EService;
use App\EventsSetting;
use App\ServicesSetting;
use App\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralController extends Controller
{
    public function index() {
        $popup = Popup::first();

        $general_settings = WebsiteSetting::first();

        $menu_items = MenuItem::first();

        $social_media = SocialMedia::orderBy("ht_pos")->orderBy("id")->get();

        $not_found = PageNotFound::first();
        
        $seo = SeoPage::get();
        
        $e_services = EService::orderBy("ht_pos")->orderBy("id")->with('single_service')->get();
        foreach ($e_services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }
        
        $services_settings = ServicesSetting::first();

        $services = ServicesList::orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        foreach ($services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }
        
        $events_settings = EventsSetting::first();
        $events_settings->phone_icon = Storage::url($events_settings->phone_icon);
        $events_settings->calendar_icon = Storage::url($events_settings->calendar_icon);
        $events_settings->mail_icon = Storage::url($events_settings->mail_icon);
        $events_settings->web_icon = Storage::url($events_settings->web_icon);
        $events_settings->pin_icon = Storage::url($events_settings->pin_icon);

        return compact("popup", "general_settings", "social_media", "menu_items", "not_found", "seo", "services", "services_settings", "e_services", "events_settings");
    }
}
