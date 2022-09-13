<?php

namespace App\Http\Controllers;

use App\EService;
use App\ServicesList;
use App\ServicesSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function index()
    {

        $services_settings = ServicesSetting::first();

        $services = ServicesList::orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        foreach ($services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }

        $e_services = EService::orderBy("ht_pos")
        ->orderBy("id")
        ->get();

        foreach ($e_services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }

        return compact("services_settings", "services", "e_services");
    }
}
