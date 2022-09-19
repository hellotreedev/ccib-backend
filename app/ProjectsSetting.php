<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ProjectsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'projects_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","ongoing_projects","previous_projects"];

	
}