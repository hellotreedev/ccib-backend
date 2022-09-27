<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Page extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'Pages';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title"];

	
}