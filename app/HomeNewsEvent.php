<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract; use Astrotomic\Translatable\Translatable;

class HomeNewsEvent extends Model  implements TranslatableContract
{
	use Translatable;

    protected $table = 'home_news_events';

    protected $guarded = ['id'];

    public $translatedAttributes = ["Events_title"];

    protected $hidden = ['translations'];

	public function news_categories() { return $this->belongsTo('App\NewsCategory'); } public function events() { return $this->belongsToMany('App\Event', 'event_home_news_event', 'home_news_event_id', 'event_id')->orderBy('event_home_news_event.ht_pos'); } 
}