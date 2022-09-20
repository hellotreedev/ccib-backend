<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ProjectPartner extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'project_partners';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title"];

	public function projects() { return $this->belongsToMany('App\Project', 'project_project_partner', 'project_partner_id', 'project_id')->orderBy('project_project_partner.ht_pos'); } 
}