<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ServicesSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'services_settings';

    protected $guarded = ['id'];

    public $translatedAttributes = ["page_title","e_services_title"];

	
}