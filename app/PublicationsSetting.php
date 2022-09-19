<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class PublicationsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'publications_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","section_title","categories_title","view_pdf"];

	
}