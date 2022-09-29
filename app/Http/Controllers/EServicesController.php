<?php

namespace App\Http\Controllers;

use App\EService;
use App\EservicesSingle;
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
        $e_service = EservicesSingle::where("slug", $request->slug)->with("boxes")->first();
        
        return compact('e_service');
    }
}
