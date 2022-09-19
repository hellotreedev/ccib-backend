<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class BoardOfDirectorsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'board_of_directors_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["page_title","bureau_title","board_members_title"];

	
}