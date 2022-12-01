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
use App\SectorOfActivityTranslation;
use Carbon\Carbon;
use Hellotreedigital\Cms\Controllers\CmsPageController;
use Hellotreedigital\Cms\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UploadSectorCSVCmsController extends Controller
{
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
    }

    public function index()
    {
        return view('vendor.cms.pages.upload-sector-csv.index');
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
                    throw ValidationException::withMessages(['sector Code empty' => "the sector code field cannot be empty"]);
                }else{
                    $sector_code = $act[0];
                }

                if($act[3] == 0){
                    throw ValidationException::withMessages(['Directory Code empty' => "the Directory code field cannot be empty"]);
                }else{
                    $directory_code = $act[3];
                }

                $sector = new SectorOfActivity();
                $sector->slug = Str::slug($act[2]);
                $sector->sector_code = $sector_code;
                $sector->directory_code = $directory_code;
                $sector->save();

                $language = Language::get();

                foreach ($language as $key => $lang) {
                    $sectorTranslation = new SectorOfActivityTranslation();
                    $sectorTranslation->sector_of_activity_id = $sector->id;
                    $sectorTranslation->locale = $lang->slug;
                    $sectorTranslation->title = $title[$lang->slug];
                    $sectorTranslation->save();
                }
            }
        
        }

        return redirect()->back()->with('success', 'Sector of activitites successfully imported!');

    }
}
