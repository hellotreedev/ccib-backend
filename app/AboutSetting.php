<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class AboutSetting extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'about_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];


    public $translatedAttributes = ["page_title","about_us_title","about_us_description","chariman_letter_title","chariman_letter_description_left","chariman_letter_description_right", "strategy_title","strategy_excerpt","mission_title","mission_description","milestones_title","milestones_subtitle","charimen_title","date_range","chamber_law_image","chamber_law_title","chamber_law_excerpt","read","board_directors_title","board_directors_subtitle","view_all","renovation_sponsors","view"];

	
}