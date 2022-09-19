<?php

namespace App;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ChamberSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'chamber_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $appends = ['pdf_full_path'];

    public function getPdfFullPathAttribute()
    {
        if (isset($this->pdf)) {
            $full_path_pdf = Helper::fullPath($this->pdf);
            return $full_path_pdf;
        } else {
            return null;
        }
    }


    public $translatedAttributes = ["page_title","page_subtitle","title","subtitle","pdf"];

	
}