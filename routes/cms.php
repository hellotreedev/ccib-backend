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


	/* End admin route group */

});