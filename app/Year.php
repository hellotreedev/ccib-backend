<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Year extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'years';

    protected $guarded = ['id'];

    public $translatedAttributes = ["year"];

	
}