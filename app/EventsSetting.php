<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EventsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'events_settings';

    protected $guarded = ['id'];

    public $translatedAttributes = ["page_title","previous_label","upcoming_label","learn_more"];

	
}