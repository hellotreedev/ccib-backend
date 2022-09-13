<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Department extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'department';

    protected $guarded = ['id'];

    public $translatedAttributes = ["department"];

	
}