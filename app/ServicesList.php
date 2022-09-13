<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ServicesList extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'services_list';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title","excerpt","learn_more","different_single_page"];

	
}