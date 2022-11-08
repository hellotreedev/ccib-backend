<?php

namespace App\Http\Controllers\Cms;

use App\ActivityMember;
use App\Http\Controllers\Controller;
use App\MemberSocialMedia;
use App\NewsCategory;
use App\NewsList;
use App\NewsListTranslation;
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

class UploadNewsCSVCmsController extends Controller
{
    public function __construct(CmsPageController $cmsPageController)
    {
        $this->cmsPageController = $cmsPageController;
    }

    public function index()
    {
        return view('vendor.cms.pages.upload-news-csv.index');
    }

    public function store(Request $request)
    {

        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
            // 'images' => 'required|file|mimes:zip',
        ]);


        $path = $request->file('csv_file')->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $key => $singleNews) {
            if ($key == 0) continue;

            else {





                if ($singleNews[0] == "") {
                    throw ValidationException::withMessages(['Image empty' => "the image field should not be empty !"]);
                } else {
                    $image = $singleNews[0];
                }

                if ($singleNews[20] == "") {
                    throw ValidationException::withMessages(['single page image empty' => "the single page image field should not be empty !"]);
                } else {
                    $single_page_image = $singleNews[20];
                }

                    $left_image = $singleNews[22];
                    $right_image = $singleNews[23];

                if ($singleNews[1] == "") {
                    throw ValidationException::withMessages(['Date empty' => "the date field should not be empty !"]);
                } else {
                    $date = $singleNews[1];
                    $date = Carbon::createFromFormat('m/d/Y', $date)->format('Y-m-d');
                }

                if ($singleNews[2] == "") {
                    throw ValidationException::withMessages(['news categories empty' => "the news categories field should not be empty !"]);
                } else {
                    $news_categories = $singleNews[2];
                    $news_categories = explode(',',  $news_categories);
                }

                foreach ($news_categories as $key => $act) {
                    $valid_categ = NewsCategory::where("id", $act)->first();
                    if ($valid_categ == null) {
                        throw ValidationException::withMessages(['invalid news category ID' => "the news category ID " . $act . " does not exist"]);
                    }
                }

                if ($singleNews[3] !== "") {
                    $more_news = $singleNews[3];
                    $more_news = explode(',',  $more_news);
                    foreach ($more_news as $key => $more) {
                        $valid_news = NewsList::where("id", $more)->first();
                        if ($valid_news == null) {
                            throw ValidationException::withMessages(['invalid news ID' => "the news ID " . $more . " does not exist"]);
                        }
                    }
                }


                if ($singleNews[4] == "" || $singleNews[5] == "") {
                    throw ValidationException::withMessages(['Title empty' => "the title field cannot be empty"]);
                } else {
                    $title = [
                        'en' => $singleNews[4],
                        'ar' => $singleNews[5],
                    ];
                }

                if ($singleNews[6] == "" || $singleNews[7] == "") {
                    throw ValidationException::withMessages(['Excerpt empty' => "the excerpt field cannot be empty"]);
                } else {
                    $excerpt = [
                        'en' => $singleNews[6],
                        'ar' => $singleNews[7],
                    ];
                }

                if ($singleNews[8] == "" || $singleNews[9] == "") {
                    throw ValidationException::withMessages(['news title empty' => "the news title field cannot be empty"]);
                } else {
                    $news_title = [
                        'en' => $singleNews[8],
                        'ar' => $singleNews[9],
                    ];
                }

                if ($singleNews[10] == "" || $singleNews[11] == "") {
                    throw ValidationException::withMessages(['Description empty' => "the description field cannot be empty"]);
                } else {
                    $description = [
                        'en' => $singleNews[10],
                        'ar' => $singleNews[11],
                    ];
                }

                if ($singleNews[12] == "" || $singleNews[13] == "") {
                    throw ValidationException::withMessages(['Share empty' => "the share field cannot be empty"]);
                } else {
                    $share = [
                        'en' => $singleNews[12],
                        'ar' => $singleNews[13],
                    ];
                }

                if ($singleNews[14] == "" || $singleNews[15] == "") {
                    throw ValidationException::withMessages(['read more empty' => "the read more field cannot be empty"]);
                } else {
                    $read_more = [
                        'en' => $singleNews[14],
                        'ar' => $singleNews[15],
                    ];
                }

                if ($singleNews[16] == "" || $singleNews[17] == "") {
                    throw ValidationException::withMessages(['Right text empty' => "the right text field cannot be empty"]);
                } else {
                    $right_text = [
                        'en' => $singleNews[16],
                        'ar' => $singleNews[17],
                    ];
                }

                if ($singleNews[18] == "" || $singleNews[19] == "") {
                    throw ValidationException::withMessages(['Left text empty' => "the left text field cannot be empty"]);
                } else {
                    $left_text = [
                        'en' => $singleNews[18],
                        'ar' => $singleNews[19],
                    ];
                }

                $pdf = [
                    'en' => $singleNews[23],
                    'ar' => $singleNews[24]
                ];


                $news = new NewsList();
                $news->date = $date;


                $news->save();
                $news->news_categories()->sync($news_categories);

                // if($more_news){
                //     $news->more_news()->sync($more_news);
                // }                        $zip = new \ZipArchive;

                $zip = new \ZipArchive;
                $zipFile = Storage::get('news_images.zip');
                // $zipFile = $request->file('images');
                dd($zip->open($zipFile));

                if ($singleNews[25]) {
                    $gallery = $singleNews[25];
                    $gallery = explode(',', $gallery);
                    $arr = [];
                    foreach ($gallery as $img) {
                        $random = Str::uuid();
                        

                        if ($zip->open($zipFile) === true) {
                            for ($i = 0; $i < $zip->numFiles; $i++) {
                                $filename = $zip->getNameIndex($i); //get pdf name
                                dd($filename);
                                $fileinfo = pathinfo($filename); //file info in array form
                                $random = Str::uuid();
                                if (!Storage::exists('/news-list/' . $random)) {

                                    Storage::makeDirectory('/news-list/' . $random); //creates directory

                                }
                                $target = Storage::path('/news-list/' . $random . '/');
                                if ($filename == $img) {
                                    $arr[] = 'news-list/' . $random . '/' . $img;
                                }
                                copy("zip://" . $zipFile . "#" . $filename, $target . $fileinfo['basename']);
                            }
                        }
                    }
                    $gallery = json_encode($arr);
                    $news->gallery = $gallery;
                    $news->save();
                }


                $language = Language::get();

                $zip_pdf = new \ZipArchive;
                $zipFile_pdf = $request->file('pdfs');

                foreach ($language as $key => $lang) {
                    $newsTranslation = new NewsListTranslation();
                    $newsTranslation->news_list_id = $news->id;
                    $newsTranslation->locale = $lang->slug;
                    $newsTranslation->title = $title[$lang->slug];
                    $newsTranslation->excerpt = $excerpt[$lang->slug];
                    $newsTranslation->news_title = $news_title[$lang->slug];
                    $newsTranslation->description = $description[$lang->slug];
                    $newsTranslation->share = $share[$lang->slug];
                    $newsTranslation->read_more = $read_more[$lang->slug];
                    $newsTranslation->right_text = $right_text[$lang->slug];
                    $newsTranslation->left_text = $left_text[$lang->slug];
                    if($zipFile_pdf){

                        if ($zip_pdf->open($zipFile_pdf) === true) {
                            for ($i = 0; $i < $zip_pdf->numFiles; $i++) {
                                $filename = $zip_pdf->getNameIndex($i);
                                if ($filename == $pdf[$lang->slug]) {
                                    $fileinfo = pathinfo($filename); //file info in array form

                                    $random = Str::uuid();
                                    if (!Storage::exists('/news-list/' . $random)) {

                                        Storage::makeDirectory('/news-list/' . $random . '/' . $lang->slug); //creates directory

                                    }
                                    $target = Storage::path('/news-list/' . $random . '/' . $lang->slug . '/');

                                    copy("zip://" . $zipFile_pdf . "#" . $filename, $target . $fileinfo['basename']);
                                    $newsTranslation->single_page_pdf = '/news-list/' . $random . '/' . $lang->slug . '/' . $fileinfo['basename'];
                                }
                            }
                        }
                        $zip_pdf->close();

                    }
                    $newsTranslation->save();
                }


                
                if ($zip->open($zipFile) === true) {

                    for ($i = 0; $i < $zip->numFiles; $i++) {
                        $filename = $zip->getNameIndex($i); //get pdf name
                        $fileinfo = pathinfo($filename); //file info in array form
                        $random = Str::uuid();
                        if (!Storage::exists('/news-list/' . $random)) {

                            Storage::makeDirectory('/news-list/' . $random); //creates directory

                        }
                        $target = Storage::path('/news-list/' . $random . '/');

                        if ($filename == $single_page_image) {
                            $news->single_page_image = 'news-list/' . $random . '/' . $single_page_image;
                        } else if ($filename == $right_image) {
                            $news->right_image = 'news-list/' . $random . '/' . $right_image;
                        } else if ($filename == $left_image) {
                            $news->left_image = 'news-list/' . $random . '/' . $left_image;
                        } else if ($filename == $image) {
                            $news->image = 'news-list/' . $random . '/' . $image;
                        }



                        $news->save();
                        copy("zip://" . $zipFile . "#" . $filename, $target . $fileinfo['basename']);
                    }
                    $zip->close();







                    // for ($i = 0; $i < $zip_pdf->numFiles; $i++) {
                    //     $filename = $zip_pdf->getNameIndex($i); //get pdf name
                    //     $fileinfo = pathinfo($filename); //file info in array form

                    //     $random = Str::uuid();
                    //     if (!Storage::exists('/news-list/' . $random)) {

                    //         Storage::makeDirectory('/news-list/' . $random); //creates directory

                    //     }
                    //     $target = Storage::path('/news-list/' . $random . '/');

                    //     copy("zip://" . $zipFile_pdf . "#" . $filename, $target . $fileinfo['basename']);


                    // }


                }
            }
        }
        return redirect()->back()->with('success', 'News successfully imported!');
    }
}
