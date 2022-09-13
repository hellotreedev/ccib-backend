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
}
