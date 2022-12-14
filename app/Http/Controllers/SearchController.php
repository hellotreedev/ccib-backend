<?php

namespace App\Http\Controllers;

use App\AboutSetting;
use App\BoardList;
use App\BoardOfDirectorsSetting;
use App\ChamberList;
use App\ChamberSetting;
use App\ContactSetting;
use App\Directory as MembershipDirectory;
use App\DirectoryList;
use App\Event;
use App\HomeSetting;
use App\NewsList;
use App\Page;
use App\ProjectsSetting;
use App\PublicationsList;
use App\PublicationsSetting;
use App\RennovationSponsorsSetting;
use App\SearchSetting;
use App\ServicesList;
use App\ServicesSetting;
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
        $news = NewsList::search($request->queryString, null, true, true)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->paginate(4, ["*"], "newsPage");
            

        $publications = PublicationsList::search($request->queryString, null, true, true)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->paginate(6 , ["*"], "publicationsPage");

        $previous_events = Event::where('date', '<', Carbon::now())
            ->search($request->queryString, null, true, true)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->paginate(4, ["*"], "prevEventsPage");

        $upcoming_events = Event::where('date', '>=', Carbon::now())
            ->search($request->queryString, null, true, true)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->paginate(4, ["*"], "upcomingEventsPage");

        $members = BoardList::search($request->queryString, null, true, true)
            ->orderBy("ht_pos")
            ->orderBy("id")
            ->get();

        $contact = ContactSetting::with('pages')->search($request->queryString, null, true, true)
            ->first();

        $home = HomeSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $about = AboutSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $chamber = ChamberSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $chamber_list = ChamberList::with('pages')->search($request->queryString, null, true, true)->get()->toArray();
        
        $sponsor = RennovationSponsorsSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $board = BoardOfDirectorsSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $board_list = BoardList::with('pages')->search($request->queryString, null, true, true)->get()->toArray();

        $service = ServicesSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $service_list = ServicesList::with('pages')->search($request->queryString, null, true, true)->get()->toArray();

        $pub = PublicationsSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $project = ProjectsSetting::with('pages')->search($request->queryString, null, true, true)->first();

        $directory = MembershipDirectory::with('pages')->search($request->queryString, null, true, true)->first();

        $directory_list = DirectoryList::with('pages')->search($request->queryString, null, true, true)->get()->toArray();


        



        // $pages = Page::search($request->queryString)
        // ->orderBy("id")
        // ->get()
        // ->toArray();
        
        $pages = [];

        $arr = [];
        if ($contact) {
            $title = $contact->pages;
            $arr[] = $title;
            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }
        
        $pagesAdded = [];
        
        
        if(count($news)){
            $pagesAdded[] = Page::where("slug", "/news")->first();
        }
        
        if(count($publications)){
             $pagesAdded[] = Page::where("slug", "/publications")->first();
        }
        
        if(count($previous_events)){
             $pagesAdded[] = Page::where("slug", "/prev-events")->first();
        }
        
         if(count($upcoming_events)){
             $pagesAdded[] = Page::where("slug", "/upcoming-events")->first();
        }
        
        foreach($pagesAdded as $page){
            $pages[] = $page; 
        }
        
        

        if ($home) {
            $title = $home->pages;
            $arr[] = $title;
            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if ($about) {
            $title = $about->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if ($chamber) {
            $title = $chamber->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if(!empty($chamber_list)){
            foreach ($chamber_list as $key => $value) {
                $title = $value['pages'];
                $arr[] = $title;
    
                foreach ($arr as $key => $val) {
                    if(!in_array($val, $pages)){
                        $pages[] = $val;
                    }
                }
            }
        }

        if ($sponsor) {
            $title = $sponsor->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if ($board) {
            $title = $board->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if(!empty($board_list)){
            foreach ($board_list as $key => $value) {
                $title = $value['pages'];
                $arr[] = $title;
    
                foreach ($arr as $key => $val) {
                    if(!in_array($val, $pages)){
                        $pages[] = $val;
                    }
                }
            }
        }

        if ($service) {
            $title = $service->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if(!empty($service_list)){
            foreach ($service_list as $key => $value) {
                $title = $value['pages'];
                $arr[] = $title;
    
                foreach ($arr as $key => $val) {
                    if(!in_array($val, $pages)){
                        $pages[] = $val;
                    }
                }
            }
        }

        if ($pub) {
            $title = $pub->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        if ($project) {
            $title = $project->pages;
            $arr[] = $title;

            foreach ($arr as $key => $value) {
                if(!in_array($value, $pages)){
                    $pages[] = $value;
                }
            }
        }

        // if ($directory) {
        //     $title = $directory->pages;
        //     $arr[] = $title;

        //     foreach ($arr as $key => $value) {
        //         if(!in_array($value, $pages)){
        //             $pages[] = $value;
        //         }
        //     }
        // }

        if(!empty($directory_list)){
            foreach ($directory_list as $key => $value) {
                $title = $value['pages'];
                $arr[] = $title;
    
                foreach ($arr as $key => $val) {
                    if(!in_array($val, $pages)){
                        $pages[] = $val;
                    }
                }
            }
        }
        

        return compact('pages', "news", "publications", "previous_events", "upcoming_events", "members");
    }
}
