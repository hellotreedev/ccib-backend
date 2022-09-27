<?php

namespace App\Http\Controllers;

use App\BoardList;
use App\Event;
use App\NewsList;
use App\Page;
use App\PublicationsList;
use App\SearchSetting;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $search_settings = SearchSetting::first();

        return $search_settings;
    }

    public function search(Request $request)
    {
        $pages = Page::search($request->queryString)
            ->orderBy("id")
            ->distinct()
            ->get();

        $news = NewsList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->distinct()
            ->get();

        $publications = PublicationsList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->distinct()
            ->get();

        $events = Event::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->distinct()
            ->get();

        $members = BoardList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->distinct()
            ->get();

        return compact('pages', "news", "publications", "events", "members");
    }
}
