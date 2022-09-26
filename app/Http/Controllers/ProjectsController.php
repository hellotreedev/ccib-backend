<?php

namespace App\Http\Controllers;

use App\Project;
use App\ProjectCategory;
use App\ProjectsSetting;
use Illuminate\Http\Request;

class ProjectsController extends Controller
{
    public function index() {
        $project_settings = ProjectsSetting::first();

        $categories = ProjectCategory::orderBy("ht_pos")->orderBy("id")->get();


        return compact("project_settings", "categories");
    }

    public function ongoingProjects() {
        $ongoing_projects = Project::where("ongoing", 1)->with("project_categories")->get();
        return compact('ongoing_projects');
    }

    public function previousProjects() {
        $previous_projects = Project::where("ongoing",0)->with("project_categories")->get();
        return compact('previous_projects');
    }

    public function singleProject(Request $request){
        $project = Project::where("slug", $request->slug)->with("partners", "associates", "activity", "articles")->first();
        return $project;
    }
}
