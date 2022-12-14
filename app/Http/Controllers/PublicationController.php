<?php

namespace App\Http\Controllers;

use App\Category;
use App\PublicationsList;
use App\PublicationsSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index() {
        $publications_settings = PublicationsSetting::first();

        $categories = Category::orderBy('ht_pos')->get();

         return compact("publications_settings", "categories");
    }

    public function publications(Request $request) {
        $publications_list = PublicationsList::orderBy("date", "desc")
        ->orderBy("id")
        ->with("categories")
        ->when($request->categories, function ($query) use ($request) {
            $query->whereHas('categories', function ($query) use ($request) {
                $query->where('category_id', $request->categories);
            });
        })
        ->paginate(9);

       
        

        return compact("publications_list");
    }
}
