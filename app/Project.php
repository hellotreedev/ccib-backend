<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Project extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'projects';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    protected $appends = ['image_full_path'];

    public $translatedAttributes = ["title","subtitle"];


    public function getImageFullPathAttribute() {
        if (isset($this->image)) {
            $full_path_image = Helper::fullPath($this->image);
            return $full_path_image;
        } else {
            return null;
        }
    }

	public function project_categories() { return $this->belongsToMany('App\ProjectCategory', 'project_category_project', 'project_id', 'project_category_id')->orderBy('project_category_project.ht_pos'); } 
}