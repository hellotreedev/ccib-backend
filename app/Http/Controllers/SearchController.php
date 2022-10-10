<?php

namespace App\Http\Controllers;

use App\BoardList;
use App\ContactSetting;
use App\Event;
use App\NewsList;
use App\Page;
use App\PublicationsList;
use App\SearchSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SearchController extends Controller
{
    public function index()
    {
        $search_settings = SearchSetting::first();
        $search_settings->phone_icon = Storage::url($search_settings->phone_icon);
        $search_settings->fax_icon = Storage::url($search_settings->fax_icon);
        $search_settings->mail = Storage::url($search_settings->mail);


        return $search_settings;
    }

    public function search(Request $request)
    {
        $pages = Page::search($request->queryString)
            ->orderBy("id")
            ->get();

        $news = NewsList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        $publications = PublicationsList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        $previous_events = Event::where('date', '<', Carbon::now())
            ->search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        $upcoming_events = Event::where('date', '>=', Carbon::now())
            ->search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        $members = BoardList::search($request->queryString)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        $contact = ContactSetting::search($request->queryString)
            ->first();



        return compact('pages', "news", "publications", "previous_events", "upcoming_events", "members", "contact");
    }
}
