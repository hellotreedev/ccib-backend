<?php

namespace App\Http\Controllers;

use App\MenuItem;
use App\PageNotFound;
use App\SeoPage;
use App\Popup;
use App\SocialMedia;
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

        return compact("popup", "general_settings", "social_media", "menu_items", "not_found", "seo");
    }
}
