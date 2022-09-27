<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SearchSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'search_settings';

    protected $guarded = ['id'];

    public $translatedAttributes = ["page_title","title","pages","news","events","members"];

	
}