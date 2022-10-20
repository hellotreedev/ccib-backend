<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class PublicationsCategory extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'category_publications_list';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title"];

	
}