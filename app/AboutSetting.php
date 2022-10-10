<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class AboutSetting extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;

    protected $table = 'about_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["page_title","about_us_title","about_us_description","chariman_letter_title","chariman_letter_description_left","chariman_letter_description_right", "strategy_title","strategy_excerpt","mission_title","mission_description","milestones_title","milestones_subtitle","charimen_title","date_range","chamber_law_image","chamber_law_title","chamber_law_excerpt","read","board_directors_title","board_directors_subtitle","view_all","renovation_sponsors","view"];

	protected $searchable = [
        'groupBy' => ['about_settings.id'],
        'columns' => [
            'about_settings_translations.page_title' => 10,
            'about_settings_translations.about_us_title' => 10,
            'about_settings_translations.about_us_description' => 10,
            'about_settings_translations.chariman_letter_title' => 10,
            'about_settings_translations.chariman_letter_description_left' => 10,
            'about_settings_translations.chariman_letter_description_right' => 10,
            'about_settings_translations.strategy_title' => 10,
            'about_settings_translations.mission_title' => 10,
            'about_settings_translations.mission_description' => 10,
            'about_settings_translations.milestones_title' => 10,
            'about_settings_translations.milestones_subtitle' => 10,
            'about_settings_translations.charimen_title' => 10,
            'about_settings_translations.chamber_law_excerpt' => 10,
            'about_settings_translations.board_directors_title' => 10,
            'about_settings_translations.board_directors_subtitle' => 10,
            'about_settings_translations.renovation_sponsors' => 10,
        ],
        'joins' => [
            'about_settings_translations' => ['about_settings_translations.about_setting_id','about_settings.id'],
        ],
    ];
	
		public function pages() { return $this->belongsTo('App\Page'); } 

}