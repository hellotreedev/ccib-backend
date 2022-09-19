<?php

namespace App\Http\Controllers;

use App\Circular;
use App\CircularsSetting;
use Illuminate\Http\Request;

class CircularsController extends Controller
{
    public function index() {
        $circulars_settings = CircularsSetting::first();
        return compact("circulars_settings");
    }

    public function circulars(Request $request) {
        $circulars = Circular::with('categories')
        ->when($request->categories, function ($query) use ($request) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->whereIn('circulars_categ_id', $request->categories);
            });
        })
        ->paginate(9);
        return compact('circulars');
    }
}
