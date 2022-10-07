<?php

namespace App\Http\Controllers;

use App\RennovationSponsorsList;
use App\RennovationSponsorsSetting;
use App\SponsorLevel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RennovationController extends Controller
{
    public function index() {
        $rennovation_settings = RennovationSponsorsSetting::first();
        $rennovation_settings->image = Storage::url($rennovation_settings->image);
        $rennovation_settings->icon = Storage::url($rennovation_settings->icon);

        $sponsor_levels = SponsorLevel::orderBy("ht_pos")->orderBy("id")->get();

        $rennovation_sponsors = RennovationSponsorsList::orderBy("ht_pos")
        ->orderBy("id")
        ->with("sponsor_level")
        ->get();

        return compact("rennovation_settings", "sponsor_levels", "rennovation_sponsors");
    }
}
