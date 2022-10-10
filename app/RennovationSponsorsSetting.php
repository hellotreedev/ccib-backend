<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class RennovationSponsorsSetting extends Model  implements TranslatableContract
{
    use SearchableTrait;
	use Translatable;

    protected $table = 'rennovation_sponsors_settings';

    protected $searchable = [
        'groupBy' => ['rennovation_sponsors_settings.id'],
        'columns' => [
            'rennovation_sponsors_settings_translations.page_title' => 10,
            'rennovation_sponsors_settings_translations.about_us_title' => 10,
            'rennovation_sponsors_settings_translations.about_us_description' => 10,
            'rennovation_sponsors_settings_translations.sponsor_level_label' => 10,
        ],
        'joins' => [
            'rennovation_sponsors_settings_translations' => ['rennovation_sponsors_settings_translations.rennovation_sponsors_setting_id','rennovation_sponsors_settings.id'],
        ],
    ];

    protected $guarded = ['id'];

    public $translatedAttributes = ["page_title","about_us_title","about_us_description","sponsor_level_label"];

	public function pages() { return $this->belongsTo('App\Page'); } 
}