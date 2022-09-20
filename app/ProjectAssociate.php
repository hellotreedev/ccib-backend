<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ProjectAssociate extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'project_associates';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title"];

    protected $hidden = ['translations'];

	public function projects() { return $this->belongsToMany('App\Project', 'project_project_associate', 'project_associate_id', 'project_id')->orderBy('project_project_associate.ht_pos'); } 
}