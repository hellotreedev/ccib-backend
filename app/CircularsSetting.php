<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class CircularsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'circulars_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","learn_more"];

	
}