<?php

namespace App\Http\Controllers\Cms;

use App\ActivityMember;
use App\Http\Controllers\Controller;
use App\MemberSocialMedia;
use App\PublicationsCategory;
use App\PublicationsList;
use App\PublicationsListTranslation;
use Carbon\Carbon;
use File;
use Hellotreedigital\Cms\Controllers\CmsPageController;
use Hellotreedigital\Cms\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class UploadSocialsCSVCmsController extends Controller
{
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
    }

    public function index()
    {
        return view('vendor.cms.pages.upload-socials-csv.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            'images' => 'required|file|mimes:zip'
        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $key => $social) {
            if ($key == 0) continue;

            else {

                if ($social[0] == "") {
                    throw ValidationException::withMessages(['URL empty' => "the URL field should not be empty !"]);
                } else {
                    $url = $social[0];
                }

                if ($social[1] == "") {
                    throw ValidationException::withMessages(['icon empty' => "the icon field should not be empty !"]);
                } else {
                    $icon = $social[1];
                }

                if ($social[2] == "") {
                    throw ValidationException::withMessages(['activity member empty' => "the activity member field should not be empty !"]);
                } else {
                    $activity_member = $social[2];
                }

                $valid_member = ActivityMember::where('id', $activity_member)->first();
                if ($valid_member == null) {
                    throw ValidationException::withMessages(['invalid member ID' => "the member ID " . $activity_member . " does not exist"]);
                }

                $social_media = new MemberSocialMedia();
                $social_media->url = $url;
                $social_media->icon = $icon;
                $social_media->url = $url;
                $social_media->activity_members_id = $activity_member;
                $social_media->save();


                $zip = new \ZipArchive;
                $zipFile = $request->file('images');
                if ($zip->open($zipFile) === true) {

                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i); //get pdf name
                        $fileinfo = pathinfo($filename); //file info in array form

                        $random = Str::uuid();
                        if (!Storage::exists('/member-social-media/' . $random)) {

                            Storage::makeDirectory('/member-social-media/' . $random); //creates directory

                        }
                        $target = Storage::path('/member-social-media/' . $random . '/');
                        $social_media->icon = 'member-social-media/' . $random . '/' . $icon;
                        $social_media->save();

                        copy("zip://" . $zipFile . "#" . $filename, $target . $fileinfo['basename']);
                    }
                }
            }
        }
        return redirect()->back()->with('success', 'Socials successfully imported!');
    }
}
