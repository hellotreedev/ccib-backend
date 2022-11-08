<?php

include 'cms.php';

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

