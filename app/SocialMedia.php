<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;


class SocialMedia extends Model 
{
	

    protected $table = 'social_media';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];
    

    public $appends = ["icon_full_path"];

    public function getIconFullPathAttribute()
    {
        if (isset($this->icon)) {
            $full_path_image = Helper::fullPath($this->icon);
            return $full_path_image;
        } else {
            return null;
        }
    }
	
}