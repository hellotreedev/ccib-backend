<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectCategory;
use App\ProjectsSetting;
use Illuminate\Http\Request;
use App\NewsCategory;

class ProjectsController extends Controller
{
    public function index() {
        $project_settings = ProjectsSetting::first();

        $categories = ProjectCategory::orderBy("ht_pos")->orderBy("id")->get();


        return compact("project_settings", "categories");
    }

    public function ongoingProjects() {
        // $ongoing_projects = Project::where("ongoing", 1)->with("project_categories")->get();
        $ongoing_projects_categories = ProjectCategory::select()->whereHas('projects', function($projects) {
            $projects->where("ongoing",1);
        })->with('projects.project_categories')->get();
        return compact('ongoing_projects_categories');
    }

    public function previousProjects() {
        $previous_projects_categories = ProjectCategory::select()->whereHas('projects', function($projects) {
            $projects->where("ongoing",0);
        })->with('projects.project_categories')->get();
        return compact('previous_projects_categories');
    }

    public function singleProject(Request $request){
        $project = Project::where("slug", $request->slug)->with("partners","news_categories", "associates", "activity", "articles", "news.news_categories")->first();

        $selectedNews = [];
        $selectedEvents = [];
        $catArr = [];


        foreach ($project->news as $key => $el) {
            $selectedNews[] = $el;
        }

        foreach ($selectedNews as $key => $value) {
            foreach ($value->news_categories as $key => $cat) {
                if (!in_array($cat->id, $catArr)) {
                    $catArr[]  = $cat->id;
                }
            }
        }

        $categories = NewsCategory::whereIn('id', $catArr)->get();

        $events = Project::where("slug", $request->slug)->with("events")->get();

        foreach ($project->events as $key => $el) {
            $selectedEvents[] = $el;
        }
        
        return compact('project', 'selectedNews', 'selectedEvents', 'categories' );
    }
}
