<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SearchSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'search_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","title","pages","news","events","members","publications","search_here","search_btn","learn_more","view_pdf"];

	
}