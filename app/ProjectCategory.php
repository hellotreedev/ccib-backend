<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ProjectCategory extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'project_categories';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title"];

    public function projects() { return $this->belongsToMany('App\Project', 'project_category_project',  'project_category_id', 'project_id')->orderBy('project_category_project.ht_pos'); } 
	
}