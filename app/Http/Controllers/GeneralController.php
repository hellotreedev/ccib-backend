<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\Popup;
use App\SocialMedia;
use App\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GeneralController extends Controller
{
    public function index() {
        $popup = Popup::first();
        $popup->image = Storage::url($popup->image);

        $general_settings = WebsiteSetting::first();
        $general_settings->hotline_logo = Storage::url($general_settings->hotline_logo);

        $menu_items = MenuItem::first();

        $social_media = SocialMedia::orderBy("ht_pos")->orderBy("id")->get();
        foreach ($social_media as $key => $icon) {
            $icon->icon = Storage::url($icon->icon);
        }

        return compact("popup", "general_settings", "social_media", "menu_items");
    }
}
