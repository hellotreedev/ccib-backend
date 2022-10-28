<?php

/*
|--------------------------------------------------------------------------
| CMS generated routes for signed in admins
|--------------------------------------------------------------------------
*/


Route::prefix(config('hellotree.cms_route_prefix'))->middleware(['admin'])->group(function () {

    /* Start admin route group */

    Route::post('/activity-members','App\Http\Controllers\Cms\ActivityMembersCmsController@store');
    Route::put('/activity-members/{id}','App\Http\Controllers\Cms\ActivityMembersCmsController@update');


    Route::get('/upload-publications-csv', '\App\Http\Controllers\Cms\UploadPublicationsCSVCmsController@index');
    Route::post('/upload-publications-csv/upload-publications', '\App\Http\Controllers\Cms\UploadPublicationsCSVCmsController@store');

    Route::get('/upload-members-csv', '\App\Http\Controllers\Cms\UploadMembersCSVCmsController@index');
    Route::post('/upload-members-csv/upload-members', '\App\Http\Controllers\Cms\UploadMembersCSVCmsController@store');

    Route::get('/upload-socials-csv', '\App\Http\Controllers\Cms\UploadSocialsCSVCmsController@index');
    Route::post('/upload-socials-csv/upload-socials', '\App\Http\Controllers\Cms\UploadSocialsCSVCmsController@store');
    
    Route::get('/upload-news-csv', '\App\Http\Controllers\Cms\UploadNewsCSVCmsController@index');
    Route::post('/upload-news-csv/upload-news', '\App\Http\Controllers\Cms\UploadNewsCSVCmsController@store');

    Route::get('/upload-activity-csv', '\App\Http\Controllers\Cms\UploadActivityCSVCmsController@index');
    Route::post('/upload-activity-csv/upload-activity', '\App\Http\Controllers\Cms\UploadActivityCSVCmsController@store');

    Route::get('/upload-sector-csv', '\App\Http\Controllers\Cms\UploadSectorCSVCmsController@index');
    Route::post('/upload-sector-csv/upload-sector', '\App\Http\Controllers\Cms\UploadSectorCSVCmsController@store');
	/* End admin route group */
    

});