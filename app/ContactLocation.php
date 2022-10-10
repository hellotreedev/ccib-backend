<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class ContactLocation extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'contact_locations';

    protected $guarded = ['id'];

    public $translatedAttributes = ["title","subtitle","description","phone_text"];

	
}