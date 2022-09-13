<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class SeoPage extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'seo_pages';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title","description"];

	
}