<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EService extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'e_services';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["title", "excerpt", "description", "terms_text", "benefits_text", "documents_text", "fees_text", "label"];

	
}