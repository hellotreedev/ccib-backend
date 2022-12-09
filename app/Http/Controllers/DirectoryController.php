<?php

namespace App\Http\Controllers;

use App\Activity;
use App\ActivityMember;
use App\Directory as MembershipDirectory;
use App\DirectoryList;
use App\MembersOption;
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

        $members_options = MembersOption::orderBy("ht_pos")->orderBy("id")->get();

        return compact("directory_settings", "directory_list", "members_options");
    }

    public function singleDirectory(Request $request){
        $single_directory_settings = SingleDirectorySetting::first();

        $directory = DirectoryList::where("slug", $request->slug)
        ->with("member.sector_of_activity", "member.activity", "member.socials", "member.members_option")
        ->first();

        $sector_of_activity = SectorOfActivity::orderBy("ht_pos")->orderBy("id")->get();

        $activity = Activity::orderBy("ht_pos")->orderBy("id")->get();
        
        
        
        
        $members = ActivityMember::
            whereHas('directory', function($query) use ($request, $directory){
            $query->where('directory_list_id', $directory->id);
        })
        ->search($request->queryString)
        ->with("sector_of_activity", "activity", "socials", "members_option")
        ->paginate(20);
    
        
        return compact("single_directory_settings", "directory", "sector_of_activity", "activity" , "members");
    }

    public function searchDirectory(Request $request)
    {
        $members = ActivityMember::when($request->slug)
        ->whereHas('directory', function($query) use ($request){
            $query->where('slug', $request->slug);
        })
        ->search($request->queryString)
        ->distinct()
            ->get();
        return $members;
    }
    
}
