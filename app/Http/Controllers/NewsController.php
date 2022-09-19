<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\NewsList;
use App\NewsSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class NewsController extends Controller
{
    public function index()
    {
        // $returned = Helper::shout();
        $news_settings = NewsSetting::first();
        return compact("news_settings");
    }

    public function news(Request $request)
    {
        $news = NewsList::orderBy("ht_pos")
            ->orderBy("id")
            ->with("news_categories")
            ->with("more_news")
            ->when($request->year, function ($query) use ($request) {
                $query->whereYear("date", $request->year);
            })
            ->when($request->categories, function ($query) use ($request) {
                $query->whereHas('news_categories', function ($query) use ($request) {
                    $query->whereIn('news_category_id', $request->categories);
                });
            })
            ->paginate(9);

        foreach ($news as $key => $value) {
            if ($value->gallery != "[]") {
                $arr = [];
                foreach (json_decode($value->gallery) as $key => $img) {
                    $arr[] = Storage::url($img);
                }
                $value->gallery = $arr;
            }
        }
        return $news;
    }


    public function searchNews(Request $request)
    {

        // $articles = Article::where('title', 'like', "%{$request->queryString}%")
        // ->orWhere('excerpt', 'like', "%{$request->queryString}%")
        // ->orWhere('date', 'like', "%{$request->queryString}%")
        // ->paginate(6);

        // dd($request->queryString);
        $news = NewsList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->paginate(6);
        return $news;
    }
}