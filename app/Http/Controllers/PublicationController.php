<?php

namespace App\Http\Controllers;

use App\Category;
use App\PublicationsList;
use App\PublicationsSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicationController extends Controller
{
    public function index()
    {
        $publications_settings = PublicationsSetting::first();

        $categories = Category::orderBy('ht_pos')->get();

        return compact("publications_settings", "categories");
    }

    public function publications(Request $request)
    {
        $currentYear = Carbon::now()->year;
        $month = '';
        if (isset($request->date)) {
            $month = Carbon::createFromFormat('m-Y', $request->date);
            $month = $month->format('m');
        }

        $publications_list = PublicationsList::orderBy("date", "desc")
            ->orderBy("id")
            ->with("categories")
            ->when($request->categories, function ($query) use ($request) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->where('category_id', $request->categories);
                });
            })
            ->when($request->date, function ($query) use ($request) {
                $query->whereMonth('date', $month)->whereYear('date', $currentYear);
            })
            ->paginate(9);

        return compact("publications_list");
    }
}
