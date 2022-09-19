<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Location extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'locations';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["title","phone_text"];

	
}