<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EService extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'e_services';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title"];

	
}