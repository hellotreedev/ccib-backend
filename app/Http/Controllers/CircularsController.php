<?php

namespace App\Http\Controllers;

use App\Circular;
use App\CircularsCateg;
use App\CircularsSetting;
use Illuminate\Http\Request;

class CircularsController extends Controller
{
    public function index() {
        
        $circulars_settings = CircularsSetting::first();

        $categories = CircularsCateg::orderBy('ht_pos')->orderBy('id')->get();
        return compact("circulars_settings", "categories");
    }

    public function circulars(Request $request) {
        $circulars = Circular::with('categories')
        ->when($request->categories, function ($query) use ($request) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('circulars_categ_id', $request->categories);
            });
        })
        ->paginate(9);
        return compact('circulars');
    }
}
