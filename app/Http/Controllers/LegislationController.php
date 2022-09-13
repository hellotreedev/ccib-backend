<?php

namespace App\Http\Controllers;

use App\Legistlation;
use App\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LegislationController extends Controller
{
    public function index() {
        $legislation = Legistlation::with("e_services")->first();
        $legislation->section_image = Storage::url($legislation->section_image);
        $legislation->transactions_pdf = Storage::url($legislation->transactions_pdf);
        foreach ($legislation->e_services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }

        $locations = Location::orderBy("ht_pos")->orderBy("id")->get();

        return compact("legislation", "locations");
    }
}
