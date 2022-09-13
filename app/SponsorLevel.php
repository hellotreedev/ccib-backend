<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SponsorLevel extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'sponsor_level';

    protected $guarded = ['id'];

    public $translatedAttributes = ["level"];

	
}