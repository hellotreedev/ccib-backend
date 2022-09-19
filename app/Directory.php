<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Directory extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'directory';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["page_title","section1_title","section1_description","section2_title"];

	
}