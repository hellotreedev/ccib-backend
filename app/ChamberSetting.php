<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ChamberSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'chamber_settings';

    protected $guarded = ['id'];

    public $translatedAttributes = ["page_title","page_subtitle","title","subtitle","pdf"];

	
}