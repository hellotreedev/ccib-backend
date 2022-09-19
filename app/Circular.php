<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Circular extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'circulars';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['image_full_path', 'pdf_full_path'];

    public $translatedAttributes = ["title","excerpt","resources","download_doc","pdf"];

    public function getImageFullPathAttribute()
    {
        if (isset($this->image)) {
            $full_path_image = Helper::fullPath($this->image);
            return $full_path_image;
        } else {
            return null;
        }
    }

    public function getPdfFullPathAttribute()
    {
        if (isset($this->pdf)) {
            $full_path_pdf = Helper::fullPath($this->pdf);
            return $full_path_pdf;
        } else {
            return null;
        }
    }
    


	public function categories() { return $this->belongsToMany('App\CircularsCateg', 'circulars_categ_circular', 'circular_id', 'circulars_categ_id')->orderBy('circulars_categ_circular.ht_pos'); } 
}