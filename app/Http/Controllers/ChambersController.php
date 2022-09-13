<?php

namespace App\Http\Controllers;

use App\ChamberList;
use App\ChamberSetting;
use Illuminate\Http\Request;

class ChambersController extends Controller
{
    public function index() {
        $chambers_settings = ChamberSetting::first();

        $chambers_list = ChamberList::orderBy("ht_pos")->get();

        return compact("chambers_settings", "chambers_list");
    }
}
