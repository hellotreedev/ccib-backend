<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class Popup extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'popup';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title","excerpt","learn_more"];

	
}