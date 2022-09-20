<?php

namespace App\Http\Controllers;

use App\EService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EServicesController extends Controller
{
    public function index() {
        $e_services = EService::orderBy("ht_pos")->orderBy("id")->get();
        foreach ($e_services as $key => $service) {
            $service->icon = Storage::url($service->icon);
        }
        

        return compact("e_services");
    }

    public function singleEservice(Request $request) {
        $e_service = EService::where("slug", $request->slug)->first();
        $e_service->icon = Storage::url($e_service->icon);
        
        return compact('e_service');
    }
}
