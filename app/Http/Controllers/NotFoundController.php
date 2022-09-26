<?php

namespace App\Http\Controllers;

use App\PageNotFound;
use Illuminate\Http\Request;

class NotFoundController extends Controller
{
    public function index() {
        $not_found = PageNotFound::first();
        return $not_found;
    }
}
