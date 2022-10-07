<?php

namespace App;
use App\Helpers\Helper;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SeoPage extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'seo_pages';

    protected $guarded = ['id'];
    
    protected $hidden = ['translations'];
    
    public $appends = ['image_full_path'];

    public $translatedAttributes = ["title","description"];
    
     public function getImageFullPathAttribute()
    {
        if (isset($this->image)) {
            $full_path_image = Helper::fullPath($this->image);
            return $full_path_image;
        } else {
            return null;
        }
    }
	
}