<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Event extends Model  implements TranslatableContract
{
    use Translatable;

    protected $table = 'events';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["title", "page_title", "date_location", "description", "notes", "more_text", "button_text"];



    public $appends = ["image_full_path"];

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
