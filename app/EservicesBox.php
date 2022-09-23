<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EservicesBox extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'eservices_box';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["text"];

	
}