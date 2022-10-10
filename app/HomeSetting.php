<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;
use Nicolaslopezj\Searchable\SearchableTrait;

class HomeSetting extends Model  implements TranslatableContract
{
	use Translatable;
    use SearchableTrait;

    protected $table = 'home_settings';

    protected $guarded = ['id'];

    protected $hidden = ['translations'];

    public $translatedAttributes = ["about_title","about_description","read_more","news_events_title","view_all","services_title","publications_title","eservices_title","eservices_description","learn_more","banner_title"];

    protected $searchable = [
        'groupBy' => ['home_settings.id'],
        'columns' => [
            'home_settings_translations.about_title' => 10,
            'home_settings_translations.about_description' => 10,
            'home_settings_translations.news_events_title' => 10,
            'home_settings_translations.services_title' => 10,
            'home_settings_translations.publications_title' => 10,
            'home_settings_translations.eservices_title' => 10,
            'home_settings_translations.eservices_description' => 10,
            'home_settings_translations.banner_title' => 10,
        ],
        'joins' => [
            'home_settings_translations' => ['home_settings_translations.home_setting_id','home_settings.id'],
        ],
    ];

	public function home_news() { return $this->belongsToMany('App\NewsList', 'news_list_home_setting', 'home_setting_id', 'news_list_id')->orderBy('news_list_home_setting.ht_pos'); } public function home_events() { return $this->belongsToMany('App\Event', 'event_home_setting', 'home_setting_id', 'event_id')->orderBy('event_home_setting.ht_pos'); } 
    public function pages() { return $this->belongsTo('App\Page'); }
}