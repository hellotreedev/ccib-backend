<?php

namespace App\Http\Controllers;

use App\NewsEventsSetting;
use Illuminate\Http\Request;

class NewsEventsController extends Controller
{
    public function index() {
        $settings = NewsEventsSetting::first();
        return compact('settings');
    }
}
