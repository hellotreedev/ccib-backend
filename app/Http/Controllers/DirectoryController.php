<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Directory as MembershipDirectory;
use App\DirectoryList;
use App\SectorOfActivity;
use App\SingleDirectorySetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DirectoryController extends Controller
{
    public function index() {
        $directory_settings = MembershipDirectory::first();
        $directory_settings->image = Storage::url($directory_settings->image);


        $directory_list = DirectoryList::orderBy("ht_pos")->orderBy("id")->get();

        return compact("directory_settings", "directory_list");
    }

    public function singleDirectory(Request $request){
        $single_directory_settings = SingleDirectorySetting::first();

        $directory = DirectoryList::where("slug", $request->slug)
        ->with("member.sector_of_activity", "member.activity")
        ->firstOrFail();

        $sector_of_activity = SectorOfActivity::orderBy("ht_pos")->orderBy("id")->get();

        $activity = Activity::orderBy("ht_pos")->orderBy("id")->get();

        return compact("single_directory_settings", "directory", "sector_of_activity", "activity");
    }
}
