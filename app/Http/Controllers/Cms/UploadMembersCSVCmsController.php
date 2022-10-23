<?php

namespace App\Http\Controllers\Cms;

use App\Activity;
use App\ActivityMember;
use App\ActivityMemberTranslation;
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

class UploadMembersCSVCmsController extends Controller
{
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
    }

    public function index()
    {
        return view('vendor.cms.pages.upload-members-csv.index');
    }

    public function store(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            'images' => 'required|file|mimes:zip'
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));


        foreach ($data as $key => $member) {
            if ($key == 0) continue;

            else {
                if ($member[0] == "") {
                    throw ValidationException::withMessages(['sector of activity empty' => "the sector of activity field should not be empty !"]);
                } else {
                    $sectors = $member[0];
                    $sectors = explode(',',  $sectors);
                }

                if ($member[2] == "") {
                    throw ValidationException::withMessages(['activity empty' => "the activity field should not be empty !"]);
                } else {
                    $activities = $member[2];
                    $activities = explode(',',  $activities);
                }

                if ($member[3] == "") {
                    throw ValidationException::withMessages(['directory empty' => "the directory field should not be empty !"]);
                } else {
                    $directories = $member[3];
                    $directories = explode(',',  $directories);
                }

                foreach ($sectors as $key => $sector) {
                    $valid_sector = SectorOfActivity::where("id", $sector)->first();
                    if ($valid_sector == null) {
                        throw ValidationException::withMessages(['invalid sector ID' => "the sector ID " . $sector . " does not exist"]);
                    }
                }

                foreach ($activities as $key => $act) {
                    $valid_activity = Activity::where("id", $act)->first();
                    if ($valid_activity == null) {
                        throw ValidationException::withMessages(['invalid activity ID' => "the activity ID " . $act . " does not exist"]);
                    }
                }

                foreach ($directories as $key => $dir) {
                    $valid_directory = DirectoryList::where("id", $dir)->first();
                    if ($valid_directory == null) {
                        throw ValidationException::withMessages(['invalid directory ID' => "the directory ID " . $dir . " does not exist"]);
                    }
                }

                $phone1_url = $member[4];
                $phone2_url = $member[5];
                $phone3_url = $member[6];
                $fax_url = $member[7];
                $web_url = $member[8];
                $location_url = $member[9];
                $members_option_id = $member[10];
                $image = $member[31];

                $valid_member_option = MembersOption::where("id", $members_option_id)->first();
                if ($valid_member_option == null) {
                    throw ValidationException::withMessages(['invalid member option ID' => "the member option ID " . $members_option_id . " does not exist"]);
                }

                if ($member[11] == "" || $member[12] == "") {
                    throw ValidationException::withMessages(['Title empty' => "the title field cannot be empty"]);
                } else {
                    $title = [
                        'en' => $member[11],
                        'ar' => $member[12],
                    ];
                }

                if ($member[11] == "" || $member[12] == "") {
                    throw ValidationException::withMessages(['Title empty' => "the title field cannot be empty"]);
                } else {
                    $title = [
                        'en' => $member[11],
                        'ar' => $member[12],
                    ];
                }

                if ($member[13] == "" || $member[14] == "") {
                    throw ValidationException::withMessages(['description empty' => "the description field cannot be empty"]);
                } else {
                    $desc = [
                        'en' => $member[13],
                        'ar' => $member[14],
                    ];
                }

                if ($member[15] == "" || $member[16] == "") {
                    throw ValidationException::withMessages(['Learn more empty' => "the learn more field cannot be empty"]);
                } else {
                    $learn_more = [
                        'en' => $member[15],
                        'ar' => $member[16],
                    ];
                }

                if ($member[17] == "" || $member[18] == "") {
                    throw ValidationException::withMessages(['Popup Desc empty' => "the popup description field cannot be empty"]);
                } else {
                    $popup_desc = [
                        'en' => $member[17],
                        'ar' => $member[18],
                    ];
                }

                if ($member[19] == "" || $member[20] == "") {
                    throw ValidationException::withMessages(['Contact empty' => "the contact field cannot be empty"]);
                } else {
                    $contact = [
                        'en' => $member[19],
                        'ar' => $member[20],
                    ];
                }

                $phone1_text = [
                    'en' => $member[21],
                    'ar' => $member[22],
                ];

                $phone2_text = [
                    'en' => $member[23],
                    'ar' => $member[24],
                ];

                $phone3_text = [
                    'en' => $member[25],
                    'ar' => $member[26],
                ];

                $fax_text = [
                    'en' => $member[27],
                    'ar' => $member[28],
                ];

                $location_text = [
                    'en' => $member[29],
                    'ar' => $member[30],
                ];



                $activity_member = new ActivityMember();

                $email = $member[1];
                $activity_member->email = $email;
                $activity_member->phone1_url = $phone1_url;
                $activity_member->phone2_url = $phone2_url;
                $activity_member->phone3_url = $phone3_url;
                $activity_member->fax_url = $fax_url;
                $activity_member->web_url = $web_url;
                $activity_member->location_url = $location_url;
                $activity_member->members_option_id = $members_option_id;

                $activity_member->save();

                $activity_member->sector_of_activity()->sync($sectors);
                $activity_member->activity()->sync($activities);
                $activity_member->directory()->sync($directories);

                $language = Language::get();

                foreach ($language as $key => $lang) {
                    $activitiMemberTranslation = new ActivityMemberTranslation();
                    $activitiMemberTranslation->activity_member_id = $activity_member->id;
                    $activitiMemberTranslation->locale = $lang->slug;
                    $activitiMemberTranslation->title = $title[$lang->slug];
                    $activitiMemberTranslation->description = $desc[$lang->slug];
                    $activitiMemberTranslation->learn_more = $learn_more[$lang->slug];
                    $activitiMemberTranslation->popup_description = $popup_desc[$lang->slug];
                    $activitiMemberTranslation->contact = $contact[$lang->slug];
                    $activitiMemberTranslation->phone1_text = $phone1_text[$lang->slug];
                    $activitiMemberTranslation->phone2_text = $phone2_text[$lang->slug];
                    $activitiMemberTranslation->phone3_text = $phone3_text[$lang->slug];
                    $activitiMemberTranslation->fax_text = $fax_text[$lang->slug];
                    $activitiMemberTranslation->location_text = $location_text[$lang->slug];

                    $activitiMemberTranslation->save();
                }

                $zip = new \ZipArchive;
                $zipFile = $request->file('images');
                if ($zip->open($zipFile) === true) {

                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i); //get pdf name
                        $fileinfo = pathinfo($filename); //file info in array form

                        $random = Str::uuid();
                        if (!Storage::exists('/activity-members/' . $random)) {

                            Storage::makeDirectory('/activity-members/' . $random); //creates directory

                        }
                        $target = Storage::path('/activity-members/' . $random . '/');
                        $activity_member->image = 'activity-members/' . $random .'/' . $image;
                        $activity_member->save();

                        copy("zip://" . $zipFile . "#" . $filename, $target . $fileinfo['basename']);
                    }
                    $zip->close();
                }
            }
        }
        return redirect()->back()->with('success', 'Members successfully imported!');
    }
}
