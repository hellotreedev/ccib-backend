<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SingleDirectorySetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'single_directory_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","section1_title","section1_subtitle","search_here","search_btn","product","company","sector_of_activity","activity","section2_title"];

	
}