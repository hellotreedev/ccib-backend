<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GeneralController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChambersController;
use App\Http\Controllers\RennovationController;
use App\Http\Controllers\BoardController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\EServicesController;
use App\Http\Controllers\LegislationController;
use App\Http\Controllers\DirectoryController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\CircularsController;
use App\Http\Controllers\NewsEventsController;
use App\Http\Controllers\MailchimpController;
use App\Http\Controllers\ContactController;








/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('locale')->prefix('{locale}')->group(function () {
    Route::get('/general', [GeneralController::class, 'index']);
    Route::get('/home', [HomeController::class, 'index']);
    Route::get('/about', [AboutController::class, 'index']);
    Route::get('/chambers', [ChambersController::class, 'index']);
    Route::get('/rennovation', [RennovationController::class, 'index']);
    Route::get('/board-directors', [BoardController::class, 'index']);
    Route::get('/services', [ServicesController::class, 'index']);
    Route::get('/services/{slug}', [ServicesController::class, 'singleService']);
    Route::get('/e-services', [EServicesController::class, 'index']);
    Route::get('/e-services/{slug}', [EServicesController::class, 'singleEservice']);
    Route::get('/legislation', [LegislationController::class, 'index']);
    Route::get('/publications-settings', [PublicationController::class, 'index']);
    Route::get('/publications', [PublicationController::class, 'publications']);
    Route::get('/news-settings', [NewsController::class, 'index']);
    Route::get('/news', [NewsController::class, 'news']);
    Route::get('/news/{slug}', [NewsController::class, 'singleNews']);
    Route::get('/searchNews', [NewsController::class, 'searchNews']);
    Route::get('/events-settings', [EventsController::class, 'index']);
    Route::get('/previous-events', [EventsController::class, 'prevEvents']);
    Route::get('/upcoming-events', [EventsController::class, 'upcomingEvents']);
    Route::get('/events/{slug}', [EventsController::class, 'singleEvent']);
    Route::get('/projects-settings', [ProjectsController::class, 'index']);
    Route::get('/ongoing-projects', [ProjectsController::class, 'ongoingProjects']);
    Route::get('/previous-projects', [ProjectsController::class, 'previousProjects']);
    Route::get('/project/{slug}', [ProjectsController::class, 'singleProject']);
    Route::get('/circulars-settings', [CircularsController::class, 'index']);
    Route::get('/circulars', [CircularsController::class, 'circulars']);
    Route::get('/news-events-settings', [NewsEventsController::class, 'index']);
    Route::get('/contact-data', [ContactController::class, 'index']);
    Route::get('/directory', [DirectoryController::class, 'index']);
    Route::get('/directory/{slug}', [DirectoryController::class, 'singleDirectory']);
    Route::get('/not-found', [DirectoryController::class, 'index']);
    Route::get('/searchDirectory/{slug}', [NotFoundController::class, 'searchDirectory']);


    Route::post('/newsletter', [MailchimpController::class, 'index']);
    Route::post('/contact', [ContactController::class, 'contact']);
    Route::post('/events-contact', [EventsController::class, 'contact']);
    
});
