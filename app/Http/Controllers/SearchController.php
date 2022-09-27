<?php

namespace App\Http\Controllers;

use App\SearchSetting;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index() {
        $search_settings = SearchSetting::first();

        return $search_settings;
    }
}
