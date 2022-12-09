<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\NewsCategory;
use App\NewsList;
use App\NewsSetting;
use App\Year;
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
        $news_settings->fb_icon = Storage::url($news_settings->fb_icon);
        $news_settings->twitter_icon = Storage::url($news_settings->twitter_icon);
        $news_settings->linkedin_icon = Storage::url($news_settings->linkedin_icon);

        $years = NewsList::select(\DB::raw('YEAR(date) as year'))->distinct()->get()->pluck('year');
        $categories = NewsCategory::orderBy('ht_pos')->orderBy('id')->get();


        return compact("news_settings", "years", "categories");
    }

    public function news(Request $request)
    {
        $news = NewsList::orderBy('date', "desc")
            ->with("news_categories")
            ->with("related_news")
            ->when($request->year, function ($query) use ($request) {
                $query->whereYear("date", $request->year);
            })
            ->when($request->categories, function ($query) use ($request) {
                $query->whereHas('news_categories', function ($query) use ($request) {
                    $query->where('news_category_id', $request->categories);
                });
            })
            ->when($request->queryString, function ($query) use ($request) {
                $query->search($request->queryString);
            })
            ->paginate(10);

        return $news;
    }

    public function test() {
        $news = NewsList::with("news_categories")->get();

        $categories = [];
        $newsArr = [];

        foreach ($news as $key => $el) {
            $categories = $el->news_categories;
            $newsArr[]= $el->id;
         }

         


        return compact('news', 'categories', "newsArr");
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
            ->distinct()
            ->paginate(6);
        return $news;
    }

    public function singleNews(Request $request)
    {
        $news = NewsList::where("slug", $request->slug)
            ->with("news_categories")
            ->with("related_news")
            ->first();

        return $news;
    }
}
