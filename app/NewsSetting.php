<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class NewsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'news_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","search_placeholder","search_btn","year_placeholder","category_placeholder", "learn_more", "gallery_title", "pdf_label"];

	
}