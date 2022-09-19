<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class RennovationSponsorsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'rennovation_sponsors_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["page_title","about_us_title","about_us_description","sponsor_level_label"];

	
}