<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
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

class UploadPublicationsCSVCmsController extends Controller
{
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
    }

    public function index()
    {
        return view('vendor.cms.pages.upload-publications-csv.index');
    }

    public function store(Request $request)
    {




        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            // 'pdfs' => 'required|file|mimes:zip'

        ]);

        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));


        $product_fields = $data[0];
        foreach ($data as $key => $pub) {
            if ($key == 0) continue;

            else {

                if ($pub[0] == "" || $pub[1] == "") {
                    throw ValidationException::withMessages(['Title empty' => "the Title field should not be empty !"]);
                } else {
                    $title = [
                        'en' => $pub[0],
                        'ar' => $pub[1],
                    ];
                }
                
                
                    $except = [
                        'en' => $pub[2],
                        'ar' => $pub[3]
                    ];
                
                if ($pub[4] == "") {
                    throw ValidationException::withMessages(['categories empty' => "the categories field should not be empty !"]);
                } else {
                    $categories = $pub[4];
                    $categories = explode(',',  $categories);
                }
                $pdf_en = [
                    'en' => $pub[11],
                    'ar' => $pub[13]
                ];
                $ar_pdf = [
                    'en' => $pub[12],
                    'ar' => $pub[14]
                ];


                if ($pub[5] == "") {
                    throw ValidationException::withMessages(['date empty' => "the date field should not be empty !"]);
                } else {
                    $date = $pub[5];
                }
                $home_display = $pub[6];

                $date = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');

                if ($home_display == 0) {
                    $home_display = 0;
                } else {
                    $home_display = 1;
                }



                $publication = new PublicationsList();
                $publication->slug = Str::slug($pub[0]);
                $publication->date = $date;

                $publication->home_display = $home_display;
                $publication->save();
                foreach ($categories as $cat) {
                    $publicationCategories = new PublicationsCategory();
                    $publicationCategories->category_id = $cat;
                    $publicationCategories->publications_list_id = $publication->id;
                    $publicationCategories->save();
                }

                $language = Language::get();
                foreach ($language as $key => $lang) {
                    $publicationTranslation = new PublicationsListTranslation();
                    $publicationTranslation->publications_list_id = $publication->id;
                    $publicationTranslation->locale = $lang->slug;
                    $publicationTranslation->title = $title[$lang->slug];
                    $publicationTranslation->excerpt = $except[$lang->slug];
                    if ($pdf_en[$lang->slug]) {
                        $publicationTranslation->pdf_en = 'publications-list/' . $pdf_en[$lang->slug];
                    }
                    if ($ar_pdf[$lang->slug]) {
                        $publicationTranslation->ar_pdf = 'publications-list/' . $ar_pdf[$lang->slug];
                    }

                    $publicationTranslation->save();
                }
    
    
                if(!is_null($request->file('pdfs'))){
                    $zip = new \ZipArchive;
                    $zipFile = $request->file('pdfs');
                    if ($zip->open($zipFile) === true) {
    
                        for ($i = 0; $i < $zip->numFiles; $i++) {
                            $filename = $zip->getNameIndex($i); //get pdf name
                            $fileinfo = pathinfo($filename); //file info in array form
    
                            $random = Str::uuid();
                            if (!Storage::exists('/publications-list/' . $random)) {
                                Storage::makeDirectory('/publications-list/' . $random, 0775, true); //creates directory
                            }
                            $target = Storage::path('/publications-list/' . $random . '/');
    
                            copy("zip://" . $zipFile . "#" . $filename, $target . $fileinfo['basename']);
                        }
                        $zip->close();
                }
                }
            }
        }

        return redirect()->back()->with('success', 'Publications successfully imported!');
    }
}
