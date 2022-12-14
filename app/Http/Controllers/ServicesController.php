<?php

namespace App\Http\Controllers;

use App\EService;
use App\Location;
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
            ->with("related_publications", "related_services", "e_services")
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

    public function singleService(Request $request)
    {
        $service = ServicesList::where("slug", $request->slug)
            ->with("related_publications", "related_services", "locations", "e_services.single_service")
            ->first();

        $service->icon = Storage::url($service->icon);
        $service->different_section_image = Storage::url($service->different_section_image);

        return compact('service');
    }
}
