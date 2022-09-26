<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class EventsSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'events_settings';

    protected $guarded = ['id'];

    public $translatedAttributes = ["page_title","previous_label","upcoming_label","learn_more","register_title","register_subtitle","first_name","last_name","mail","company","nb_of_people","number","description","send_btn","contact","phone_1","phone_2","calendar_text","mail_text","web_text","pin_text","gallery_title","success_message","error_message"];

    
	
}