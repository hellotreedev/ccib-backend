<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ProjectActivity extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'project_activities';

    protected $guarded = ['id'];

    protected $hidden =['translations'];

    public $translatedAttributes = ["activity"];

	public function projects() { return $this->belongsToMany('App\Project', 'project_project_activity', 'project_activity_id', 'project_id')->orderBy('project_project_activity.ht_pos'); } 
}