<?php

include 'cms.php';
use App\RennovationSponsorsList;


use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sitemap.xml', 'App\Http\Controllers\WebsiteController@sitemap');

Route::get('/test/cms-pages-scan', function () {
    $pages = \DB::table('cms_pages')->get();

    $array = [];
    foreach ($pages as $page) {
        if ($page->fields) {
            $fields = json_decode($page->fields);
            foreach($fields as $field) {
                if ($field->form_field == 'select' || $field->form_field == 'select multiple') {
                    if ($page->database_table == $field->form_field_additionals_1) {
                        $array[] = $page;
                    }
                }
            }
        }
    }

    return $array;
});

Route::get('/test', function () {
    $random = Str::uuid();
    $zip = new \ZipArchive;
    $zipFile = storage_path('app/public/news_list_csv_images.zip');
    if ($zip->open($zipFile) === true) {
        for ($i = 0; $i < $zip->numFiles; $i++) {
            $filename = $zip->getNameIndex($i); //get pdf name
            $fileinfo = pathinfo($filename); //file info in array form
            if (!Storage::exists('/news-list/')) {

                Storage::makeDirectory('/news-list/'); //creates directory

            }
            $target = Storage::path('/news-list/');
            copy("zip://" . $zipFile . "#" . $filename, $target . $fileinfo['basename']);
        }
    }
});

Route::get('/web', function() {
    $sponsors = RennovationSponsorsList::get();
        foreach($sponsors as $sponsor){
            if($sponsor->website_url){
                $sponsor->website_url = "https://" . $sponsor->website_url;
                $sponsor->save();
            }
        }
        
        
});
