<?php

namespace App\Http\Controllers\Cms;

use App\Activity;
use App\ActivityMember;
use App\ActivityMemberTranslation;
use App\ActivityTranslation;
use App\Directory;
use App\DirectoryList;
use App\Http\Controllers\Controller;
use App\MemberSocialMedia;
use App\MembersOption;
use App\PublicationsCategory;
use App\PublicationsList;
use App\PublicationsListTranslation;
use App\SectorOfActivity;
use Carbon\Carbon;
use Hellotreedigital\Cms\Controllers\CmsPageController;
use Hellotreedigital\Cms\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UploadActivityCSVCmsController extends Controller
{
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
    }

    public function index()
    {
        return view('vendor.cms.pages.upload-activity-csv.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $key => $act) {
            if ($key == 0) continue;
        
            else{
                if($act[1] == "" || $act[2] == ""){
                    throw ValidationException::withMessages(['Title empty' => "the title field cannot be empty"]);
                }else{
                    $title = [
                        'en' => $act[2],
                        'ar' => $act[1],
                    ];
                }

                if($act[0] == 0){
                    throw ValidationException::withMessages(['activity code empty' => "the activity code field cannot be empty"]);
                }else{
                    $act_code = $act[0];
                }

                if($act[3] == 0){
                    throw ValidationException::withMessages(['sector code empty' => "the sector code field cannot be empty"]);
                }else{
                    $sector_code = $act[3];
                }

                $activity = new Activity();
                $activity->slug = Str::slug($act[2]);
                $activity->activity_code = $act_code;
                $activity->sector_code = $sector_code;
                $activity->save();

                $sector_related = SectorOfActivity::where('sector_code', $activity->sector_code)->first();

                $activity->sector_of_activity()->attach($sector_related);

                $language = Language::get();

                foreach ($language as $key => $lang) {
                    $activityTranslation = new ActivityTranslation();
                    $activityTranslation->activity_id = $activity->id;
                    $activityTranslation->locale = $lang->slug;
                    $activityTranslation->title = $title[$lang->slug];
                    $activityTranslation->save();
                }
            }
        
        }

        return redirect()->back()->with('success', 'Activities successfully imported!');

    }
}
