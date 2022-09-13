<?php

namespace App\Http\Controllers;

use App\AboutSetting;
use App\ChairmenList;
use App\MilestonesList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    
    public function index() {
        $about_settings = AboutSetting::first();
        $about_settings->about_image = Storage::url($about_settings->about_image);
        $about_settings->board_directors_image = Storage::url($about_settings->board_directors_image);
        $about_settings->chairman_image = Storage::url($about_settings->chairman_image);
        $about_settings->chamber_image = Storage::url($about_settings->chamber_image);
        $about_settings->strategy_image = Storage::url($about_settings->strategy_image);


        $milestones = MilestonesList::orderBy("ht_pos")->orderBy("id")->get();
        foreach ($milestones as $key => $milestone) {
            $milestone->image = Storage::url($milestone->image);
        }

        $chairmen = ChairmenList::orderBy("ht_pos")->orderBy("id")->get();
        foreach ($chairmen as $key => $chairman) {
            $chairman->image = Storage::url($chairman->image);
        }

        return compact("about_settings", "milestones", "chairmen");
    }

}
