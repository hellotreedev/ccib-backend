<?php

namespace App\Http\Controllers;

use App\ProjectList;
use App\ServiceList;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function sitemap()
    {
        return response()
            ->view('sitemap')
            ->header('Content-Type', 'text/xml');
    }
}
