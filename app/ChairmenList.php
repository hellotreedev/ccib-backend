<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ChairmenList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'chairmen_list';

    protected $guarded = ['id'];
    
    protected $hidden = ['translations'];


    public $translatedAttributes = ["name","date_range"];

	
}